{{-- resources/views/product/list.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            Alat Tempur Kategori {{ $category }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse ($products as $product)
                <div class="bg-white shadow-md rounded-lg overflow-hidden hover:scale-105 transform transition-all duration-300 p-6 cursor-pointer"
                     onclick="openModal({{ json_encode($product) }})">
                    <h3 class="text-lg font-semibold mb-2">{{ $product['name'] }}</h3>
                    <p class="text-gray-600">{{ $product['description'] }}</p>
                </div>
            @empty
                <p class="text-gray-600">No products available in this category.</p>
            @endforelse
        </div>
    </div>

        <!-- Modal -->
    <div id="itemModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden z-50 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6 relative">
            <div class="flex justify-between items-center">
                <h2 id="modalTitle" class="text-xl font-bold"></h2>
                <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700 text-xl">&times;</button>
            </div>
            <p id="modalDescription" class="mt-4 text-gray-600"></p>
            <p id="modalPrice" class="mt-2 font-bold"></p>
        </div>
    </div>



    <script>
        function openModal(product) {
            // Set content in the modal
            document.getElementById('modalTitle').innerText = product.name;
            document.getElementById('modalDescription').innerText = product.description || 'No description available';
            document.getElementById('modalPrice').innerText = product.price ? `$${product.price}` : '';

            // Show the modal by removing the 'hidden' class
            document.getElementById('itemModal').classList.remove('hidden');
        }

        function closeModal() {
            // Hide the modal by adding the 'hidden' class
            document.getElementById('itemModal').classList.add('hidden');
        }
    </script>
</x-app-layout>