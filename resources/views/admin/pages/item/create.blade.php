@extends('admin.layouts.main')

@section('content')
    <div class="container">
        <h1>Add New Item</h1>
        
        <!-- Flash messages -->
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form start -->
        <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Category Selection -->
            <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" class="form-control">
                    <option value="">Pilih Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Subcategory Selection (dependent on Category) -->
            <div class="form-group">
                <label for="subcategory_id">Subcategory</label>
                <select name="subcategory_id" id="subcategory_id" class="form-control" disabled>
                    <option value="">Pilih Subcategory</option>
                </select>
            </div>

            <!-- Item Code -->
            <div class="form-group">
                <label for="item_code">Item Code</label>
                <input type="text" id="item_code" name="item_code" class="form-control" required>
            </div>

            <!-- Item Name -->
            <div class="form-group">
                <label for="name">Item Name</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>

            <!-- Description -->
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-control" required></textarea>
            </div>

            <!-- Stock -->
            <div class="form-group">
                <label for="stock">Stock</label>
                <input type="number" id="stock" name="stock" class="form-control" required>
            </div>

            <!-- Price -->
            <div class="form-group">
                <label for="price">Harga Satuan</label>
                <input type="number" id="price" name="price" class="form-control" required>
            </div>

            <!-- Image Upload -->
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" id="image" name="image" class="form-control" accept="image/*">
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>

    <!-- JavaScript for Dependent Dropdown -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var categorySelect = document.getElementById('category_id');
            var subcategorySelect = document.getElementById('subcategory_id');

            // Fetch Subcategories based on selected Category
            categorySelect.addEventListener('change', function () {
                var categoryId = this.value;
                subcategorySelect.disabled = !categoryId;
                subcategorySelect.innerHTML = '<option value="">Pilih Subcategory</option>'; // Reset subcategory options

                if (categoryId) {
                    fetch(`/get-subcategories/${categoryId}`)
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(subcategory => {
                                var option = document.createElement('option');
                                option.value = subcategory.id;
                                option.textContent = subcategory.name;
                                subcategorySelect.appendChild(option);
                            });
                        })
                        .catch(error => console.error('Error fetching subcategories:', error));
                }
            });
        });
    </script>
@endsection
