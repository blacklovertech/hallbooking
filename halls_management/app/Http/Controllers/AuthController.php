<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle login form submission
    public function login(Request $request)
    {
        // Validate the login input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'remember' => 'boolean', // Optionally validate remember me input
        ]);

        // Attempt to login the user with remember me functionality
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
                return redirect()->route('dashboard'); // Admin dashboard         
        }

        // Redirect back with an error message if login fails
        return redirect()->route('login')->withErrors(['email' => 'Invalid credentials']);
    }

    // Logout the user
    public function logout()
    {
        Auth::logout(); // Logout the user
        return redirect()->route('login'); // Redirect back to the login page
    }
}
