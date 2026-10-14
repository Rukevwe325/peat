<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    // Show register page
    public function index()
    {
        return view('auth.register');
    }

    // Handle registration
    public function register(Request $request)
    {
        try {

            // Create user instance
            $user = new User();
            // Save user
            $user->forceFill([
                'first_name' => $request->first_name,
                'last_name'  => $request->last_name,
                'email'      => $request->email,
                'phone'      => $request->phone,
                'address'    => $request->address,
                'state'      => $request->state,
                'country'    => $request->country,
                'zip_code'   => $request->zip_code,
                'password'   => Hash::make($request->password),
            ])->save();

            // Auto login
            Auth::login($user);
                
            return redirect()->route('users.dashboard')->with('success', 'Registration successful! Welcome.');

        } catch (\Exception $e) {
            return back()
                ->withErrors(['register_error' => $e->getMessage()])
                ->withInput();
        }
    }

    public function login()
    {
        return view('auth.login');
    }
    public function loginSubmit(Request $request)
    {
        // No validation — just read the inputs
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        // Attempt login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()
                ->route('users.dashboard')
                ->with('success', 'Welcome back!');
        }

        // Failed login
        return back()
            ->withErrors(['login_error' => 'Invalid email or password.'])
            ->withInput();
    }

}
