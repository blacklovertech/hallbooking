@extends('layouts.app')

@section('title', 'Hall Bookings Dashboard')

@section('content')

<!-- Content Header -->
<section class="content-header">
    <h1>Hall Bookings Dashboard</h1>
</section>

<!-- Main Content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title">Book Hall</h3>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.bookings.store') }}" enctype="multipart/form-data">
                            @csrf

                            <!-- Select Hall -->
                            <div class="mb-4">
                                <label for="hall_id" class="form-label">Select Hall:</label>
                                <select name="hall_id" class="form-select" required>
                                    @foreach ($halls as $hall)
                                    <option value="{{ $hall->id }}">{{ $hall->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- User Information -->
                            <div class="mb-4">
                                <label for="event_name" class="form-label">Event Name:</label>
                                <input type="text" name="event_name" class="form-control" required>
                            </div>
                            <div class="mb-4">
                                <label for="organising_club" class="form-label">Organising Club:</label>
                                <input type="text" name="organising_club" class="form-control" required>
                            </div>
                            <div class="mb-4">
                                <label for="capacity_required" class="form-label">Capacity Required:</label>
                                <input type="text" name="capacity_required" class="form-control" required>
                            </div>

                            <!-- Booking Dates and Time Slots -->
                            <div id="date-container" class="mb-4">
                                <div class="date-entry mb-4">
                                    <label class="form-label">Booking Date:</label>
                                    <input type="date" name="booking_dates[]" class="form-control mb-2" required>
                                    <div class="time-slot-container">
                                        <div class="time-slot row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Start Time:</label>
                                                <input type="time" name="start_times[0][]" class="form-control" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">End Time:</label>
                                                <input type="time" name="end_times[0][]" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-outline-secondary mt-3" onclick="addTimeSlot(this)">Add Another Time Slot</button>
                                </div>
                            </div>
                            <button type="button" class="btn btn-outline-primary mb-4" onclick="addDate()">Add Another Date</button>

                            <!-- Amenities Selection -->
                            <div class="mb-4">
                                <label class="form-label">Amenities:</label>
                                <div class="row g-3">
                                    @foreach($amenities as $amenity)
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="amenities[]" value="{{ $amenity->id }}">
                                            <label class="form-check-label">{{ $amenity->name }}</label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- PDF Upload -->
                            <div class="mb-4">
                                <label for="pdf" class="form-label">Upload PDF:</label>
                                <input type="file" name="pdf" class="form-control">
                            </div>

                            <!-- Reason -->
                            <div class="mb-4">
                                <label for="reason" class="form-label">Reason:</label>
                                <textarea name="reason" class="form-control" rows="4" required></textarea>
                            </div>

                            <!-- Submit Button -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-success">Book Hall</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function addDate() {
        const dateContainer = document.getElementById('date-container');
        const dateEntries = document.querySelectorAll('.date-entry');
        const newIndex = dateEntries.length;

        const newDateEntry = document.createElement('div');
        newDateEntry.className = 'date-entry mb-4';
        newDateEntry.innerHTML = `
            <label class="form-label">Booking Date:</label>
            <input type="date" name="booking_dates[]" class="form-control mb-2" required>
            <div class="time-slot-container">
                <div class="time-slot row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Start Time:</label>
                        <input type="time" name="start_times[${newIndex}][]" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">End Time:</label>
                        <input type="time" name="end_times[${newIndex}][]" class="form-control" required>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-outline-secondary mt-3" onclick="addTimeSlot(this)">Add Another Time Slot</button>
        `;
        dateContainer.appendChild(newDateEntry);
    }

    function addTimeSlot(button) {
        const timeSlotContainer = button.previousElementSibling;
        const dateIndex = Array.from(document.querySelectorAll('.date-entry')).indexOf(button.parentElement);

        const newTimeSlot = document.createElement('div');
        newTimeSlot.className = 'time-slot row g-3';
        newTimeSlot.innerHTML = `
            <div class="col-md-6">
                <label class="form-label">Start Time:</label>
                <input type="time" name="start_times[${dateIndex}][]" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">End Time:</label>
                <input type="time" name="end_times[${dateIndex}][]" class="form-control" required>
            </div>
        `;
        timeSlotContainer.appendChild(newTimeSlot);
    }
</script>
@endsection
