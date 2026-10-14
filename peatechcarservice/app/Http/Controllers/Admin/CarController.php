<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    // Show the form
    public function create()
    {
        return view('admin.cars.index');
    }

    // Store the car
    public function store(Request $request)
    {
        // Handle image uploads
        $image1Path = $request->file('image_1')->store('cars', 'public');
        $image2Path = $request->file('image_2')->store('cars', 'public');
        $image3Path = $request->file('image_3')->store('cars', 'public');

        // Create car with admin_id
        $car = Car::create([
            'name'        => $request->name,
            'price'       => $request->price,
            'model'       => $request->model,
            'year'        => $request->year,
            'description' => $request->description,
            'image_1'     => $image1Path,
            'image_2'     => $image2Path,
            'image_3'     => $image3Path,
            'admin_id'    => auth()->guard('admin')->id(), // <-- track admin
        ]);

        return redirect()->route('admin.cars.create')
                         ->with('success', 'Car uploaded successfully!');
    }
}
