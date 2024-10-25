@extends('admin.layouts.main')

@section('content')
    <div class="container">
        <h1>Rental History</h1>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Item</th>
                    <th>Jumlah</th>
                    <th>Total Harga</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Denda</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($riwayats as $history)
                    <tr>
                        <td>{{ $history->user->name }}</td>
                        <td>{{ $history->item->name }}</td>
                        <td>{{ $history->jumlah }}</td>
                        <td>{{ $history->total_harga }}</td>
                        <td>{{ $history->tanggal_pinjam }}</td>
                        <td>{{ $history->tanggal_kembali }}</td>
                        <td>{{ $history->denda ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
