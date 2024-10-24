@extends('admin.layouts.main')


@section('content')
<div class="container">
    <h1>Peminjaman List</h1>
    <a href="{{ route('peminjaman.create') }}" class="btn btn-primary mb-3">Add New Peminjaman</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>User</th>
                <th>Item</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($peminjaman as $item)
                <tr>
                    <td>{{ $item->user->name }}</td>
                    <td>{{ $item->item->name }}</td>
                    <td>{{ $item->tanggal_pinjam }}</td>
                    <td>{{ $item->tanggal_kembali ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('peminjaman.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
