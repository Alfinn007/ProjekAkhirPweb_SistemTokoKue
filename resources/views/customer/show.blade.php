@extends('layouts.main')

@section('content')
<div class="max-w-4xl mx-auto mt-10 mb-20">
    <a href="{{ route('customer.orders') }}" class="text-gray-500 hover:text-[#6a5af9] mb-4 inline-block">&larr; Kembali</a>

    <div class="bg-white shadow-lg rounded-xl overflow-hidden border border-gray-200 p-6">
        <div class="flex justify-between items-center border-b pb-4 mb-4">
            <h2 class="text-xl font-bold">Order #{{ $order->order_number }}</h2>
            <span class="text-sm text-gray-500">{{ $order->created_at->format('d F Y, H:i') }}</span>
        </div>

        <div class="bg-gray-50 p-4 rounded-lg mb-6">
            <h3 class="font-bold mb-2">Info Pengiriman</h3>
            <p class="text-sm">Penerima: {{ Auth::user()->name }}</p>
            <p class="text-sm">Alamat: {{ $order->delivery_address }}</p>
            <p class="text-sm">No HP: {{ $order->phone }}</p>
            <p class="text-sm mt-2 font-semibold">Metode Bayar: {{ strtoupper($order->payment_method) }}</p>
        </div>

        <table class="w-full text-left mb-6">
            <thead>
                <tr class="border-b text-sm text-gray-500">
                    <th class="py-2">Produk</th>
                    <th class="py-2">Harga</th>
                    <th class="py-2">Qty</th>
                    <th class="py-2 text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                    <tr>
                        <td class="py-3">{{ $item->product->name }}</td>
                        <td class="py-3">Rp {{ number_format($item->price) }}</td>
                        <td class="py-3">x {{ $item->quantity }}</td>
                        <td class="py-3 text-right">Rp {{ number_format($item->price * $item->quantity) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="flex justify-between items-center border-t pt-4">
            <span class="font-bold text-lg">Total Bayar</span>
            <span class="font-bold text-2xl text-[#ff4d4d]">Rp {{ number_format($order->grand_total) }}</span>
        </div>
    </div>
</div>
@endsection
