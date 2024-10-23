@extends('admin.layouts.main')

@section('title')
Category
@endsection

@section('menu')
Category
@endsection

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Category List</h1>

    <!-- Flash message if any -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Button to create a new category -->
    <a href="{{ route('category.create') }}" class="btn btn-primary mb-3">Add New Category</a>

    <!-- Table to list categories -->
    <table class="table table-striped">
        <thead>
            <tr>
                {{-- <th>ID</th> --}}
                <th>Name</th>
                <th>Type</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
                <tr>
                    {{-- <td>{{ $category->id }}</td> --}}
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->type }}</td>
                    <td>
                        <!-- Edit button -->
                        <a href="{{ route('category.edit', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <!-- Delete form -->
                        <form action="{{ route('category.destroy', $category->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">No categories available</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
