<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Admin;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    // Store booking
    public function store(Request $request, Admin $admin)
    {
        // Remove the dd() when testing is done
        // dd("Gaius");
        
        $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'car_model' => 'nullable|string|max:255',
            'car_photo' => 'nullable|image|max:2048',
            'preferred_date' => 'required|date',
            'preferred_time' => 'required',
            'service_description' => 'nullable|string',
        ]);

        $carPhotoPath = null;
        if ($request->hasFile('car_photo')) {
            $carPhotoPath = $request->file('car_photo')->store('appointments', 'public');
        }

        $appointment = Appointment::create([
            'admin_id' => $admin->id,
            'full_name' => $request->full_name,
            'phone' => $request->phone,
            'car_model' => $request->car_model,
            'car_photo' => $carPhotoPath,
            'preferred_date' => $request->preferred_date,
            'preferred_time' => $request->preferred_time,
            'service_description' => $request->service_description,
        ]);

        return redirect()->back()->with('success', 'Appointment booked successfully!');
    }
}
