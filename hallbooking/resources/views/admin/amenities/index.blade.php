@extends('layouts.app')

@section('title', 'Amenities List')

@section('content')

  <!-- Content Header (Page header) -->
  <section class="content-header"></section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">

                <div class="box box-primary box-solid ">
                    <div class="box-header">

                        <h3 class="box-title">amenities List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">


                        <!-- Hall Table -->
                        <h3 class="box-title mt-5">amenities</h3>
                        <div class="table-responsive mt-3">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($amenities as $amenitie)
                                    <tr>
                                        <td>{{ $amenitie->name }}</td>
                                        <td>{{ $amenitie->description }}</td>

                                        <td>
                                            <a href="{{ route('admin.amenities.show', $amenitie->id) }}"
                                                class="btn btn-info  btn-sm">View</a>


                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No amenities available.</td>
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