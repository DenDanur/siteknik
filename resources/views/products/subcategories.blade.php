<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            Subcategories for {{ $category->name }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            {{-- @foreach ($subcategories as $key => $subcategory)
                <div class="bg-white shadow-md rounded-lg overflow-hidden hover:scale-105 transform transition-all duration-300 p-6 cursor-pointer">
                    <a href="{{ route('products.list', ['subcategory_id' => $subcategory->id]) }}">
                        <h3 class="text-lg font-semibold mb-2">{{ $subcategory->name }}</h3>
                    </a>
                </div>
            @endforeach --}}

            @foreach ($subcategories as $key => $subcategory)
                <a href="{{ route('products.list', $subcategory->id) }}" class="cursor-pointer">
                    <div class="bg-white shadow-md rounded-lg overflow-hidden hover:scale-105 transform transition-all duration-300 p-6 text-center">
                        <h3 class="text-lg font-semibold mb-2">{{ $subcategory->name }}</h3>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</x-app-layout>