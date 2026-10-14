<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.auth.login');
    }

    public function showRegisterForm(){
        return view('admin.auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name'        => 'required|string|max:50',
            'last_name'         => 'required|string|max:50',
            'phone'             => 'required|string|max:20',
            'email'             => 'required|email|unique:admins,email',
            'password'          => 'required|min:6|confirmed',
            'address'           => 'required|string|max:255',
        ]);

        // Prepare clean FirstName (letters only, capitalized)
        $firstRaw = preg_replace('/[^A-Za-z]/', '', $request->first_name);
        $firstNameClean = $firstRaw ? ucfirst(strtolower($firstRaw)) : 'Admin';

        // Generate unique username like Firstname_4CHAR_PT (e.g. Gaius_04A7_PT)
        do {
            $randomPart = strtoupper(Str::random(4));
            $username = "{$firstNameClean}_{$randomPart}_PT";
        } while (Admin::where('user_name', $username)->exists());

        // Handle profile photo upload (if provided)
        $profilePhotoPath = null;
        if ($request->hasFile('profile_photo')) {
            $profilePhotoPath = $request->file('profile_photo')->store('admin_photos', 'public');
        }

        // Create admin
        Admin::create([
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'phone'         => $request->phone,
            'email'         => $request->email,
            'user_name'     => $username,
            'password'      => Hash::make($request->password),
            'profile_photo' => $profilePhotoPath,
            'role'          => 'Admin',
            'latitude'      => $request->latitude,
            'longitude'     => $request->longitude,
            'address'       => $request->address,
        ]);

        // ✅ API call (Flutter) — return JSON
        if ($request->expectsJson() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Account created successfully.',
            ], 201);
        }

        // ✅ Web form — return redirect as before
        return redirect()
            ->route('admin.login')
            ->with('success', 'Account created successfully. Please log in.');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {
            // ✅ API call (Flutter) — return JSON
            if ($request->expectsJson() || $request->wantsJson()) {
                $admin = Auth::guard('admin')->user();
                return response()->json([
                    'success' => true,
                    'message' => 'Login successful.',
                    'data'    => $admin,
                ], 200);
            }

            return redirect()->route('admin.dashboard.index');
        }

        // ✅ API call (Flutter) — return JSON error
        if ($request->expectsJson() || $request->wantsJson()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid login details.',
            ], 401);
        }

        return back()->withErrors(['email' => 'Invalid login details']);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        // ✅ API call (Flutter) — return JSON
        if ($request->expectsJson() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Logged out successfully.',
            ], 200);
        }

        return redirect()->route('admin.login');
    }
}