{{-- resources/views/status.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            Status Peminjaman
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <table class="min-w-full bg-white shadow-md rounded-lg">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">ID</th>
                    <th class="py-2 px-4 border-b">Nama Produk</th>
                    <th class="py-2 px-4 border-b">Tanggal Peminjaman</th>
                    <th class="py-2 px-4 border-b">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="py-2 px-4 border-b">1</td>
                    <td class="py-2 px-4 border-b">Produk A</td>
                    <td class="py-2 px-4 border-b">2024-10-23</td>
                    <td class="py-2 px-4 border-b text-green-500">Dipinjam</td>
                </tr>
                <tr>
                    <td class="py-2 px-4 border-b">2</td>
                    <td class="py-2 px-4 border-b">Produk B</td>
                    <td class="py-2 px-4 border-b">2024-10-20</td>
                    <td class="py-2 px-4 border-b text-red-500">Dikembalikan</td>
                </tr>
            </tbody>
        </table>
    </div>
</x-app-layout>
