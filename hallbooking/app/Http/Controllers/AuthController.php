<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // Show the login form
    public function index()
    {
        return view('auth.login');
    }

    // Handle the login request
    public function login(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log the user in
        if (Auth::attempt($request->only(['email', 'password']))) {
            // Check the user type and redirect accordingly
            $user = Auth::user();

            if ($user->usertype === 'admin') {
                return redirect('/admin/dashboard')->with('success', 'Welcome, Admin!');
            } elseif ($user->usertype === 'registrar') {
                return redirect('/registrar/dashboard')->with('success', 'Welcome, Registrar!');
            } elseif ($user->usertype === 'hod') {
                return redirect('/hod/dashboard')->with('success', 'Welcome, HOD!');
            }elseif ($user->usertype === 'faculty') {
                return redirect('/faculty/dashboard')->with('success', 'Welcome, Faculty!');
            } else {
                return redirect('/dashboard')->with('success', 'Welcome!');
            }
        }

        // If login fails, redirect back with an error message
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // Handle logout
    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Logged out successfully.');
    }

    public function registerview()
    {
        return view('auth.register');
    }

    // Handle user registration
    public function register(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'institution' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:15',
            'usertype' => 'required|string|max:50',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create the user with the hashed password
        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'institution' => $validatedData['institution'] ?? null,
            'department' => $validatedData['department'] ?? null,
            'phone' => $validatedData['phone'] ?? null,
            'usertype' => $validatedData['usertype'],
            'password' => bcrypt($validatedData['password']),
        ]);

        return redirect()->route('auth.login')->with('success', 'Registration successful. Please log in.');
    }
}
