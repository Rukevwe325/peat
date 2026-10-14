<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\Models\Booking;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\Admin;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // $bookings = Booking::latest()->get();
        // $totalBookings = Booking::count();
        // $pendingBookings = Booking::where('status', 'pending')->count();
        // $confirmedBookings = Booking::where('status', 'confirmed')->count();

        // return view('admin.dashboard.index', compact(
        //     'totalBookings',
        //     'pendingBookings',
        //     'confirmedBookings',
        //     'bookings'
        // ));

        

        $adminId = auth('admin')->id();

        /* Existing query (unchanged) */
        $appointments = Appointment::where('admin_id', $adminId)
            ->latest()
            ->get();

        /* NEW: Dashboard counts */
        $totalBookings = Appointment::where('admin_id', $adminId)->count();

        $pendingBookings = Appointment::where('admin_id', $adminId)
            ->where('status', 'pending')
            ->count();

        $confirmedBookings = Appointment::where('admin_id', $adminId)
            ->whereIn('status', ['ongoing', 'completed'])
            ->count();

        /* Return everything */
        return view('admin.dashboard.index', compact(
            'appointments',
            'totalBookings',
            'pendingBookings',
            'confirmedBookings'
        ));

    }
    public function updateAvailableTime(Request $request)
    {
        $request->validate([
            'start_datetime' => 'required|date',
            'end_datetime'   => 'required|date|after:start_datetime',
        ]);
    

        $admin = auth('admin')->user();
        // dd($admin);

        $admin->start_datetime = $request->start_datetime;
        $admin->end_datetime   = $request->end_datetime;

        // “June 5, 2025 – 2:00 PM to 4:30 PM”
        $admin->available_range = 
            Carbon::parse($request->start_datetime)->format('F j, Y • g:i A') .
            ' - ' .
            Carbon::parse($request->end_datetime)->format('F j, Y • g:i A');

        $admin->save();

        return back()->with('success', 'Availability successfully updated.');
    }
    public function settings(){
        return view('admin.settings.index');
    }

}
