<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Storage;

class ShopsController extends Controller
{
    /**
     * Get nearby shops based on user location
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function nearby(Request $request)
    {
        try {
            // 1️⃣ Validate incoming coordinates
            $validated = $request->validate([
                'latitude'  => 'required|numeric|between:-90,90',
                'longitude' => 'required|numeric|between:-180,180',
                'radius'    => 'nullable|numeric|min:1|max:50', // optional radius in KM
            ]);

            $userLat = $validated['latitude'];
            $userLng = $validated['longitude'];
            $radius = $validated['radius'] ?? 10; // Default 10 KM

            // 2️⃣ Haversine formula to calculate distance
            $shops = Admin::selectRaw("
                    id,
                    first_name,
                    last_name,
                    address,
                    latitude,
                    longitude,
                    profile_photo,
                    phone,
                    email,
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

            // 3️⃣ Format the response with full image URLs
            $formattedShops = $shops->map(function ($shop) {
                return [
                    'id' => $shop->id,
                    'name' => trim($shop->first_name . ' ' . $shop->last_name),
                    'first_name' => $shop->first_name,
                    'last_name' => $shop->last_name,
                    'address' => $shop->address ?? 'Address not provided',
                    'phone' => $shop->phone,
                    'email' => $shop->email,
                    'latitude' => (float) $shop->latitude,
                    'longitude' => (float) $shop->longitude,
                    'distance' => round($shop->distance, 2), // Distance in KM
                    'distance_miles' => round($shop->distance * 0.621371, 2), // Convert to miles
                    'profile_photo' => $shop->profile_photo 
                        ? url('storage/' . $shop->profile_photo) 
                        : null,
                ];
            });

            // 4️⃣ Return JSON response
            return response()->json([
                'success' => true,
                'message' => 'Shops retrieved successfully',
                'count' => $formattedShops->count(),
                'data' => $formattedShops,
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $e->errors(),
            ], 422);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve nearby shops',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get shop details by ID
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $shop = Admin::findOrFail($id);

            $shopData = [
                'id' => $shop->id,
                'name' => trim($shop->first_name . ' ' . $shop->last_name),
                'first_name' => $shop->first_name,
                'last_name' => $shop->last_name,
                'email' => $shop->email,
                'phone' => $shop->phone,
                'address' => $shop->address ?? 'Address not provided',
                'latitude' => (float) $shop->latitude,
                'longitude' => (float) $shop->longitude,
                'profile_photo' => $shop->profile_photo 
                    ? url('storage/' . $shop->profile_photo) 
                    : null,
                'created_at' => $shop->created_at,
                'updated_at' => $shop->updated_at,
            ];

            return response()->json([
                'success' => true,
                'message' => 'Shop details retrieved successfully',
                'data' => $shopData,
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Shop not found',
            ], 404);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve shop details',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get all shops (optional - for browsing)
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $shops = Admin::whereNotNull('latitude')
                ->whereNotNull('longitude')
                ->get()
                ->map(function ($shop) {
                    return [
                        'id' => $shop->id,
                        'name' => trim($shop->first_name . ' ' . $shop->last_name),
                        'address' => $shop->address ?? 'Address not provided',
                        'phone' => $shop->phone,
                        'latitude' => (float) $shop->latitude,
                        'longitude' => (float) $shop->longitude,
                        'profile_photo' => $shop->profile_photo 
                            ? url('storage/' . $shop->profile_photo) 
                            : null,
                    ];
                });

            return response()->json([
                'success' => true,
                'message' => 'All shops retrieved successfully',
                'count' => $shops->count(),
                'data' => $shops,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve shops',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}