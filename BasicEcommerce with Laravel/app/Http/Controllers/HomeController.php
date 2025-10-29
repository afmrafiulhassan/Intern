<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Maker;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $cars = Car::whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->with(['primaryImage', 'city', 'carType', 'fuelType', 'maker', 'model'])
            ->orderBy('published_at', 'desc')
            ->limit(30)
            ->get();

        // collect the currently authenticated user's favourite car IDs (empty array if guest)
        $favouriteIds = Car::join('favourite_cars', 'cars.id', '=', 'favourite_cars.car_id')
            ->where('favourite_cars.user_id', auth()->id())
            ->pluck('cars.id')
            ->toArray();


        return view('welcome', [
            'cars' => $cars,
            'favouriteIds' => $favouriteIds,
        ]);
    }
}
