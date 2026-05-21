<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FlightOffer;
use App\Http\Resources\FlightOfferResource;
use App\Http\Requests\FlightOfferReq\FlightOfferRequest;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class FlightOfferApiController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $query = FlightOffer::with([
            'outboundFlight.origin',
            'outboundFlight.destination',
            'returnFlight.origin',
            'returnFlight.destination'
        ]);

        if ($request->has('search')) {
            $search = $request->query('search');
            $query->whereHas('outboundFlight', function ($q) use ($search) {
                $q->where('airline', 'like', "%{$search}%")
                    ->orWhereHas('origin', function ($cityQ) use ($search) {
                        $cityQ->where('city', 'like', "%{$search}%");
                    });
            });
        }

        return $this->success(FlightOfferResource::collection($query->get()), 'Ofertas de vuelo recuperadas.');
    }

    public function store(FlightOfferRequest $request)
    {
        $offer = FlightOffer::create($request->validated());
        return $this->success(new FlightOfferResource($offer), 'Oferta de vuelo creada correctamente', 201);
    }

    public function show($id)
    {
        $offer = FlightOffer::with([
            'outboundFlight.origin',
            'outboundFlight.destination',
            'outboundFlight' => fn($q) => $q->with([
                'origin',
                'destination',
                'reviews' => fn($r) => $r->where('status', 'approved')->with('user'),
            ]),
            'returnFlight.origin',
            'returnFlight.destination'
        ])->find($id);

        if (!$offer) {
            return $this->error("La oferta de vuelo con ID {$id} no existe.", 404);
        }

        return $this->success(new FlightOfferResource($offer));
    }

    public function update(FlightOfferRequest $request, FlightOffer $flightOffer)
    {
        $flightOffer->update($request->validated());
        return $this->success(new FlightOfferResource($flightOffer), 'Oferta de vuelo actualizada.');
    }

    public function destroy(FlightOffer $flightOffer)
    {
        $flightOffer->delete();
        return $this->success(null, 'Oferta de vuelo eliminada correctamente.');
    }
}