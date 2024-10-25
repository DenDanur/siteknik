@extends('admin.layouts.main')


@section('content')
    <div class="container">
        <h1>Penyewaan List</h1>
        <a href="{{ route('penyewaan.create') }}" class="btn btn-primary mb-3">Add New penyewaan</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Item</th>
                    <th>Tanggal Pinjam</th>
                    {{-- <th>Tanggal Kembali</th>
                    <th>Denda</th> --}}
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($penyewaans as $item)
                    <tr>
                        <td>{{ $item->user->name }}</td>
                        <td>{{ $item->item->name }}</td>
                        <td>{{ $item->tanggal_pinjam }}</td>
                        {{-- <td>{{ $item->tanggal_kembali ?? '-' }}</td>
                        <td>{{ $item->denda ?? '-' }}</td> --}}

                        <td>
                            <a href="{{ route('penyewaan.pengembalian', $item->id) }}" class="btn btn-warning">Return</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
