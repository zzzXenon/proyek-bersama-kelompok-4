<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validate the login credentials
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Check if the username exists
        $user = \App\Models\User::where('username', $request->username)->first();

        if (!$user) {
            // Username not found
            return back()->withErrors(['username' => 'Username salah.'])->withInput();
        }

        // Attempt to authenticate with the provided credentials
        if (!Auth::attempt($request->only('username', 'password'))) {
            // Password incorrect
            return back()->withErrors(['password' => 'Password salah.'])->withInput();
        }

        // If authentication succeeds, redirect based on role
        $role = Auth::user()->role;

        if ($role === 'Orang Tua') {
            return redirect()->route('dashboard.orangtua');
        } elseif (in_array($role, ['Keasramaan', 'Kemahasiswaan', 'Komisi Disiplin', 'Rektor', 'Dosen'])) {
            return redirect()->route('dashboard.admin');
        }

        // Optional fallback for unknown roles
        return redirect()->route('login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
