@extends('admin.layouts.main')

@section('content')
    <div class="container">
        <h1>Rental History</h1>

        

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            {{-- <a href="{{ route('admin.history.exportPdf') }}" class="inline-block mb-4 px-4 py-2 bg-blue-500 text-black rounded">
                Export to PDF
            </a> --}}
            
    
            @if ($riwayats->isEmpty())
                <p class="text-gray-600">Tidak ada peminjaman yang tercatat.</p>
            @else
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
            @endif
            <a href="{{ route('admin.history.exportPdf') }}" class="btn btn-primary mb-3">Export to PDF</a>
        </div>
    </div>
@endsection
