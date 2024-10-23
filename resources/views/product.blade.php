
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            Product List
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            {{-- Product Card 1 --}}
            <div onclick="openModal('product1')" class="cursor-pointer bg-white shadow-md rounded-lg overflow-hidden hover:scale-105 transform transition-all duration-300">
                <img class="w-full h-48 object-cover" src="{{ asset('images/product1.jpg') }}" alt="Product 1">
                <div class="p-4">
                    <h3 class="text-lg font-semibold mb-2">Product 1</h3>
                    <p class="text-gray-600">Click to see details.</p>
                </div>
            </div>

            {{-- Product Card 2 --}}
            <div onclick="openModal('product2')" class="cursor-pointer bg-white shadow-md rounded-lg overflow-hidden hover:scale-105 transform transition-all duration-300">
                <img class="w-full h-48 object-cover" src="{{ asset('images/product2.jpg') }}" alt="Product 2">
                <div class="p-4">
                    <h3 class="text-lg font-semibold mb-2">Product 2</h3>
                    <p class="text-gray-600">Click to see details.</p>
                </div>
            </div>

            {{-- Product Card 3 --}}
            <div onclick="openModal('product3')" class="cursor-pointer bg-white shadow-md rounded-lg overflow-hidden hover:scale-105 transform transition-all duration-300">
                <img class="w-full h-48 object-cover" src="{{ asset('images/product3.jpg') }}" alt="Product 3">
                <div class="p-4">
                    <h3 class="text-lg font-semibold mb-2">Product 3</h3>
                    <p class="text-gray-600">Click to see details.</p>
                </div>
            </div>

            {{-- Product Card 4 --}}
            <div onclick="openModal('product4')" class="cursor-pointer bg-white shadow-md rounded-lg overflow-hidden hover:scale-105 transform transition-all duration-300">
                <img class="w-full h-48 object-cover" src="{{ asset('images/product4.jpg') }}" alt="Product 4">
                <div class="p-4">
                    <h3 class="text-lg font-semibold mb-2">Product 4</h3>
                    <p class="text-gray-600">Click to see details.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Modals for Products --}}
    <div id="product1" class="hidden fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-md">
            <h3 class="text-xl font-semibold mb-4">Product 1 Details</h3>
            <p class="text-gray-600">This is a detailed description of Product 1. It's a high-quality product for rental.</p>
            <button onclick="closeModal('product1')" class="mt-4 bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded">
                Close
            </button>
        </div>
    </div>

    <div id="product2" class="hidden fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-md">
            <h3 class="text-xl font-semibold mb-4">Product 2 Details</h3>
            <p class="text-gray-600">This is a detailed description of Product 2. Reliable and affordable.</p>
            <button onclick="closeModal('product2')" class="mt-4 bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded">
                Close
            </button>
        </div>
    </div>

    <div id="product3" class="hidden fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-md">
            <h3 class="text-xl font-semibold mb-4">Product 3 Details</h3>
            <p class="text-gray-600">This is a detailed description of Product 3. Best for your needs.</p>
            <button onclick="closeModal('product3')" class="mt-4 bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded">
                Close
            </button>
        </div>
    </div>

    <div id="product4" class="hidden fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-md">
            <h3 class="text-xl font-semibold mb-4">Product 4 Details</h3>
            <p class="text-gray-600">This is a detailed description of Product 4. Rent it now!</p>
            <button onclick="closeModal('product4')" class="mt-4 bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded">
                Close
            </button>
        </div>
    </div>

    <script>
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }

    </script>
</x-app-layout>
