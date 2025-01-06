<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use App\Models\Hall;
use App\Models\Amenities;
use App\Models\BookingDate;
use App\Models\BookingTimeSlot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    /**
     * Display a list of bookings.
     */
    public function index()
    {
        $bookings = Booking::with(['user', 'hall'])->get();
       
        return view('admin.bookings.index', compact('bookings'));
    }

    /**
     * Show the booking creation form.
     */
    public function create()
    {
        $halls = Hall::all();
        $users = User::all();
        $amenities = Amenities::all();

        return view('admin.bookings.create', compact('halls', 'users', 'amenities'));
    }

    /**
     * Store a new booking.
     */
    public function store(Request $request)
    {
        // Validate the input data
        $validator = Validator::make($request->all(), [
            'hall_id' => 'required|exists:halls,id',
            'dates' => 'required|array',
            'dates.*' => 'required|date|after_or_equal:today',
            'from_time_slots' => 'required|array',
            'from_time_slots.*' => 'required|date_format:H:i',
            'to_time_slots' => 'required|array',
            'to_time_slots.*' => 'required|date_format:H:i|after:from_time_slots.*',
            'amenities' => 'nullable|array',
            'pdf' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        // Log validation errors if they exist
        if ($validator->fails()) {
            Log::error('Validation failed for booking store:', $validator->errors()->toArray());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            // Begin a database transaction
            \DB::beginTransaction();

            // Create the booking
            $pdfPath = null;
            if ($request->hasFile('pdf')) {
                $pdfPath = $request->file('pdf')->store('bookings/pdfs', 'public');
            }

            $booking = Booking::create([
                'hall_id' => $request->hall_id,
                'user_id' => auth()->id(),
                'status' => 'pending',
                'pdf_path' => $pdfPath,
            ]);

            // Process each date and its associated time slots
            foreach ($request->dates as $index => $date) {
                $bookingDate = BookingDate::create([
                    'booking_id' => $booking->id,
                    'date' => $date,
                ]);

                // Process time slots for the current date
                $fromTimeSlots = $request->from_time_slots[$index] ?? [];
                $toTimeSlots = $request->to_time_slots[$index] ?? [];

                foreach ($fromTimeSlots as $slotIndex => $fromTime) {
                    $toTime = $toTimeSlots[$slotIndex] ?? null;

                    // Validate time slot pair
                    if ($toTime && strtotime($fromTime) < strtotime($toTime)) {
                        BookingTimeSlot::create([
                            'booking_date_id' => $bookingDate->id,
                            'from_time' => $fromTime,
                            'to_time' => $toTime,
                        ]);
                    } else {
                        Log::error("Invalid time slot: from_time $fromTime is not before to_time $toTime");
                    }
                }
            }

            // Attach amenities if provided
            if ($request->amenities) {
                $booking->amenities()->sync($request->amenities);
            }

            // Commit the transaction
            \DB::commit();

            return redirect()->route('bookings.index')->with('success', 'Booking created successfully!');
        } catch (\Exception $e) {
            // Rollback the transaction on error
            \DB::rollback();

            // Log the error for debugging
            Log::error('Error creating booking: ' . $e->getMessage(), ['exception' => $e]);

            return redirect()->back()->withErrors(['error' => 'An error occurred while creating the booking. Please try again later.'])->withInput();
        }
    }

    /**
     * Approve booking.
     */
    public function approve(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        if ($request->user()->cannot('approve', $booking)) {
            return redirect()->back()->withErrors(['error' => 'You do not have permission to approve this booking.']);
        }

        $booking->status = 'approved';
        $booking->save();

        return redirect()->route('bookings.index')->with('success', 'Booking approved successfully!');
    }

    /**
     * Reject booking.
     */
    public function reject(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        if ($request->user()->cannot('reject', $booking)) {
            return redirect()->back()->withErrors(['error' => 'You do not have permission to reject this booking.']);
        }

        $booking->status = 'rejected';
        $booking->save();

        return redirect()->route('bookings.index')->with('success', 'Booking rejected successfully!');
    }

    /**
     * Show a single booking.
     */
    public function show($id)
    {
        $booking = Booking::with(['user', 'hall'])->findOrFail($id);
        return view('admin.bookings.show', compact('booking'));
    }

    /**
     * Approve booking from HOD.
     */
    public function approveFromHod($id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->approvalStatus === 'Pending from HOD') {
            $booking->update([
                'approvalStatus' => 'Pending from Registrar',
                'hodApproved' => true,
            ]);

            return redirect()->route('admin.bookings.index')->with('success', 'Booking approved by HOD, awaiting Registrar approval.');
        }

        return redirect()->route('admin.bookings.index')->with('error', 'Booking is not pending from HOD.');
    }

    /**
     * Approve booking from Registrar.
     */
    public function approveFromRegistrar($id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->approvalStatus === 'Pending from Registrar') {
            $booking->update([
                'approvalStatus' => 'Approved',
                'registrarApproved' => true,
            ]);

            return redirect()->route('admin.bookings.index')->with('success', 'Booking approved by Registrar.');
        }

        return redirect()->route('admin.bookings.index')->with('error', 'Booking is not pending from Registrar.');
    }

    /**
     * View bookings for HOD.
     */
    public function viewForHod()
    {
        $bookings = Booking::where('approvalStatus', 'Pending from HOD')->get();
        return view('hod.bookings.index', compact('bookings'));
    }

    /**
     * View bookings for Registrar.
     */
    public function viewForRegistrar()
    {
        $bookings = Booking::where('approvalStatus', 'Pending from Registrar')->get();
        return view('registrar.bookings.index', compact('bookings'));
    }
}
