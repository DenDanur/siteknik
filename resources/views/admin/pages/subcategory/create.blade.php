@extends('admin.layouts.main')

@section('title')
    Add Sub Category
@endsection

@section('menu')
    Add Sub Category
@endsection

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Create New Sub Category</h1>

        <!-- Flash message if any -->
        @if (session('error'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: '{{ session('error') }}',
                        confirmButtonText: 'OK'
                    });
                });
            </script>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('subcategories.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    required>
                @error('name')
                    <div class="alert alert-danger mt-1">
                        <span class="alert-text text-white">{{ $message }}</span>
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" class="form-control" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Create Sub Category</button>
            <a href="{{ route('subcategories.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
