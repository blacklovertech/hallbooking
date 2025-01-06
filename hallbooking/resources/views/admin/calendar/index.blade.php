<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Calendar</title>
    <!-- FullCalendar CSS and JS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
</head>
<body>
    <div class="container">
        <h1>Event Booking Calendar</h1>

        <!-- FullCalendar container -->
        <div id="calendar"></div>

        <hr>

        <h2>Booking List</h2>
        <table>
            <thead>
                <tr>
                    <th>Event Name</th>
                    <th>Booking Date</th>
                    <th>Time Slots</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $booking)
                    @foreach ($booking->dates as $date)
                        <tr>
                            <td>{{ $booking->eventName }}</td>
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
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        // Initialize the calendar
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: [
                    @foreach ($bookings as $booking)
                        @foreach ($booking->dates as $date)
                            {
                                title: "{{ $booking->eventName }}",
                                start: "{{ \Carbon\Carbon::parse($date->booking_date)->toIso8601String() }}",
                                description: "Time Slots: 
                                    @foreach ($booking->timeSlots as $slot)
                                        {{ \Carbon\Carbon::parse($slot->start_time)->format('g:i A') }} - 
                                        {{ \Carbon\Carbon::parse($slot->end_time)->format('g:i A') }},
                                    @endforeach",
                                color: "{{ $booking->hodApproved ? 'green' : 'yellow' }}",
                                textColor: "white"
                            },
                        @endforeach
                    @endforeach
                ]
            });

            calendar.render();
        });
    </script>
</body>
</html>
