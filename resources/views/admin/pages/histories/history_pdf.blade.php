{{-- resources/views/admin/history_pdf.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <title>History Peminjaman PDF</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { padding: 8px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #f5f5f5; }
    </style>
</head>
<body>
    <h2>History Peminjaman - Admin</h2>
    <table>
        <thead>
            <tr>
                <th>User</th>
                <th>Item</th>
                <th>Harga</th>
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
                    <td>{{ number_format($history->item->price, 0, ',', '.') }}</td>
                    <td>{{ $history->jumlah }}</td>
                    <td>{{ number_format($history->totalHarga, 0, ',', '.') }}</td>
                    <td>{{ $history->tanggal_pinjam }}</td>
                    <td>{{ $history->tanggal_kembali }}</td>
                    <td>{{ $history->denda }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
