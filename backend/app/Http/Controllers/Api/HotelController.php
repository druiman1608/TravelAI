<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HotelResource;
use Illuminate\Http\Request;
use App\Models\Hotel;

class HotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::all();
        //$hotels = Hotel::paginate(5);
        //return response()->json($hotels, 200);

        return HotelResource::collection($hotels);
    }
}
