@extends('admin.layouts.main')

@section('content')
<div class="container">
    <h2>Edit Peminjaman</h2>

    <form action="{{ route('peminjaman.update', $peminjaman->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="form-group">
            <label for="user_id">User</label>
            <select name="user_id" class="form-control" required>
                <option value="">Pilih User</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $peminjaman->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="item_id">Item</label>
            <select name="item_id" class="form-control" required>
                <option value="">Pilih Item</option>
                @foreach ($items as $item)
                    <option value="{{ $item->id }}" {{ $peminjaman->item_id == $item->id ? 'selected' : '' }}>
                        {{ $item->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="tanggal_pinjam">Tanggal Pinjam</label>
            <input type="date" name="tanggal_pinjam" class="form-control" value="{{ $peminjaman->tanggal_pinjam }}" required>
        </div>

        <div class="form-group">
            <label for="tanggal_kembali">Tanggal Kembali</label>
            <input type="date" name="tanggal_kembali" class="form-control" value="{{ $peminjaman->tanggal_kembali }}" required>
        </div>
    
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">Kembali</a>
    </form>

</div>
@endsection
