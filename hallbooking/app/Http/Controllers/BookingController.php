<?php
namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingDate;
use App\Models\BookingTimeSlot;
use Illuminate\Http\Request;
use App\Models\Hall;
use App\Models\User;
use App\Models\Amenities;

use Illuminate\Support\Str;

class BookingController extends Controller
{
    // Create a new booking

    public function index()
    {
        $bookings = Booking::with(['user', 'hall'])->get();
       
        return view('admin.bookings.index', compact('bookings'));
    }

    public function show($id)
    {
        // Fetch the booking with related user, hall, and dates.timeSlots using eager loading
        $booking = Booking::with(['user', 'hall', 'dates.timeSlots'])->findOrFail($id);
        
        // Get the first and last booking date for the event start and end dates
        $eventStartDate = $booking->dates->first()->booking_date; // Assuming dates are ordered
        $eventEndDate = $booking->dates->last()->booking_date;  // Assuming dates are ordered
    
        // Initialize an empty array for amenities
        $amenities = [];
    
        // Check if the booking has amenities
        if ($booking->amenities) {
            // Decode the amenities JSON string into an array of IDs
            $amenityIds = json_decode($booking->amenities, true);
    
            // If decoding was successful and we have an array of IDs
            if (is_array($amenityIds) && !empty($amenityIds)) {
                // Fetch amenities based on the IDs and only select 'id' and 'name' fields
                $amenities = Amenities::whereIn('id', $amenityIds)
                    ->pluck('name', 'id') // This will return an associative array [id => name]
                    ->toArray();
            }
        }
    
        // Return the view with booking details, event dates, and amenities
        return view('admin.bookings.show', compact('booking', 'eventStartDate', 'eventEndDate', 'amenities'));
    }
    

    public function create()
    {
        $halls = Hall::all();
        $users = User::all();
        $amenities = Amenities::all();

        return view('admin.bookings.create', compact('halls', 'users', 'amenities'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'event_name' => 'required|string|max:255',
        'capacity_required' => 'required|string|max:255',
        'organising_club' => 'required|string|max:255',
        'hall_id' => 'required|exists:halls,id',
        'booking_dates' => 'required|array',
        'booking_dates.*' => 'required|date',
        'start_times' => 'required|array',
        'end_times' => 'required|array',
        'amenities' => 'nullable|array',
        'pdf' => 'nullable|file|mimes:pdf|max:2048',
        'reason' => 'required|string|max:500',
    ]);
 
    $pdfPath = NULL; 

    if ($request->hasFile('pdf') && $request->file('pdf')->isValid()) {
        $randomFileName = uniqid() . '.' . $request->file('pdf')->getClientOriginalExtension();
        $pdfPath = $request->file('pdf')->storeAs($randomFileName,'pdf'); 
    }
    
    return $pdfPath;
    
    // Continue with creating the booking entry
    $userId = auth()->id();

    // Create a new booking entry
    $booking = Booking::create([
        'eventName' => $request->event_name,
        'hallId' => $request->hall_id,
        'reason' => $request->reason,
        'pdf' => $pdfPath,
        'userId' => $userId,
        'organisingClub' => $request->organising_club,
        'capacityRequired' => $request->capacity_required,
    ]);


    // Store booking dates and times
    foreach ($request->booking_dates as $index => $date) {
        $booking->dates()->create([
            'booking_date' => $date,
            'start_time' => $request->start_times[$index],
            'end_time' => $request->end_times[$index],
        ]);
    }

    // Store amenities as JSON
    if ($request->has('amenities') && is_array($request->amenities)) {
        $booking->update([
            'amenities' => json_encode($request->amenities),
        ]);
    }

    return redirect()->route('admin.bookings.index')->with('success', 'Booking created successfully');
}




    
 
}