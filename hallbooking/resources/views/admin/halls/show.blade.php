@extends('layouts.app')

@section('title', 'View Hall Details')

@section('content')

<section class="content-header">
    <h1>Hall Details</h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Hall Information</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Hall Name</th>
                            <td>{{ $hall->name }}</td>
                        </tr>
                        <tr>
                            <th>Location</th>
                            <td>{{ $hall->location }}</td>
                        </tr>
                        <tr>
                            <th>Capacity</th>
                            <td>{{ $hall->capacity }}</td>
                        </tr>
                    </table>

                    <h4>Bookings for this Hall</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Booking ID</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $booking)
                            <tr>
                                <td>{{ $booking->id }}</td>
                                <td>{{ $booking->created_at }}</td> <!-- Adjust with the actual date field -->
                                <td>
                                    @if($booking->hodApproved === 0 && $booking->registrarApproved === 0)
                                        <span class="badge badge-warning">Waiting for HOD Approval</span>
                                    @elseif($booking->hodApproved === 1 && $booking->registrarApproved === 0)
                                        <span class="badge badge-warning">Waiting for Registrar Approval</span>
                                    @elseif($booking->hodApproved === 1 && $booking->registrarApproved === 1)
                                        <span class="badge badge-success">Approved</span>
                                    @else
                                        <span class="badge badge-danger">Rejected</span>
                                    @endif
                                </td>
                                <td><a href="{{ route('admin.bookings.show', $booking->id) }}">View Details</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <a href="{{ route('admin.halls.index') }}" class="btn btn-primary mt-3">Back to Halls</a>
                </div>
            </div>
        </div>
    </div>
</section>
</div>
@endsection
