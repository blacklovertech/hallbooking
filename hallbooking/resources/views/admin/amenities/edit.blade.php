@extends('layouts.app')

@section('title', 'Edit Amenities')

@section('content')

    <section class="content-header">
        <h1>Edit Amenity</h1>
    </section>

    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Edit Amenity Information</h3>
            </div>

            <div class="box-body">
                <!-- Edit Amenity Form -->
                <form action="{{ route('admin.amenities.update', $amenity->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Name Field -->
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ $amenity->name }}" required>
                    </div>

                    <!-- Description Field -->
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" id="description" rows="4">{{ $amenity->description }}</textarea>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Update Amenity</button>
                </form>

            </div>
        </div>
    </section>

</div>
@endsection
