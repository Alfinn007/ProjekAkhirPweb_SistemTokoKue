@extends('layouts.main')

@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Keranjang Belanja 🛒</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-4">{{ session('success') }}</div>
    @endif

    <div class="bg-white shadow-md rounded-xl overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="p-4 text-sm font-semibold text-gray-600">Produk</th>
                    <th class="p-4 text-sm font-semibold text-gray-600">Harga</th>
                    <th class="p-4 text-sm font-semibold text-gray-600">Jumlah</th>
                    <th class="p-4 text-sm font-semibold text-gray-600">Total</th>
                    <th class="p-4 text-sm font-semibold text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @php $grandTotal = 0; @endphp
                @forelse($carts as $cart)
                    @php
                        $subtotal = $cart->product->price * $cart->quantity;
                        $grandTotal += $subtotal;
                    @endphp
                    <tr class="hover:bg-gray-50">
                        <td class="p-4 flex items-center gap-3">
                            <img src="{{ asset('storage/' . $cart->product->image) }}" class="w-12 h-12 rounded object-cover">
                            <span class="font-medium text-gray-800">{{ $cart->product->name }}</span>
                        </td>
                        <td class="p-4 text-gray-600">Rp {{ number_format($cart->product->price) }}</td>
                        <td class="p-4 text-gray-600">{{ $cart->quantity }}</td>
                        <td class="p-4 font-bold text-[#6a5af9]">Rp {{ number_format($subtotal) }}</td>
                        <td class="p-4">
                            <form action="{{ route('cart.destroy', $cart->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-bold">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-8 text-center text-gray-500">Keranjang masih kosong. Yuk belanja!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if($carts->count() > 0)
        <div class="p-6 bg-gray-50 border-t flex justify-between items-center">
            <div>
                <span class="text-gray-500 text-sm">Total Pembayaran</span>
                <p class="text-2xl font-bold text-gray-800">Rp {{ number_format($grandTotal) }}</p>
            </div>

            <div class="p-6 bg-gray-50 border-t flex justify-between items-center">
                <a href="{{ route('checkout.page') }}" class="bg-[#ff4d4d] hover:bg-[#c63f3f] text-white font-bold py-3 px-8 rounded-lg shadow-lg transition-transform transform hover:-translate-y-1 inline-block">
                    Checkout Sekarang 
                </a>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
