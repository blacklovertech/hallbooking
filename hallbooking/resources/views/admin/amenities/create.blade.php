@extends('layouts.app')

@section('title', 'Create Hall')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Create New Hall</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Hall Details</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <!-- Form for adding new hall -->
                        <form action="{{ route('admin.amenities.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" id="description" rows="4"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Save Amenity</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
