@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Booking</h2>

    <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="eventName">Event Name</label>
            <input type="text" name="eventName" id="eventName" class="form-control" value="{{ $booking->eventName }}" required>
        </div>

        <div class="form-group">
            <label for="organizingClub">Organizing Club</label>
            <input type="text" name="organizingClub" id="organizingClub" class="form-control" value="{{ $booking->organizingClub }}" required>
        </div>

        <div class="form-group">
            <label for="eventStartDate">Event Start Date</label>
            <input type="date" name="eventStartDate" id="eventStartDate" class="form-control" value="{{ $booking->eventStartDate }}" required>
        </div>

        <div class="form-group">
            <label for="eventEndDate">Event End Date</label>
            <input type="date" name="eventEndDate" id="eventEndDate" class="form-control" value="{{ $booking->eventEndDate }}" required>
        </div>

        <div class="form-group">
            <label for="capacityRequired">Capacity Required</label>
            <input type="number" name="capacityRequired" id="capacityRequired" class="form-control" value="{{ $booking->capacityRequired }}" required>
        </div>

        <div class="form-group">
            <label for="email">Contact Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $booking->email }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Booking</button>
    </form>
</div>
@endsection
