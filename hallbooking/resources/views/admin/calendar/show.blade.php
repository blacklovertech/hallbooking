<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>

<div class="container mt-5">
    <h1>Booking Details for: {{ $booking->eventName }}</h1>
    
    <div class="mb-4">
        <a href="{{ route('calendar.index') }}" class="btn btn-primary">Back to Calendar</a>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Event Information</h5>
            <p class="card-text"><strong>Event Name:</strong> {{ $booking->eventName }}</p>
            <p class="card-text"><strong>Location:</strong> {{ $booking->location }}</p>
            <p class="card-text"><strong>Description:</strong> {{ $booking->description }}</p>
            <p class="card-text"><strong>Status:</strong> {{ $booking->hodApproved ? 'Approved' : 'Pending' }}</p>
            <p class="card-text"><strong>Organizer:</strong> {{ $booking->organizer_name }}</p>
        </div>
    </div>

    <h2 class="mt-4">Booking Dates and Time Slots</h2>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Date</th>
                <th scope="col">Time Slots</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($booking->dates as $date)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($date->booking_date)->format('l, jS F Y') }}</td>
                    <td>
                        @foreach ($booking->timeSlots as $slot)
                            <p>{{ \Carbon\Carbon::parse($slot->start_time)->format('g:i A') }} - 
                               {{ \Carbon\Carbon::parse($slot->end_time)->format('g:i A') }}</p>
                        @endforeach
                    </td>
                    <td>{{ $booking->hodApproved ? 'Approved' : 'Pending' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2 class="mt-4">Booking Amenities</h2>
    <ul>
        @foreach ($booking->amenities as $amenity)
            <li>{{ $amenity->name }}</li>
        @endforeach
    </ul>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
