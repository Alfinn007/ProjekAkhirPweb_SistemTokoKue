<!DOCTYPE html>
<html>
<head>
    <title>Laporan Keuangan</title>
    <style>
        body { font-family: sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { margin: 0; color: #333; }
        .header p { margin: 2px; color: #555; font-size: 12px; }

        /* Kotak Statistik */
        .stats-container { width: 100%; margin-bottom: 30px; }
        .stat-box {
            float: left; width: 23%;
            background: #f4f4f4; padding: 10px; margin-right: 2%;
            text-align: center; border-radius: 5px;
        }
        .stat-box h3 { margin: 5px 0; color: #6a5af9; }
        .stat-box p { margin: 0; font-size: 12px; color: #666; }

        /* Tabel Pesanan */
        table { width: 100%; border-collapse: collapse; margin-top: 20px; font-size: 12px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #6a5af9; color: white; }
        tr:nth-child(even) { background-color: #f2f2f2; }

        .clearfix::after { content: ""; clear: both; display: table; }
    </style>
</head>
<body>

    <div class="header">
        <h1>JAJANYUK - LAPORAN TOKO</h1>
        <p>Jl. Jajan Enak No. 123, Jakarta</p>
        <p>Tanggal Cetak: {{ now()->format('d F Y, H:i') }}</p>
    </div>

    <hr style="border: 1px solid #eee;">

    <h3 style="margin-bottom: 10px;">Ringkasan Performa</h3>

    <div class="stats-container clearfix">
        <div class="stat-box">
            <p>Pendapatan</p>
            <h3>Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
        </div>
        <div class="stat-box">
            <p>Total Pesanan</p>
            <h3>{{ $totalOrders }}</h3>
        </div>
        <div class="stat-box">
            <p>Produk</p>
            <h3>{{ $totalProducts }}</h3>
        </div>
        <div class="stat-box">
            <p>Pelanggan</p>
            <h3>{{ $totalCustomers }}</h3>
        </div>
    </div>

    <h3 style="margin-top: 30px;">Riwayat Pesanan Terbaru</h3>
    <table>
        <thead>
            <tr>
                <th>No Order</th>
                <th>Tanggal</th>
                <th>Pelanggan</th>
                <th>Status</th>
                <th style="text-align: right;">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>#{{ $order->order_number }}</td>
                <td>{{ $order->created_at->format('d/m/Y') }}</td>
                <td>{{ $order->user->name }}</td>
                <td>{{ ucfirst($order->status) }}</td>
                <td style="text-align: right;">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
