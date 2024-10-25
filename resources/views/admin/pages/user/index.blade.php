@extends('admin.layouts.main')

@section('title')
    User
@endsection

@section('menu')
    User
@endsection

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">User List</h1>

        <!-- Flash message if any -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Button to create a new user -->
        <a href="{{ route('viewuser.create') }}" class="btn btn-primary mb-3">Add New User</a>

        <!-- Table to list users -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>name</th>
                    <th>Fullname</th>
                    <th>Email</th>
                    <th>Birthday</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->fullname }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->birthday ? \Carbon\Carbon::parse($user->birthday)->format('d-m-Y') : '-' }}</td>
                        <td>

                            <a href="{{ route('viewuser.history', $user->id) }}" class="btn btn-info btn-sm">View History</a>

                            <!-- Edit button -->
                            <a href="{{ route('viewuser.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <!-- Delete form -->
                            <form action="{{ route('viewuser.destroy', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No users available</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
