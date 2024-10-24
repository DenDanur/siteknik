@extends('admin.layouts.main')

@section('content')
    <div class="container">
        <h1>Tambah Pengembalian</h1>

        <form action="{{ route('pengembalian.store') }}" method="POST">
            @csrf


            <div class="mb-3">
                <label for="peminjaman_id" class="form-label">Peminjaman</label>
                <select name="peminjaman_id" id="peminjaman_id" class="form-control" onchange="updateDetails()">
                    <option value="">-- Pilih Peminjaman --</option>
                    @foreach ($peminjaman as $p)
                        <option value="{{ $p->id }}" data-user="{{ $p->user->name }}"
                            data-item="{{ $p->item->name }}" data-tanggal="{{ $p->tanggal_pinjam }}">
                            {{ $p->id }} - {{ $p->user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div id="detailPeminjaman">
                <div class="mb-3">
                    <label class="form-label">Nama User</label>
                    <input type="text" id="user_name" class="form-control" disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Item</label>
                    <input type="text" id="item_name" class="form-control" disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal Peminjaman</label>
                    <input type="text" id="tanggal_pinjam" class="form-control" disabled>
                </div>
            </div>


            <div class="mb-3">
                <label for="tanggal_pengembalian" class="form-label">Tanggal Pengembalian</label>
                <input type="date" name="tanggal_pengembalian" id="tanggal_pengembalian" class="form-control" required>
            </div>

            <!-- Form untuk menampilkan denda jika ada -->
            <div class="mb-3" id="denda_section" style="display: none;">
                <label class="form-label">Jumlah Denda (Jika Terlambat)</label>
                <input type="text" id="denda" class="form-control" disabled>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection


<script>
    function updateDetails() {
        const select = document.getElementById('peminjaman_id');
        const selectedOption = select.options[select.selectedIndex];

        if (selectedOption) {
            // Get the data attributes
            const userName = selectedOption.getAttribute('data-user');
            const itemName = selectedOption.getAttribute('data-item');
            const tanggalPinjam = selectedOption.getAttribute('data-tanggal');

            // Update the input fields
            document.getElementById('user_name').value = userName || '';
            document.getElementById('item_name').value = itemName || '';
            document.getElementById('tanggal_pinjam').value = tanggalPinjam || '';
        } else {
            // Clear the input fields if no option is selected
            document.getElementById('user_name').value = '';
            document.getElementById('item_name').value = '';
            document.getElementById('tanggal_pinjam').value = '';
        }
    }
</script>
