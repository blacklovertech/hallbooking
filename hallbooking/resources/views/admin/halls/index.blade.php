@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <div class="wrapper" style="height: auto;">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>

        @endif
    </div>
    <!-- Content Header (Page header) -->
    <section class="content-header"></section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">

                <div class="box box-primary box-solid ">
                    <div class="box-header">

                        <h3 class="box-title">Halls List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">


                        <!-- Hall Table -->
                        <h3 class="box-title mt-5">Halls</h3>
                        <div class="table-responsive mt-3">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Capacity</th>
                                        <th>Location</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($halls as $hall)
                                    <tr>
                                        <td>{{ $hall->name }}</td>
                                        <td>{{ $hall->capacity }}</td>
                                        <td>{{ $hall->location }}</td>
                                        <td>
                                            <!-- Edit Button -->
                                            <a href="{{ route('admin.halls.show', $hall->id) }}"
                                                class="btn btn-info  btn-sm">View</a>


                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No halls available.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>

@endsection