

@extends('admin.layouts.main')

@section('content')
<div class="container">
    <h1>Daftar Pengembalian</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                {{-- <th>ID Pengembalian</th> --}}
                <th>Nama Peminjam</th>
                <th>Item</th>
                <th>Tanggal Peminjaman</th>
                <th>Tanggal Pengembalian</th>
                <th>Denda</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengembalians as $pengembalian)
                <tr>
                    {{-- <td>{{ $pengembalian->id }}</td> --}}
                    <td>{{ $pengembalian->peminjaman->user->name }}</td>
                    <td>{{ $pengembalian->peminjaman->item->name }}</td>
                    <td>{{ $pengembalian->peminjaman->tanggal_peminjaman }}</td>
                    <td>{{ $pengembalian->tanggal_pengembalian }}</td>
                    <td>Rp {{ number_format($pengembalian->denda, 0, ',', '.') }}</td>
                    <td>
                        {{-- <a href="{{ route('pengembalian.show', $pengembalian->id) }}" class="btn btn-info">Detail</a> --}}
                        {{-- <a href="{{ route('pengembalian.edit', $pengembalian->id) }}" class="btn btn-warning">Edit</a> --}}
                        <form action="{{ route('pengembalian.destroy', $pengembalian->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('pengembalian.create') }}" class="btn btn-primary">Tambah Pengembalian</a>
</div>
@endsection
