{{-- resources/views/product/list.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            Products in {{ $category }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse ($products as $product)
                <div class="bg-white shadow-md rounded-lg overflow-hidden hover:scale-105 transform transition-all duration-300 p-6">
                    <h3 class="text-lg font-semibold mb-2">{{ $product['name'] }}</h3>
                    <p class="text-gray-600">{{ $product['description'] }}</p>
                </div>
            @empty
                <p class="text-gray-600">No products available in this category.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
