@extends('layout.main')

@section('content')
    <h1>Add New Booking</h1>

    <form action="{{ route('bookings.store') }}" method="POST">
        @csrf
        <div>
            <label for="event_id">Event:</label>
            <select name="event_id" id="event_id" required>
                <option value="">Select Event</option>
                @foreach($events as $event)
                    <option value="{{ $event->id }}">{{ $event->event_name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="hall_id">Hall:</label>
            <select name="hall_id" id="hall_id" required>
                <option value="">Select Hall</option>
                @foreach($halls as $hall)
                    <option value="{{ $hall->id }}">{{ $hall->hall_name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="facilities">Facilities:</label>
            <select name="facilities[]" id="facilities" multiple required>
                @foreach($facilities as $facility)
                    <option value="{{ $facility->id }}">{{ $facility->facility_name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="purpose_of_hall">Purpose of Hall:</label>
            <input type="text" id="purpose_of_hall" name="purpose_of_hall" required>
        </div>

        <div>
            <label for="seating_capacity_required">Seating Capacity Required:</label>
            <input type="number" id="seating_capacity_required" name="seating_capacity_required" required>
        </div>

        <div>
            <label for="booking_date">Booking Date:</label>
            <input type="date" id="booking_date" name="booking_date" required>
        </div>

        <div>
            <label for="event_time_from">Event Time From:</label>
            <input type="time" id="event_time_from" name="event_time_from" required>
        </div>

        <div>
            <label for="event_time_to">Event Time To:</label>
            <input type="time" id="event_time_to" name="event_time_to" required>
        </div>

        <button type="submit">Submit Booking</button>
    </form>
@endsection
