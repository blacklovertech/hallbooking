@extends('layouts.app')

@section('content')
<h1>Create Booking</h1>
<form action="{{ route('bookings.store') }}" method="POST">
    @csrf
    <div>
        <label for="event_name">Event Name:</label>
        <input type="text" name="event_name" required>
    </div>
    <div>
        <label for="date">Date:</label>
        <input type="date" name="date" required>
    </div>
    <div>
        <label for="time">Time:</label>
        <input type="time" name="time" required>
    </div>
    <button type="submit">Request Booking</button>
</form>
@endsection