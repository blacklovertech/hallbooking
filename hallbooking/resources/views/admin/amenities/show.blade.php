@extends('layouts.app')

@section('title', 'Amenity Details')

@section('content')

    <section class="content-header">
        <h1>Amenity Details</h1>
    </section>

    <section class="content">
        <div class="box box-primary">
            <div class="box-header">
                <a href="{{ route('admin.amenities.index') }}" class="btn btn-primary pull-right">Back to Amenities
                    List</a>
            </div>
            <div class="box-body">
                <!-- Amenity Details Section -->
                <div class="form-group">
                    <strong>Amenity Name:</strong>
                    <p>{{ $amenity->name }}</p>
                </div>

                <div class="form-group">
                    <strong>Description:</strong>
                    <p>{{ $amenity->description }}</p>
                </div>

                <!-- Edit Button -->
                <a href="{{ route('admin.amenities.edit', $amenity->id) }}" class="btn btn-warning btn-sm">Edit</a>

                <!-- Delete Button -->
                <form action="{{ route('admin.amenities.destroy', $amenity->id) }}" method="POST" style="display:inline;"
                    onsubmit="return confirm('Are you sure you want to delete this hall?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>

                <!-- Add other details you need to display -->
            </div>
        </div>
    </section>
</div>
@endsection