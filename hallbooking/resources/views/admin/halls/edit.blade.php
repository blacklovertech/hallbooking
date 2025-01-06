<!-- resources/views/admin/halls/edit.blade.php -->

@extends('layouts.app')

@section('title', 'Edit Hall')

@section('content')

    <section class="content-header">
        <h1>Edit Hall</h1>
    </section>

    <section class="content">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Edit Hall Information</h3>
            </div>

            <div class="box-body">
                <form action="{{ route('admin.halls.update', $hall->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Hall Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $hall->name) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="capacity">Capacity</label>
                        <input type="number" name="capacity" class="form-control" value="{{ old('capacity', $hall->capacity) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="location">Location</label>
                        <input type="text" name="location" class="form-control" value="{{ old('location', $hall->location) }}" required>
                    </div>

                    <button type="submit" class="btn btn-success">Update Hall</button>
                </form>
            </div>
        </div>
    </section>

</div>
@endsection
