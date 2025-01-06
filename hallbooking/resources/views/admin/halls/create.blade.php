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
                        <form action="{{ route('admin.halls.store') }}" method="POST">
                            @csrf
                            
                            <!-- Hall Name -->
                            <div class="form-group">
                                <label for="name">Hall Name</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>

                            <!-- Hall Capacity -->
                            <div class="form-group">
                                <label for="capacity">Capacity</label>
                                <input type="number" name="capacity" id="capacity" class="form-control" required>
                            </div>

                            <!-- Hall Location -->
                            <div class="form-group">
                                <label for="location">Location</label>
                                <input type="text" name="location" id="location" class="form-control" required>
                            </div>

                            <!-- Submit Button -->
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Create Hall</button>
                                <a href="{{ route('admin.halls.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection
