@extends('layouts.app')

@section('content')
<h1>Approved Booking Requests</h1>
<table>
    <thead>
        <tr>
            <th>Event Name</th>
            <th>Date</th>
            <th>Time</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($bookings as $booking)
        <tr>
            <td>{{ $booking->event_name }}</td>
            <td>{{ $booking->date }}</td>
            <td>{{ $booking->time }}</td>
            <td>
                <form action="{{ route('registrar.bookings.approve', $booking->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit">Approve</button>
                </form>
                <form action="{{ route('registrar.bookings.reject', $booking->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit">Reject</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection