<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Admin;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * Store booking - API Version
     * Returns JSON response instead of redirect
     */
    public function store(Request $request, Admin $admin)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'car_model' => 'nullable|string|max:255',
            'car_photo' => 'nullable|image|max:2048',
            'preferred_date' => 'required|date',
            'preferred_time' => 'required',
            'service_description' => 'nullable|string',
        ]);

        // If validation fails, return error response
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Handle car photo upload
            $carPhotoPath = null;
            if ($request->hasFile('car_photo')) {
                $carPhotoPath = $request->file('car_photo')->store('appointments', 'public');
            }

            // Create appointment
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

            // Return JSON success response
            return response()->json([
                'success' => true,
                'message' => 'Appointment booked successfully!',
                'data' => [
                    'appointment' => [
                        'id' => $appointment->id,
                        'admin_id' => $appointment->admin_id,
                        'full_name' => $appointment->full_name,
                        'phone' => $appointment->phone,
                        'car_model' => $appointment->car_model,
                        'car_photo_url' => $appointment->car_photo ? asset('storage/' . $appointment->car_photo) : null,
                        'preferred_date' => $appointment->preferred_date,
                        'preferred_time' => $appointment->preferred_time,
                        'service_description' => $appointment->service_description,
                        'created_at' => $appointment->created_at,
                    ]
                ]
            ], 201);

        } catch (\Exception $e) {
            // Return JSON error response
            return response()->json([
                'success' => false,
                'message' => 'Failed to create appointment',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}