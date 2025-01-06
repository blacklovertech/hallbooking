@extends('layouts.app')

@section('content')
    <h1>Bookings for Date: {{ \Carbon\Carbon::parse($date)->format('d-m-Y') }}</h1>
    
    <table class="table">
        <thead>
            <tr>
                <th>Event Title</th>
                <th>Booking Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bookings as $booking)
                <tr>
                    <td>{{ $booking->event_title }}</td>
                    <td>{{ $booking->booking_date }}</td>
                    <td>
                        <span class="badge {{ $booking->status == 'approved' ? 'bg-success' : ($booking->status == 'pending' ? 'bg-warning' : 'bg-secondary') }}">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
