@extends('admin.layouts.main')

@section('title')
Edit User
@endsection

@section('menu')
User
@endsection

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Edit User</h1>

    <!-- Form to edit user details -->
    <form action="{{ route('viewuser.update', $viewuser->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Username field -->
        <div class="form-group">
            <label for="name">Username</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $viewuser->name) }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Fullname field -->
        <div class="form-group">
            <label for="fullname">Fullname</label>
            <input type="text" name="fullname" id="fullname" class="form-control @error('fullname') is-invalid @enderror" value="{{ old('fullname', $viewuser->fullname) }}" required>
            @error('fullname')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email field -->
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $viewuser->email) }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password field -->
        <div class="form-group">
            <label for="password">Password <small>(Leave blank if not changing)</small></label>
            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Role dropdown -->
        <div class="form-group">
            <label for="role">Role</label>
            <select name="role" id="role" class="form-control @error('role') is-invalid @enderror" required>
                <option value="">Select Role</option>
                <option value="admin" {{ old('role', $viewuser->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="user" {{ old('role', $viewuser->role) == 'user' ? 'selected' : '' }}>User</option>
            </select>
            @error('role')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Birthday field (optional) -->
        <div class="form-group">
            <label for="birthday">Birthday </label>
            <input type="date" name="birthday" id="birthday" class="form-control @error('birthday') is-invalid @enderror" value="{{ old('birthday', $viewuser->birthday) }}">
            @error('birthday')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit button -->
        <button type="submit" class="btn btn-primary">Update User</button>
        <a href="{{ route('viewuser.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
