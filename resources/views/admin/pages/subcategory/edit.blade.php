@extends('admin.layouts.main')

@section('title')
Edit Sub Category
@endsection

@section('menu')
Edit Sub Category
@endsection

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Edit Sub Category</h1>

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

        <form action="{{ route('subcategories.update', $subcategory->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" 
                    name="name" value="{{ old('name', $subcategory->name) }}" required>
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
                        <option value="{{ $category->id }}" {{ $subcategory->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="alert alert-danger mt-1">
                        <span class="alert-text text-white">{{ $message }}</span>
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update Sub Category</button>
            <a href="{{ route('subcategories.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection