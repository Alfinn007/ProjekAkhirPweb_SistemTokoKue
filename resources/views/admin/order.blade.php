@extends('layouts.main')

@section('content')
<div class="max-w-6xl mx-auto my-10">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Kelola Pesanan Masuk 📋</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4 text-sm font-bold">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-lg rounded-xl overflow-hidden border border-gray-100">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="p-4 text-sm font-bold text-gray-600">ID Order</th>
                    <th class="p-4 text-sm font-bold text-gray-600">Customer</th>
                    <th class="p-4 text-sm font-bold text-gray-600">Total Bayar</th>
                    <th class="p-4 text-sm font-bold text-gray-600">Status Saat Ini</th>
                    <th class="p-4 text-sm font-bold text-gray-600">Ubah Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($orders as $order)
                <tr class="hover:bg-gray-50 transition">
                    <td class="p-4 font-mono text-sm">
                        #{{ $order->order_number }}
                        <div class="text-xs text-gray-400 mt-1">{{ $order->created_at->format('d M Y') }}</div>
                    </td>
                    <td class="p-4">
                        <div class="font-bold text-gray-800">{{ $order->user->name }}</div>
                        <div class="text-xs text-gray-500">{{ $order->payment_method == 'cod' ? 'Bayar Ditempat' : 'Transfer' }}</div>
                    </td>
                    <td class="p-4 font-bold text-[#ff4d4d]">
                        Rp {{ number_format($order->grand_total, 0, ',', '.') }}
                    </td>
                    <td class="p-4">
                        <span class="px-3 py-1 rounded-full text-xs font-bold
                            {{ $order->status == 'pending' ? 'bg-yellow-100 text-yellow-800' :
                                ($order->status == 'processing' ? 'bg-blue-100 text-blue-800' :
                                ($order->status == 'completed' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800')) }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td class="p-4">
                        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="flex items-center gap-2">
                            @csrf
                            @method('PUT')

                            <select name="status" class="border border-gray-300 rounded-lg px-2 py-1 text-sm focus:ring-[#6a5af9] outline-none">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>

                            <button type="submit" class="bg-[#ff4d4d] hover:bg-[#5a4bcd] text-white px-3 py-1.5 rounded-lg text-sm font-bold transition shadow-sm">
                                Simpan
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-8 text-center text-gray-500">Belum ada pesanan masuk.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
