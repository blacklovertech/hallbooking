<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;

class UserController extends Controller
{
    // Display the logged-in user's profile
    public function profile()
    {
        return view('profile', ['user' => Auth::user()]);
    }

    // List all users (admin only)
    public function index()
    {
        $users = User::all();  // Fetch all users
        return view('admin.users.index', compact('users'));
    }

    public function show($id)
    {
        // Fetch the user by ID
        $user = User::findOrFail($id);
        
        // Fetch all bookings associated with the user
        // Assuming the user has a relationship with bookings via a 'bookings' method
        $bookings = $user->bookings; // Adjust if your relationship name differs
        
        // Return the view with the user details and bookings
        return view('admin.users.show', compact('user', 'bookings'));
    }
    

    // Show the form to create a new user (admin only)
    public function create()
    {
        return view('admin.users.create');
    }

    // Store a new user (admin only)
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'department' => 'required|string',
            'phone' => 'required|string|min:10',
            'usertype' => 'required|string',
        ]);

        // Hash the password before saving
        $request->merge(['password' => Hash::make($request->password)]);

        // Create the user
        User::create($request->all());

        // Redirect to the index route for users
        return redirect()->route('admin.users.index');
    }

    // Show the form to edit an existing user
    public function edit($id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);

        // Return the edit view with the user data
        return view('admin.users.edit', compact('user'));
    }

    // Update an existing user (admin only)
    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,  // Exclude current email from unique check
            'password' => 'nullable|string|min:8|confirmed',  // Allow password update if provided, and confirm the password
            'department' => 'required|string',
            'phone' => 'required|string|min:10',
        ]);

        // Find the user by ID
        $user = User::findOrFail($id);

        // Update the user data
        $user->name = $request->name;
        $user->email = $request->email;
        $user->department = $request->department;
        $user->phone = $request->phone;

        // If password is provided, hash and update it
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Save the updated user data
        $user->save();

        // Redirect to the users index with a success message
        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    // Delete a user (admin only)
    public function destroy($id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);

        // Delete the user
        $user->delete();

        // Redirect to the users index
        return redirect()->route('admin.users.index');
    }

    // Assign HOD role to a user (admin only)
    public function assignHod($id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);

        // Assign the 'hod' role
        $user->usertype = 'hod';
        $user->save();

        // Redirect to the users index
        return redirect()->route('admin.users.index');
    }

    // Assign Registrar role to a user (admin only)
    public function assignRegistrar($id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);

        // Assign the 'registrar' role
        $user->usertype = 'registrar';
        $user->save();

        // Redirect to the users index
        return redirect()->route('admin.users.index');
    }
}