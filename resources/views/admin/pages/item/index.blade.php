@extends('admin.layouts.main')

@section('content')
    <div class="container">
        <h1>Items</h1>
        <a href="{{ route('items.create') }}" class="btn btn-primary mb-3">Add New Item</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Sub Category</th>
                    <th>image</th>
                    <th>Description</th>
                    <th>Stock</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->category->name }}</td>
                        <td>{{ $item->subcategory->name }}</td>
                        <td>
                            @if ($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" width="100">
                            @else
                                <p>No image available</p>
                            @endif
                        </td>
                        <td>{{ $item->description}}</td>
                        <td>{{ $item->stock}}</td>
                        <td>{{ $item->price}}</td>
                        <td>
                            <a href="{{ route('items.edit', $item) }}" class="btn btn-warning">Edit</a>

                            <!-- Form untuk Delete -->
                            <form action="{{ route('items.destroy', $item) }}" method="POST" style="display:inline;"
                                onsubmit="return confirm('Are you sure you want to delete this item?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>
@endsection
