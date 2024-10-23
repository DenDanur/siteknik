@extends('admin.layouts.main')

@section('title')
Sub Category
@endsection

@section('menu')
Sub Category
@endsection

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Sub Category List</h1>

    <!-- Flash message if any -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Button to create a new category -->
    <a href="{{ route('subcategories.create') }}" class="btn btn-primary mb-3">Add New Sub Category</a>

    <!-- Table to list categories -->
    <table class="table table-striped">
        <thead>
            <tr>
                {{-- <th>ID</th> --}}
                <th>Name</th>
                <th>Category</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($subcategories as $subcategory)
                <tr>
                    {{-- <td>{{ $subcategory->id }}</td> --}}
                    <td>{{ $subcategory->name }}</td>
                    <td>{{ $subcategory->category->name }}</td>
                    <td>
                        <!-- Edit button -->
                        <a href="{{ route('subcategories.edit', $subcategory->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <!-- Delete form -->
                        <form action="{{ route('subcategories.destroy', $subcategory->id) }}" method="POST" class="d-inline">
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
