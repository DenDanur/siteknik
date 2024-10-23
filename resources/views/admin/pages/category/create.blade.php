@extends('admin.layouts.main')

@section('title')
    Add Category
@endsection

@section('menu')
    Add Category
@endsection

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Create New Category</h1>

        <!-- Flash message if any -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('category.store') }}" method="POST">
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
                <label for="type">Type</label>
                <input type="text" class="form-control @error('type') is-invalid @enderror" id="type" name="type" required>
                @error('type')
                    <div class="alert alert-danger mt-1">
                        <span class="alert-text text-white">{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Create Category</button>
            <a href="{{ route('category.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
