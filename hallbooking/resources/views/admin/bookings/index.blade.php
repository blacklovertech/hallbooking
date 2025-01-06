@extends('layouts.app')

@section('title', 'Hall Bookings Dashboard')

@section('content')


    <!-- Content Header -->
    <section class="content-header">
        <h1>Hall Bookings</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary box-solid">
                    <div class="box-header">
                        <h3 class="box-title">Halls List</h3>
                    </div>

                    <!-- Box Body -->
                    <div class="box-body">
                        <!-- Hall Table -->
                        <div class="table-responsive">
                            <a href="{{ route('admin.bookings.create') }}" class="btn btn-success mb-3">Create New
                                Booking</a>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Event Name</th>
                                        <th>Organizing Club</th>
                                        <th>User Name</th>
                                        <th>Hall Name</th>
                                        <th>Capacity Required</th>
                                        <th>Approval Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($bookings as $booking)
                                    <tr>
                                        <td>{{ $booking->eventName }}</td>
                                        <td>{{ $booking->organisingClub }}</td>
                                        <td>
                                            @if($booking->user)
                                            {{ $booking->user->name }}
                                            @else
                                            No user assigned
                                            @endif
                                        </td>

                                        <td>
                                            @if($booking->hall)
                                            {{ $booking->hall->name }}
                                            @else
                                            No hall assigned
                                            @endif
                                        </td>
                                        <td>{{ $booking->capacityRequired }} </td>
                                        <td>
                                            @if($booking->hodApproved === 0 && $booking->registrarApproved === 0)
                                            <!-- If both HOD and Registrar approvals are 0 -->
                                            <span class="btn btn-alert  badge">Waiting for HOD Approval</span>
                                            @elseif($booking->hodApproved === 1 && $booking->registrarApproved === 0)
                                            <!-- If HOD approved, but Registrar is still pending -->
                                            <span class="btn btn-warning badge">Waiting for Registrar Approval</span>
                                            @elseif($booking->hodApproved === 1 && $booking->registrarApproved === 1)
                                            <!-- If both HOD and Registrar have approved -->
                                            <span class="btn btn-success badge">Approved</span>
                                            @else
                                            <!-- If any one of them rejected -->
                                            <span class="btn btn-danger badge">Rejected</span>
                                            @endif
                                        </td>

                                        <td>
                                            <a href="{{ route('admin.bookings.show', $booking->id) }}"
                                                class="btn btn-info">View</a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No bookings found.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection