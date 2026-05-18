<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class PaymentApiController extends Controller
{
    public function createPaymentIntent(Request $request)
    {
        $request->validate(['amount' => 'required|numeric|min:0.5']);

        Stripe::setApiKey(config('services.stripe.secret'));

        $paymentIntent = PaymentIntent::create([
            'amount'   => (int) round($request->amount * 100),
            'currency' => 'eur',
        ]);

        return response()->json([
            'client_secret' => $paymentIntent->client_secret,
        ]);
    }

    public function confirmReservation(Request $request)
    {
        $reservation = \App\Models\Reservation::create([
            'user_id'         => $request->user()->id,
            'package_id'      => $request->package_id,
            'hotel_id'        => $request->hotel_id,
            'flight_id'       => $request->flight_id,
            'activity_id'     => $request->activity_id,
            'total_price'     => $request->total_price,
            'contact_email'   => $request->contact_email,
            'contact_phone'   => $request->contact_phone,
            'contact_name'    => $request->contact_name,
            'contact_dni'     => $request->contact_dni,
            'passengers_data' => $request->passengers_data,
            'extras'          => $request->extras,
            'status'          => 'confirmed',
        ]);

        try {
            $resend = \Resend::client((string) config('services.resend.api_key', ''));

            $extrasHtml = '';
            if (!empty($request->extras)) {
                $extrasHtml = '<h3 style="color:#1e293b;margin-top:24px;">Extras incluidos</h3><ul style="padding-left:20px;color:#475569;">';
                foreach ($request->extras as $extra) {
                    $extrasHtml .= "<li>{$extra['nombre']} — {$extra['precio']}€</li>";
                }
                $extrasHtml .= '</ul>';
            }

            $html = "
    <div style='font-family:sans-serif;max-width:600px;margin:0 auto;background:#f8fafc;padding:40px 20px;'>
      <div style='background:white;border-radius:20px;padding:40px;box-shadow:0 4px 6px rgba(0,0,0,0.05);'>
        <h1 style='color:#3b82f6;font-size:1.8rem;margin-bottom:8px;'>¡Reserva Confirmada! ✈️</h1>
        <p style='color:#64748b;font-size:1rem;margin-bottom:32px;'>Tu aventura está reservada. Aquí tienes todos los detalles.</p>
        <div style='background:#f1f5f9;border-radius:12px;padding:24px;margin-bottom:24px;'>
          <h2 style='color:#0f172a;margin-bottom:16px;font-size:1.1rem;'>Datos del titular</h2>
          <p style='margin:6px 0;color:#475569;'><strong>Nombre:</strong> {$request->contact_name}</p>
          <p style='margin:6px 0;color:#475569;'><strong>DNI:</strong> {$request->contact_dni}</p>
          <p style='margin:6px 0;color:#475569;'><strong>Email:</strong> {$request->contact_email}</p>
          <p style='margin:6px 0;color:#475569;'><strong>Teléfono:</strong> {$request->contact_phone}</p>
        </div>
        <div style='background:#f1f5f9;border-radius:12px;padding:24px;margin-bottom:24px;'>
          <h2 style='color:#0f172a;margin-bottom:16px;font-size:1.1rem;'>Resumen de la reserva</h2>
          <p style='margin:6px 0;color:#475569;'><strong>Nº de reserva:</strong> #{$reservation->id}</p>
          <p style='margin:6px 0;color:#475569;'><strong>Total pagado:</strong> <span style='color:#3b82f6;font-weight:700;'>{$reservation->total_price}€</span></p>
        </div>
        {$extrasHtml}
        <div style='margin-top:32px;padding-top:24px;border-top:1px solid #e2e8f0;text-align:center;color:#94a3b8;font-size:0.85rem;'>
          <p>Gracias por confiar en nosotros 🌍</p>
        </div>
      </div>
    </div>";

            $resend->emails->send([
                'from'    => 'TravelAI <onboarding@resend.dev>',
                'to'      => [$request->contact_email],
                'subject' => "¡Tu reserva #{$reservation->id} está confirmada! ✈️",
                'html'    => $html,
            ]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::warning('Email de confirmación no enviado: ' . $e->getMessage());
        }

        return response()->json(['success' => true, 'reservation' => $reservation]);
    }
}