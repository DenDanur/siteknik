@extends('admin.layouts.main')

@section('content')
    <div class="container">
        <h1>Add New Penyewaan</h1>
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

        <form action="{{ route('penyewaan.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="user_id">User</label>
                <select name="user_id" class="form-control">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="item_id">Item</label>
                <select name="item_id" id="item_id" class="form-control">
                    <option value="">Pilih Item</option>
                    @foreach ($items as $item)
                        <option value="{{ $item->id }}" data-price="{{ $item->price }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="jumlah">Jumlah</label>
                <input type="number" id="jumlah" name="jumlah"
                    class="form-control @error('jumlah')  is-invalid @enderror" required>
                @error('jumlah')
                    <div class="alert alert-danger mt-1">
                        <span class="alert-text text-white">{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="harga">Harga Satuan</label>
                <input type="text" id="harga" class="form-control" value="" disabled>
            </div>

            <div class="form-group">
                <label for="total_harga">Total Harga</label>
                <input type="number" id="total_harga" name="total_harga" class="form-control" readonly>
            </div>

            <div class="form-group">
                <label for="tanggal_pinjam">Tanggal Pinjam</label>
                <input type="date" name="tanggal_pinjam" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var itemSelect = document.getElementById('item_id');
            var jumlahInput = document.getElementById('jumlah');
            var hargaInput = document.getElementById('harga');
            var totalHargaInput = document.getElementById('total_harga');

            function updateTotalHarga() {
                var selectedItem = itemSelect.options[itemSelect.selectedIndex];
                var price = parseFloat(selectedItem.getAttribute('data-price')) || 0;
                var jumlah = parseInt(jumlahInput.value) || 0;

                // Update harga satuan
                hargaInput.value = price;

                // Hitung total harga
                totalHargaInput.value = price * jumlah;
            }

            // Event listener saat item dipilih
            itemSelect.addEventListener('change', updateTotalHarga);

            // Event listener saat jumlah diinput
            jumlahInput.addEventListener('input', updateTotalHarga);
        });
    </script>
@endsection
