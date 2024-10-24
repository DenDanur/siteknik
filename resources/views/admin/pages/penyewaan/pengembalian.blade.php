@extends('admin.layouts.main')

@section('content')
    <div class="container">
        <h1>Pengembalian</h1>
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

        <form action="{{ route('penyewaan.kembali')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="user_id">User</label>
                <input type="text" id="user_id" name="user_id" class="form-control" value="{{ $penyewaan->user->name }}"
                    readonly>
            </div>

            <div class="form-group">
                <label for="item_id">Item</label>
                <input type="text" id="item_id" name="item_id" class="form-control"
                    value="{{ $penyewaan->item->name }}" readonly>
            </div>

            <div class="form-group">
                <label for="jumlah">Jumlah</label>
                <input type="text" id="jumlah" name="jumlah" class="form-control" value="{{ $penyewaan->jumlah }}"
                    readonly>
            </div>


            <div class="form-group">
                <input type="text" id="harga" class="form-control" value="{{ $penyewaan->item->price }}" hidden>
            </div>

            <div class="form-group">
                <label for="total_harga">Total Harga</label>
                <input type="number" id="total_harga" name="total_harga" class="form-control" value="" readonly>
            </div>

            <div class="form-group">
                <label for="harga">Tanggal Pinjam</label>
                <input type="text" id="harga" class="form-control" value="{{ $penyewaan->tanggal_pinjam }}" readonly>
            </div>

            <div class="form-group">
                <label for="kembali">Tanggal Kembali</label>
                <input type="date" name="kembali" class="form-control @error('tanggal_kembali')  is-invalid @enderror"
                    required>
                @error('tanggal_kembali')
                    <div class="alert alert-danger mt-1">
                        <span class="alert-text text-white">{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="denda">Denda</label>
                <input type="text" id="denda" class="form-control" value="{{ $penyewaan->denda }}" readonly>
            </div>


            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var jumlahInput = document.getElementById('jumlah');
            var hargaInput = document.getElementById('harga');
            var totalHargaInput = document.getElementById('total_harga');

            function hitungTotalHarga() {
                var jumlah = parseFloat(jumlahInput.value) || 0;
                var harga = parseFloat(hargaInput.value) || 0;
                var totalHarga = jumlah * harga;

                // Tampilkan hasil total harga
                totalHargaInput.value = totalHarga;
            }

            // Hitung total harga saat halaman dimuat
            hitungTotalHarga();

            // Jika ada perubahan pada jumlah (jika readonly dihapus), ini akan diperbarui
            jumlahInput.addEventListener('input', hitungTotalHarga);
        });
    </script>
@endsection
