<?php

namespace App\Services;

use App\Models\AIChatLog;
use App\Models\Location;
use App\Models\Hotel;
use App\Models\Activity;
use App\Models\FlightOffer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AIChatService
{
    private string $apiKey;
    private string $apiUrl = 'https://api.groq.com/openai/v1/chat/completions';
    private string $model  = 'llama-3.1-8b-instant';

    public function __construct()
    {
        $this->apiKey = (string) config('services.groq.key', '');
    }

    private function findLocation(string $text): ?Location
    {
        $locations = Location::all(['id', 'city', 'country']);
        foreach ($locations as $loc) {
            if (stripos($text, $loc->city) !== false || stripos($text, $loc->country) !== false) {
                return $loc;
            }
        }
        return null;
    }

    private function buildContext(?Location $location): string
    {
        if (!$location) {
            $dests = Location::take(8)->get(['city', 'country', 'weather_type'])
                ->map(fn($l) => "- {$l->city}, {$l->country}" . ($l->weather_type ? " (clima: {$l->weather_type})" : ''))
                ->join("\n");
            return "\n\nDESTINOS DISPONIBLES EN TRAVELAI:\n{$dests}\n\nAyuda al usuario a elegir entre estos destinos según sus preferencias.";
        }

        $dest = $location->city . ', ' . $location->country;
        $ctx  = "\n\nDATOS REALES DE TRAVELAI PARA {$dest}:\n";

        $hotels = Hotel::where('location_id', $location->id)->take(3)->get(['id', 'name', 'stars', 'price_per_night', 'services']);
        if ($hotels->isNotEmpty()) {
            $ctx .= "\nHOTELES:\n";
            foreach ($hotels as $h) {
                $svcs = implode(', ', array_slice($h->services ?? [], 0, 3));
                $ctx .= "- {$h->name} [hotel_id:{$h->id}] | {$h->stars}⭐ | {$h->price_per_night}€/noche | {$svcs}\n";
            }
        }

        $offers = FlightOffer::with(['outboundFlight.origin', 'outboundFlight.destination'])
            ->whereHas('outboundFlight', fn($q) => $q->where('destination_loc_id', $location->id))
            ->take(3)->get();
        if ($offers->isNotEmpty()) {
            $ctx .= "\nVUELOS:\n";
            foreach ($offers as $fo) {
                $f      = $fo->outboundFlight;
                $origin = $f?->origin?->city ?? '?';
                $ctx .= "- {$origin} → {$dest} [flight_offer_id:{$fo->id}] | {$f?->airline} | {$fo->total_price}€ | {$f?->duration_time}\n";
            }
        }

        $activities = Activity::where('location_id', $location->id)->take(3)->get(['id', 'name', 'price', 'duration', 'type']);
        if ($activities->isNotEmpty()) {
            $ctx .= "\nACTIVIDADES:\n";
            foreach ($activities as $a) {
                $ctx .= "- {$a->name} [activity_id:{$a->id}] | {$a->price}€/persona | {$a->duration}\n";
            }
        }

        $ctx .= "\nIMPORTANTE: Recomienda ÚNICAMENTE los elementos de la lista anterior con sus precios reales. Al final de tu respuesta, si has recomendado elementos específicos, añade en la última línea EXACTAMENTE este formato (usa corchetes, sin asteriscos, sin espacios extra): [BOOKING:{\"hotel_id\":1,\"flight_offer_id\":2,\"activity_id\":3}] — omite los campos que no hayas recomendado. Ejemplo con solo hotel: [BOOKING:{\"hotel_id\":5}]";

        return $ctx;
    }

    public function chat(string $question, array $history = [], bool $isPremium = false): AIChatLog
    {
        $location = $this->findLocation($question);

        if (!$location) {
            foreach (array_reverse($history) as $entry) {
                $location = $this->findLocation($entry['pregunta']);
                if ($location) break;
            }
        }

        $context = $this->buildContext($location);

        $systemContent = 'Eres TravelAI, asistente de viajes de la plataforma TravelAI. Recomienda servicios reales de la plataforma. Da precios exactos. Responde en español, sé amigable y conciso.' . $context;

        if (!$isPremium) {
            $systemContent .= "\n\nIMPORTANTE SOBRE RESERVAS: Este usuario NO tiene cuenta Premium. NO puedes procesar reservas ni generar códigos BOOKING bajo ninguna circunstancia. Si el usuario pide reservar algo, explícale amablemente que la función de reserva está disponible exclusivamente para usuarios Premium, e invítale a actualizarse desde su perfil en /perfil/premium.";
        }

        $messages = [['role' => 'system', 'content' => $systemContent]];
        foreach ($history as $entry) {
            $messages[] = ['role' => 'user',      'content' => $entry['pregunta']];
            $messages[] = ['role' => 'assistant', 'content' => $entry['respuesta_ia']];
        }
        $messages[] = ['role' => 'user', 'content' => $question];

        $aiResponse  = 'Lo siento, no puedo conectar con la IA en este momento. Inténtalo de nuevo.';
        $bookingData = null;

        if (empty($this->apiKey)) {
            Log::error('AIChatService: GROQ_API_KEY no configurada.');
        } else {
            try {
                $response = Http::timeout(30)
                    ->withToken($this->apiKey)
                    ->post($this->apiUrl, [
                        'model'       => $this->model,
                        'messages'    => $messages,
                        'max_tokens'  => 600,
                        'temperature' => 0.7,
                    ]);

                if ($response->successful()) {
                    $raw = $response->json('choices.0.message.content') ?? $aiResponse;

                    if (preg_match('/\*{0,2}\[?BOOKING:(\{[^}]+\})\]?\*{0,2}/', $raw, $m)) {
                        $bookingData = json_decode($m[1], true) ?: null;
                        $raw = trim(preg_replace('/\*{0,2}\[?BOOKING:\{[^}]+\}\]?\*{0,2}/', '', $raw));
                    }

                    $raw = preg_replace('/\s*\[(hotel_id|flight_offer_id|activity_id):\d+\]/', '', $raw);

                    $aiResponse = $raw;
                } else {
                    Log::error('AIChatService: Groq API error', [
                        'status' => $response->status(),
                        'body'   => $response->body(),
                    ]);
                }
            } catch (\Exception $e) {
                Log::error('AIChatService: Exception', ['message' => $e->getMessage()]);
            }
        }

        return AIChatLog::create([
            'user_id'      => Auth::id(),
            'message'      => $question,
            'response'     => $aiResponse,
            'context_data' => $bookingData,
        ]);
    }
}
