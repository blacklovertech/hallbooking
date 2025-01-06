<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingDate;
use App\Models\BookingTimeSlot;
use App\Models\Amenity;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CalendarController extends Controller
{
    // Display the calendar view
    public function index()
    {
        $bookings = Booking::with(['dates', 'timeSlots', 'amenities'])->get();
        return view('calendar.index', compact('bookings'));
    }

    // Handle the booking form submission
    public function createBooking(Request $request)
    {
        // Validate incoming data
        $request->validate([
            'userId' => 'required|integer',
            'hallId' => 'required|integer',
            'eventName' => 'required|string|max:255',
            'reason' => 'nullable|string|max:50',
            'capacityRequired' => 'nullable|integer',
            'amenities' => 'nullable|array',
            'amenities.*' => 'exists:amenities,id',
            'booking_dates' => 'required|array',
            'booking_dates.*' => 'date',
            'time_slots' => 'required|array',
            'time_slots.*' => 'array',  // Each item should be a start_time, end_time pair
        ]);

        // Create the booking
        $booking = Booking::create([
            'userId' => $request->userId,
            'hallId' => $request->hallId,
            'eventName' => $request->eventName,
            'reason' => $request->reason,
            'capacityRequired' => $request->capacityRequired,
            'amenities' => json_encode($request->amenities),
            'hodApproved' => false,
            'registrarApproved' => false,
        ]);

        // Save the booking dates
        foreach ($request->booking_dates as $date) {
            BookingDate::create([
                'booking_id' => $booking->id,
                'booking_date' => $date,
            ]);
        }

        // Save the time slots for the booking
        foreach ($request->time_slots as $date_id => $slots) {
            foreach ($slots as $slot) {
                BookingTimeSlot::create([
                    'date_id' => $date_id,
                    'start_time' => $slot['start_time'],
                    'end_time' => $slot['end_time'],
                ]);
            }
        }

        return redirect()->route('calendar.index')->with('success', 'Booking created successfully!');
    }

    // Approve a booking (e.g., by HOD or Registrar)
    public function approveBooking(Request $request, $bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
        
        if ($request->has('hodApproved')) {
            $booking->update(['hodApproved' => true]);
        }

        if ($request->has('registrarApproved')) {
            $booking->update(['registrarApproved' => true]);
        }

        return redirect()->route('calendar.index')->with('success', 'Booking approved successfully!');
    }

    // Fetch amenities for the selected hall
    public function getAmenitiesForHall($hallId)
    {
        $amenities = Amenity::all();
        return response()->json($amenities);
    }

    // Check if the date and time slot is available
    public function checkAvailability(Request $request)
    {
        $date = Carbon::parse($request->date);
        $timeSlotStart = Carbon::parse($request->start_time);
        $timeSlotEnd = Carbon::parse($request->end_time);
        
        // Check if the booking overlaps with existing bookings
        $existingBookings = Booking::whereHas('dates', function($query) use ($date) {
            $query->where('booking_date', $date->toDateString());
        })
        ->whereHas('timeSlots', function($query) use ($timeSlotStart, $timeSlotEnd) {
            $query->whereBetween('start_time', [$timeSlotStart, $timeSlotEnd])
                  ->orWhereBetween('end_time', [$timeSlotStart, $timeSlotEnd])
                  ->orWhere(function($query) use ($timeSlotStart, $timeSlotEnd) {
                      $query->where('start_time', '<', $timeSlotEnd)
                            ->where('end_time', '>', $timeSlotStart);
                  });
        })->exists();

        if ($existingBookings) {
            return response()->json(['status' => 'unavailable'], 409);
        }

        return response()->json(['status' => 'available']);
    }

    // Show the booking details
    public function show($bookingId)
    {
        $booking = Booking::with(['dates', 'timeSlots', 'amenities'])->findOrFail($bookingId);
        return view('calendar.show', compact('booking'));
    }
}
