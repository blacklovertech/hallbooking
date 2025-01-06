<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FacultyController extends Controller
{
    // Display the calendar
    public function index(Request $request)
    {
        // Get the user ID from the request, or use the authenticated user's ID
        $userId = $request->input('userId', auth()->id());
    
        // Retrieve bookings for the specified user
        $bookings = Booking::with(['user', 'hall'])
            ->where('userId', $userId) // Filter by user ID
            ->get();
    
        return view('admin.bookings.index', compact('bookings'));
    }
}
