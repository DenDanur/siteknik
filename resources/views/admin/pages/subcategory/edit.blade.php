@extends('admin.layouts.main')

@section('title')
Edit Category
@endsection

@section('menu')
Edit Category
@endsection

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Edit Category</h1>

        <!-- Flash message if any -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $category->name) }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Category</button>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
