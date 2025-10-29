<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Maker;
use App\Models\CarType;
use App\Models\FuelType;
use App\Models\State;
use App\Models\CarImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class CarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['search', 'show']);
    }

    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $cars = $user->cars()
            ->with(['primaryImage', 'maker', 'model'])
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('car.index', ['cars' => $cars]);
    }

    public function create()
    {
        $makers = Maker::with('models')->get();
        $states = State::with('cities')->get();
        $carTypes = CarType::all();
        $fuelTypes = FuelType::all();

        return view('car.create', [
            'makers'     => $makers,
            'states'     => $states,
            'carTypes'   => $carTypes,
            'fuelTypes'  => $fuelTypes,
            'makersJson' => $makers->map(fn($m) => [
                'id' => $m->id,
                'models' => $m->models->map(fn($mo) => [
                    'id' => $mo->id,
                    'name' => $mo->name,
                ])->toArray(),
            ])->toArray(),
            'statesJson' => $states->map(fn($s) => [
                'id' => $s->id,
                'cities' => $s->cities->map(fn($c) => [
                    'id' => $c->id,
                    'name' => $c->name,
                ])->toArray(),
            ])->toArray(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'maker_id'     => 'required|exists:makers,id',
            'model_id'     => 'required|exists:models,id',
            'year'         => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'price'        => 'required|numeric',
            'vin'          => 'required|string|unique:cars,vin',
            'mileage'      => 'required|integer',
            'car_type_id'  => 'required|exists:car_types,id',
            'fuel_type_id' => 'required|exists:fuel_types,id',
            'state_id'     => 'required|exists:states,id',
            'city_id'      => 'required|exists:cities,id',
            'address'      => 'required|string',
            'phone'        => 'required|string',
            'description'  => 'nullable|string',
            'images.*'     => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to add a car.');
        }

        $car = DB::transaction(function () use ($request, $validated) {
            $car = Car::create([
                'maker_id'     => $validated['maker_id'],
                'model_id'     => $validated['model_id'],
                'year'         => $validated['year'],
                'price'        => $validated['price'],
                'vin'          => $validated['vin'],
                'mileage'      => $validated['mileage'],
                'car_type_id'  => $validated['car_type_id'],
                'fuel_type_id' => $validated['fuel_type_id'],
                'user_id'      => Auth::id(),
                'city_id'      => $validated['city_id'],
                'address'      => $validated['address'],
                'phone'        => $validated['phone'],
                'description'  => $validated['description'] ?? null,
                'published_at' => $request->boolean('published') ? now() : null,
            ]);

            // create car features
            $car->features()->create([
                'abs'                    => $request->has('abs'),
                'air_conditioning'       => $request->has('air_conditioning'),
                'power_windows'          => $request->has('power_windows'),
                'power_door_locks'       => $request->has('power_door_locks'),
                'cruise_control'         => $request->has('cruise_control'),
                'bluetooth_connectivity' => $request->has('bluetooth_connectivity'),
                'remote_start'           => $request->has('remote_start'),
                'gps_navigation'         => $request->has('gps_navigation'),
                'heated_seats'           => $request->has('heated_seats'),
                'climate_control'        => $request->has('climate_control'),
                'rear_parking_sensors'   => $request->has('rear_parking_sensors'),
                'leather_seats'          => $request->has('leather_seats'),
            ]);

            // save uploaded images
            if ($request->hasFile('images')) {
                Storage::disk('public')->makeDirectory('cars'); // ensure folder exists

                foreach ($request->file('images') as $idx => $file) {
                    $extension = $file->getClientOriginalExtension();
                    $filename = 'car-' . $car->id . '-' . now()->format('Ymd-His') . '-' . uniqid() . '.' . $extension;

                    $path = $file->storeAs('cars', $filename, 'public');

                    $car->images()->create([
                        'image_path' => $path,
                        'position'   => $idx + 1,
                    ]);
                }
            }

            return $car;
        });

        return redirect()->route('car.index')->with('success', 'Car created successfully!');
    }


    public function show(Car $car)
    {
        if (is_null($car->published_at) || $car->published_at->isFuture()) {
            if (!Auth::check() || Auth::id() !== $car->user_id) {
                abort(404); // hide existence from public
            }
        }

        return view('car.show', ['car' => $car]);
    }

    public function edit(Car $car)
    {
        abort_if(Auth::id() !== $car->user_id, 403);

        $makers   = Maker::with('models')->get();
        $carTypes = CarType::all();
        $fuelTypes = FuelType::all();
        $states   = State::with('cities')->get();

        return view('car.edit', [
            'car' => $car,
            'makers' => $makers,
            'carTypes' => $carTypes,
            'fuelTypes' => $fuelTypes,
            'states' => $states,
            'makersJson' => $makers->map(fn($m) => [
                'id' => $m->id,
                'models' => $m->models->map(fn($mo) => [
                    'id' => $mo->id,
                    'name' => $mo->name,
                ])->toArray(),
            ])->toArray(),
            'statesJson' => $states->map(fn($s) => [
                'id' => $s->id,
                'cities' => $s->cities->map(fn($c) => [
                    'id' => $c->id,
                    'name' => $c->name,
                ])->toArray(),
            ])->toArray(),
        ]);
    }

    /**
     * Update a car (atomic).
     */
    public function update(Request $request, Car $car)
    {
        abort_if(Auth::id() !== $car->user_id, 403);

        $validated = $request->validate([
            'maker_id'     => 'required|exists:makers,id',
            'model_id'     => 'required|exists:models,id',
            'year'         => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'price'        => 'required|numeric',
            'vin'          => 'required|string|unique:cars,vin,' . $car->id,
            'mileage'      => 'required|integer',
            'car_type_id'  => 'required|exists:car_types,id',
            'fuel_type_id' => 'required|exists:fuel_types,id',
            'state_id'     => 'required|exists:states,id',
            'city_id'      => 'required|exists:cities,id',
            'address'      => 'required|string',
            'phone'        => 'required|string',
            'description'  => 'nullable|string',
            'images.*'     => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        DB::transaction(function () use ($request, $validated, $car) {
            $car->update([
                'maker_id'     => $validated['maker_id'],
                'model_id'     => $validated['model_id'],
                'year'         => $validated['year'],
                'price'        => $validated['price'],
                'vin'          => $validated['vin'],
                'mileage'      => $validated['mileage'],
                'car_type_id'  => $validated['car_type_id'],
                'fuel_type_id' => $validated['fuel_type_id'],
                'city_id'      => $validated['city_id'],
                'address'      => $validated['address'],
                'phone'        => $validated['phone'],
                'description'  => $validated['description'] ?? null,
                'published_at' => $request->boolean('published') ? now() : null,
            ]);

            // update or create features safely
            $featuresData = [
                'abs'                    => $request->has('abs'),
                'air_conditioning'       => $request->has('air_conditioning'),
                'power_windows'          => $request->has('power_windows'),
                'power_door_locks'       => $request->has('power_door_locks'),
                'cruise_control'         => $request->has('cruise_control'),
                'bluetooth_connectivity' => $request->has('bluetooth_connectivity'),
                'remote_start'           => $request->has('remote_start'),
                'gps_navigation'         => $request->has('gps_navigation'),
                'heated_seats'           => $request->has('heated_seats'),
                'climate_control'        => $request->has('climate_control'),
                'rear_parking_sensors'   => $request->has('rear_parking_sensors'),
                'leather_seats'          => $request->has('leather_seats'),
            ];
            $car->features()->updateOrCreate([], $featuresData);

            // store new images (if any)
            if ($request->hasFile('images')) {
                Storage::disk('public')->makeDirectory('cars'); // ensure folder exists

                $lastPosition = $car->images()->max('position') ?? 0;
                foreach ($request->file('images') as $idx => $file) {
                    $extension = $file->getClientOriginalExtension();
                    $filename = 'car-' . $car->id . '-' . now()->format('Ymd-His') . '-' . uniqid() . '.' . $extension;

                    $path = $file->storeAs('cars', $filename, 'public');

                    $car->images()->create([
                        'image_path' => $path,
                        'position'   => $lastPosition + $idx + 1,
                    ]);
                }
            }
        });

        return redirect()->route('car.show', $car->id)->with('success', 'Car updated successfully!');
    }


    public function destroy(Car $car)
    {
        abort_if(Auth::id() !== $car->user_id, 403);

        // soft-delete (since model uses SoftDeletes)
        $car->delete();

        return redirect()->route('car.index')->with('success', 'Car deleted successfully!');
    }

    public function search(Request $request)
    {
        $query = Car::query()
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->with(['primaryImage', 'city', 'carType', 'fuelType', 'maker', 'model']);

        if ($request->filled('maker_id')) {
            $query->where('maker_id', $request->maker_id);
        }

        if ($request->filled('model_id')) {
            $query->where('model_id', $request->model_id);
        }

        if ($request->filled('state_id')) {
            $query->whereHas('city', function ($q) use ($request) {
                $q->where('state_id', $request->state_id);
            });
        }

        if ($request->filled('city_id')) {
            $query->where('city_id', $request->city_id);
        }

        if ($request->filled('car_type_id')) {
            $query->where('car_type_id', $request->car_type_id);
        }

        if ($request->filled('fuel_type_id')) {
            $query->where('fuel_type_id', $request->fuel_type_id);
        }

        if ($request->filled('year_from')) {
            $query->where('year', '>=', $request->year_from);
        }

        if ($request->filled('year_to')) {
            $query->where('year', '<=', $request->year_to);
        }

        if ($request->filled('price_from')) {
            $query->where('price', '>=', $request->price_from);
        }

        if ($request->filled('price_to')) {
            $query->where('price', '<=', $request->price_to);
        }

        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'newest':
                    $query->orderBy('published_at', 'desc');
                    break;
                case 'oldest':
                    $query->orderBy('published_at', 'asc');
                    break;
                default:
                    $query->orderBy('published_at', 'desc');
            }
        } else {
            $query->orderBy('published_at', 'desc');
        }
        $cars = $query->paginate(15)->appends($request->query());
        $favouriteIds = [];

        if (Auth::check()) {
            $favouriteIds = Car::join('favourite_cars', 'cars.id', '=', 'favourite_cars.car_id')
                ->where('favourite_cars.user_id', Auth::id())
                ->pluck('cars.id')
                ->toArray();
        }
        return view('car.search', [
            'cars' => $cars,
            'favouriteIds' => $favouriteIds,
        ]);
    }



    public function watchlist()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to view your favourite cars.');
        }

        $cars = Auth::user()
            ->favouriteCars()
            ->with(['primaryImage', 'city', 'carType', 'fuelType', 'maker', 'model'])
            ->select('cars.*')
            ->orderByDesc('cars.created_at')
            ->paginate(15);

        return view('car.watchlist', ['cars' => $cars]);
    }


    public function deleteImage($id)
    {
        $image = CarImage::findOrFail($id);

        $car = $image->car ?? null;
        if (!$car || Auth::id() !== $car->user_id) {
            abort(403);
        }

        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        return response()->json(['success' => true]);
    }

    public function reorderImages(Request $request)
    {
        $order = $request->input('order', []);
        if (!is_array($order)) {
            return response()->json(['success' => false, 'message' => 'Invalid order'], 400);
        }

        DB::transaction(function () use ($order) {
            foreach ($order as $index => $id) {
                $image = CarImage::find($id);
                if (!$image) {
                    continue;
                }

                $car = $image->car ?? null;
                if (!$car || Auth::id() !== $car->user_id) {
                    continue;
                }

                $image->position = $index + 1;
                $image->save();
            }
        });

        return response()->json(['success' => true]);
    }
}
