@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
    <section class="content-header">
        <h1>Edit User</h1>
    </section>

    <section class="content">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Edit User Information</h3>
            </div>
            <div class="box-body">
                <!-- Update User Form -->
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
                    </div>
                    <div class="form-group">
                        <label for="department">Department</label>
                        <input type="text" name="department" id="department" class="form-control" value="{{ $user->department }}" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control" value="{{ $user->phone }}" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password (Leave empty if no change)</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-success">Update User</button>
                </form>

                <hr>

                <!-- Role Assignment Section -->
                <div class="mt-4">
                    <h4>Assign Roles</h4>

                    <!-- Assign HOD Role Button -->
                    <form action="{{ route('admin.users.assign-hod', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-info btn-sm">Assign HOD</button>
                    </form>

                    <!-- Assign Registrar Role Button -->
                    <form action="{{ route('admin.users.assign-registrar', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm">Assign Registrar</button>
                    </form>
                </div>

                <hr>

                <!-- Delete User Form -->
                <div class="mt-4">
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this user?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete User</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
