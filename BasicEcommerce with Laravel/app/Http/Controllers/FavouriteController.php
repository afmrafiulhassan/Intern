<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Car;

class FavouriteController extends Controller
{
    public function toggle(Request $request, Car $car)
    {
        if (!Auth::check()) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
            }
            return redirect()->route('login')->with('error', 'Please login first.');
        }

        $user = Auth::user();

        $exists = $user->favouriteCars()->where('car_id', $car->id)->exists();

        if ($exists) {
            $user->favouriteCars()->detach($car->id);
            $action = 'removed';
        } else {
            $user->favouriteCars()->attach($car->id);
            $action = 'added';
        }
        return response()->json([
            'success' => true,
            'action' => $action,
            'car_id' => $car->id
        ]);
    }
}
