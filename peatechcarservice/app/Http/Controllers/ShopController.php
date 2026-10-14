<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

class ShopController extends Controller
{
    public function index()
    {
        return view('shops.index');
    }
    public function nearby(Request $request)
    {
        // 1️⃣ Validate incoming coordinates
        $request->validate([
            'latitude'  => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $userLat = $request->latitude;
        $userLng = $request->longitude;

        // 2️⃣ Search radius (KM)
        $radius = 10;

        // 3️⃣ Haversine formula to calculate distance
        $shops = Admin::selectRaw("
                id,
                first_name,
                last_name,
                address,
                latitude,
                longitude,
                profile_photo,
                (
                    6371 * acos(
                        cos(radians(?)) *
                        cos(radians(latitude)) *
                        cos(radians(longitude) - radians(?)) +
                        sin(radians(?)) *
                        sin(radians(latitude))
                    )
                ) AS distance
            ", [$userLat, $userLng, $userLat])
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->having('distance', '<=', $radius)
            ->orderBy('distance')
            ->get();

        // 4️⃣ Return JSON response
        return response()->json([
            'success' => true,
            'count'   => $shops->count(),
            'data'    => $shops,
        ]);
    }

    public function show($id)
    {
        $shop = Admin::findOrFail($id);
        return view('shops.show', compact('shop'));
    }

    

}
