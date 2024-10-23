{{-- resources/views/product/categories.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            Categories
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($categories as $key => $category)
                <a href="{{ route('products.category', $category->id) }}" class="cursor-pointer">
                    <div class="bg-white shadow-md rounded-lg overflow-hidden hover:scale-105 transform transition-all duration-300 p-6 text-center">
                        <h3 class="text-lg font-semibold mb-2">{{ $category->name }}</h3>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</x-app-layout>
