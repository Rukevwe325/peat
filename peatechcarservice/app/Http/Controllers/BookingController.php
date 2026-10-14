<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Http\Requests\StoreBookingRequest;
use App\Mail\BookingConfirmationMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Admin;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function store(StoreBookingRequest $request)
    {
        // Handle file upload
        $carPhotoPath = null;
        if ($request->hasFile('car_photo')) {
            $carPhotoPath = $request->file('car_photo')->store('car_photos', 'public');
        }
        $admin = Admin::where('id', $request->service)->first();
        // Create booking record
        $booking = Booking::create([
            'name'           => $request->name,
            'email'          => $request->email,
            'service'        => $admin->email,
            'service_date'   => $request->service_date,
            'car_model'      => $request->car_model,
            'car_photo'      => $carPhotoPath,
            'special_request'=> $request->special_request,
            'status' => 'pending'
        ]);
        $start = Carbon::parse($admin->start_datetime);
        $end = Carbon::parse($admin->end_datetime);
        $selected = Carbon::parse($request->service_date);
        
        if ($selected->lt($start) || $selected->gt($end)) {
            // Time outside admin available range
            return back()->with('not_available', true);
        }
        
        // Send email
        Mail::to($booking->email)->send(new BookingConfirmationMail($booking));

        return back()->with('success', 'Your booking has been submitted successfully!');
    }
}
