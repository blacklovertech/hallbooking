<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hall;
use App\Models\Event;
use App\Models\Facility;

class BookingController extends Controller
{
    // Show the bookings view
    public function view()
    {
        // Example: Fetch all bookings or filtered bookings
        $bookings = Booking::all(); // Modify this based on your requirements (e.g., by user)

        return view('bookings.view', compact('bookings'));
    }

    // Show the add booking view
    public function add()
    {
        // Fetch data that might be needed for the booking form, such as events, halls, and facilities
        $events = Event::all();
        $halls = Hall::all();
        $facilities = Facility::all();

        // Return the view and pass the data
        return view('bookings.add', compact('events', 'halls', 'facilities'));
    }

    // Handle the booking submission (this can be added for storing a booking)
    public function store(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'hall_id' => 'required|exists:halls,id',
            'facilities' => 'required|array',
            'purpose_of_hall' => 'required|string',
            'seating_capacity_required' => 'required|integer',
            'booking_date' => 'required|date',
            'event_time_from' => 'required|date_format:H:i',
            'event_time_to' => 'required|date_format:H:i',
        ]);

        // Create the new booking (you can add additional logic for approvals if needed)
        $booking = Booking::create([
            'event_id' => $request->event_id,
            'user_id' => auth()->id(), // assuming the user is logged in
            'hall_id' => $request->hall_id,
            'facilities_ids' => json_encode($request->facilities),
            'purpose_of_hall' => $request->purpose_of_hall,
            'seating_capacity_required' => $request->seating_capacity_required,
            'booking_date' => $request->booking_date,
            'event_time_from' => $request->event_time_from,
            'event_time_to' => $request->event_time_to,
            'booking_number' => uniqid('BK-', true), // Generate a unique booking number
        ]);

        // Optionally, redirect or show a success message
        return redirect()->route('bookings.view')->with('success', 'Booking created successfully!');
    }
}
