@extends('layouts.main')

@section('content')
<div class="max-w-6xl mx-auto mt-10 mb-20">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Riwayat Pesanan Saya 📦</h1>

    <div class="bg-white shadow-md rounded-xl overflow-hidden border border-gray-100">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="p-4">No. Order</th>
                    <th class="p-4">Tanggal</th>
                    <th class="p-4">Total</th>
                    <th class="p-4">Status</th>
                    <th class="p-4">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($orders as $order)
                    <tr class="hover:bg-gray-50">
                        <td class="p-4 font-mono text-sm">#{{ $order->order_number }}</td>
                        <td class="p-4 text-sm">{{ $order->created_at->format('d M Y') }}</td>
                        <td class="p-4 font-bold">Rp {{ number_format($order->grand_total) }}</td>
                        <td class="p-4">
                            <span class="px-2 py-1 rounded text-xs font-bold
                                {{ $order->status == 'pending' ? 'bg-yellow-100 text-yellow-800' :
                                    ($order->status == 'completed' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800') }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td class="p-4">
                            <a href="{{ route('orders.show', $order->id) }}" class="text-[#ff4d4d] font-bold text-sm hover:underline">
                                Lihat Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-8 text-center text-gray-500">Belum ada pesanan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
