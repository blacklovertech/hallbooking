@extends('layouts.app')

@section('title', 'View Booking Details')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Booking Details</h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Booking Information</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Event Name</th>
                            <td>{{ $booking->eventName }}</td>
                        </tr>
                        <tr>
                            <th>Organizing Club</th>
                            <td>{{ $booking->organizingClub }}</td>
                        </tr>
                        <tr>
                            <th>User</th>
                            <td><a
                                    href="{{ route('admin.users.show', $booking->user->id) }}">{{ $booking->user->name }}</a>
                            </td>
                        </tr>
                        <tr>
                            <th>Hall</th>
                            <td>
                                <a href="{{ route('admin.halls.show', $booking->hall->id) }}">{{ $booking->hall->name }}</a>
                                
                            </td>
                        </tr>

                        <tr>
                            <th>Capacity Required</th>
                            <td>{{ $booking->capacityRequired }}</td>
                        </tr>
                        <tr>
                            <th>Approval Status</th>
                            <td> @if($booking->hodApproved === 0 && $booking->registrarApproved === 0)
                                <!-- If both HOD and Registrar approvals are 0 -->
                                <span class="badge badge-warning">Waiting for HOD Approval</span>
                                @elseif($booking->hodApproved === 1 && $booking->registrarApproved === 0)
                                <!-- If HOD approved, but Registrar is still pending -->
                                <span class="badge badge-warning">Waiting for Registrar Approval</span>
                                @elseif($booking->hodApproved === 1 && $booking->registrarApproved === 1)
                                <!-- If both HOD and Registrar have approved -->
                                <span class="badge badge-success">Approved</span>
                                @else
                                <!-- If any one of them rejected -->
                                <span class="badge badge-danger">Rejected</span>
                                @endif
                            </td>
                        </tr>

                        <!-- Event Date Range -->
                        <tr>
                            <th>Event Dates</th>
                            <td>
                                <ul>
                                    <li>Start Date: {{ \Carbon\Carbon::parse($eventStartDate)->format('d M Y') }}
                                    </li>
                                    <li>End Date: {{ \Carbon\Carbon::parse($eventEndDate)->format('d M Y') }}</li>
                                </ul>
                            </td>
                        </tr>

                        <!-- Amenities -->
                        <tr>
                            <th>
                                Amenities:</th>
                            <td>
                                <ul>
                                    @if(!empty($amenities))
                                    @foreach($amenities as $amenityId => $amenityName)
                                    <li>{{ $amenityName }}</li>
                                    @endforeach
                                    @else
                                    <li>No amenities available</li>
                                    @endif

                                </ul>
                            </td>
                        </tr>


                        <!-- Uploaded PDF -->
                        @if($booking->pdf)
                        <tr>
                            <th>Uploaded PDF</th>
                            <td><a href="{{ Storage::url($booking->pdf) }}" target="_blank">View PDF</a></td>
                        </tr>
                        @endif

                        <!-- Booked Dates and Time Slots -->
                        <tr>
                            <th>Booked Dates and Time Slots</th>
                            <td>
                                @foreach ($booking->dates as $bookingDate)
                                <div>
                                    <h5>Date:
                                        {{ \Carbon\Carbon::parse($bookingDate->booking_date)->format('d M Y') }}
                                    </h5>
                                    <ul>
                                        @foreach ($bookingDate->timeSlots as $timeSlot)
                                        <li>
                                            From: {{ \Carbon\Carbon::parse($timeSlot->start_time)->format('H:i') }}
                                            To: {{ \Carbon\Carbon::parse($timeSlot->end_time)->format('H:i') }}
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endforeach
                            </td>
                        </tr>

                        <!-- Booking Created Date -->
                        <tr>
                            <th>Booking Created On</th>
                            <td>{{ \Carbon\Carbon::parse($booking->created_at)->format('d M Y H:i') }}</td>
                        </tr>
                    </table>

                    <a href="{{ route('admin.bookings.index') }}" class="btn btn-primary mt-3">Back to Bookings</a>
                </div>
            </div>
        </div>
    </div>
</section>
</div>
@endsection