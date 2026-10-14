<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    // Show the store settings form
    public function index()
    {
        return view('admin.store.settings');
    }

    // Save the store settings
    public function save(Request $request)
    {
        $store = new Store();
        $store->admin_id = Auth::guard('admin')->id();
        $store->store_name = $request->store_name;
        $store->store_address = $request->store_address;
        $store->state = $request->state;
        $store->available_hours = $request->opening_time . ' - ' . $request->closing_time;
        // Handle multiple image uploads
        if ($request->hasFile('store_images')) {
            $images = $request->file('store_images');
            if (isset($images[0])) {
                $store->image_1 = $images[0]->store('stores', 'public');
            }
            if (isset($images[1])) {
                $store->image_2 = $images[1]->store('stores', 'public');
            }
        }

        // Handle registration document
        if ($request->hasFile('registration_doc')) {
            $store->registration_doc = $request->file('registration_doc')->store('stores/docs', 'public');
        }
        $store->save();

        return redirect()->back()->with('success', 'Store settings saved successfully!');
    }

}
