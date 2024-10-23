{{-- resources/views/dashboard.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <h3 class="text-xl font-semibold mb-4">Produk Populer</h3>

        {{-- Carousel Produk Populer --}}
        <div class="relative">
            <div class="slick-slider">
                <div class="p-4 bg-white shadow-md rounded-md">
                    <h2 class="text-lg font-bold">Product 1</h2>
                    <p class="text-gray-600">Popular product 1 description.</p>
                </div>
                <div class="p-4 bg-white shadow-md rounded-md">
                    <h2 class="text-lg font-bold">Product 2</h2>
                    <p class="text-gray-600">Popular product 2 description.</p>
                </div>
                <div class="p-4 bg-white shadow-md rounded-md">
                    <h2 class="text-lg font-bold">Product 3</h2>
                    <p class="text-gray-600">Popular product 3 description.</p>
                </div>
                <div class="p-4 bg-white shadow-md rounded-md">
                    <h2 class="text-lg font-bold">Product 4</h2>
                    <p class="text-gray-600">Popular product 4 description.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
