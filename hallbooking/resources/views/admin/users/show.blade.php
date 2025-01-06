@extends('layouts.app')

@section('title', 'View User')

@section('content')
    <section class="content-header">
        <h1>View User</h1>
    </section>

    <section class="content">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">User Details</h3>
                <a href="{{ route('admin.users.index') }}" class="btn btn-primary pull-right">Back to User List</a>
            </div>
            <div class="box-body">
                <!-- User Details -->
                <div class="form-group">
                    <strong>Name:</strong>
                    <p>{{ $user->name }}</p>
                </div>

                <div class="form-group">
                    <strong>Email:</strong>
                    <p>{{ $user->email }}</p>
                </div>

                <div class="form-group">
                    <strong>User Type:</strong>
                    <p>{{ $user->usertype }}</p>
                </div>

                <div class="form-group">
                    <strong>Department:</strong>
                    <p>{{ $user->department }}</p>
                </div>

                <div class="form-group">
                    <strong>Phone:</strong>
                    <p>{{ $user->phone }}</p>
                </div>

                <!-- Edit Button -->
                <div class="form-group">
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                </div>

                <!-- Bookings Section -->
                <div class="form-group">
                    <h4>Bookings</h4>
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
                                <td>  @if($booking->hodApproved === 0 && $booking->registrarApproved === 0)
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
                                            @endif</td>
                                <!-- Assuming 'status' is a column in the bookings table -->
                                <td><a  href="{{ route('admin.bookings.show', $booking->id) }}">View Details</a>
                                </td>
                            </tr>
                            
                            @endforeach
                        </tbody>
                    </table>
                </div>

          
            </div>
        </div>
    </section>
@endsection