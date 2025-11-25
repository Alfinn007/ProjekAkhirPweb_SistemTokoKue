@extends('layouts.main')

@section('content')
<div class="max-w-6xl mx-auto mt-10 mb-20">

    <!-- Header -->
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('cart.index') }}" class="text-gray-500 hover:text-[#6a5af9] transition">
            &larr; Kembali ke Keranjang
        </a>
        <h1 class="text-3xl font-bold text-gray-800">Checkout Pengiriman 📦</h1>
    </div>

    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            <!-- KOLOM KIRI: FORM INPUT -->
            <div class="md:col-span-2 space-y-6">

                <!-- Card Alamat -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                    <h2 class="text-xl font-bold mb-4 flex items-center gap-2 text-gray-800">
                        📍 Alamat Penerima
                    </h2>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Penerima</label>
                        <input type="text" value="{{ Auth::user()->name }}" readonly class="w-full bg-gray-100 border border-gray-300 rounded-lg px-4 py-2 text-gray-500 cursor-not-allowed">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nomor WhatsApp / HP</label>
                        <input type="number" name="phone" required placeholder="Contoh: 08123456789" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-[#ff4d4d] focus:border-[#ff4d4d] outline-none transition">
                    </div>

                    <div class="mb-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                        <textarea name="address" rows="3" required placeholder="Jalan, No. Rumah, RT/RW, Kelurahan, Kecamatan..." class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-[#ff4d4d] focus:border-[#ff4d4d] outline-none transition"></textarea>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                    <h2 class="text-xl font-bold mb-4 flex items-center gap-2 text-gray-800">
                        💳 Metode Pembayaran
                    </h2>

                    <div class="space-y-3">
                        <!-- Transfer -->
                        <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-50 transition has-[:checked]:border-[#ff4d4d] has-[:checked]:bg-violet-50">
                            <input type="radio" name="payment_method" value="transfer" checked class="w-5 h-5 text-[#ff4d4d] focus:ring-[#ff4d4d]">
                            <div class="ml-4">
                                <span class="block font-bold text-gray-800">Transfer Bank</span>
                                <span class="block text-sm text-gray-500">BCA, Mandiri, BRI (Cek Otomatis)</span>
                            </div>
                        </label>

                        <!-- COD -->
                        <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-50 transition has-[:checked]:border-[#ff4d4d] has-[:checked]:bg-violet-50">
                            <input type="radio" name="payment_method" value="cod" class="w-5 h-5 text-[#ff4d4d] focus:ring-[#ff4d4d]">
                            <div class="ml-4">
                                <span class="block font-bold text-gray-800">Bayar di Tempat (COD)</span>
                                <span class="block text-sm text-gray-500">Bayar tunai saat kurir sampai rumah.</span>
                            </div>
                        </label>
                    </div>
                </div>

            </div>

            <!-- KOLOM KANAN: RINGKASAN -->
            <div class="md:col-span-1">
                <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200 sticky top-24">
                    <h3 class="text-lg font-bold mb-4 text-gray-800">Ringkasan Pesanan</h3>

                    <!-- List Barang Mini -->
                    <div class="space-y-4 max-h-60 overflow-y-auto mb-4 pr-2 custom-scrollbar">
                        @foreach($carts as $cart)
                            <div class="flex gap-3 text-sm">
                                @if($cart->product->image)
                                    <img src="{{ asset('storage/' . $cart->product->image) }}" class="w-12 h-12 rounded-md object-cover border">
                                @else
                                    <div class="w-12 h-12 bg-gray-200 rounded-md flex items-center justify-center text-xs text-gray-500">No IMG</div>
                                @endif
                                <div class="flex-1">
                                    <p class="font-bold text-gray-700 truncate">{{ $cart->product->name }}</p>
                                    <p class="text-gray-500 text-xs">{{ $cart->quantity }} x Rp {{ number_format($cart->product->price, 0, ',', '.') }}</p>
                                </div>
                                <p class="font-semibold text-gray-700">
                                    Rp {{ number_format($cart->product->price * $cart->quantity, 0, ',', '.') }}
                                </p>
                            </div>
                        @endforeach
                    </div>

                    <div class="border-t border-gray-100 my-4"></div>

                    <!-- Rincian Biaya -->
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal Produk</span>
                            <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Ongkos Kirim</span>
                            <span>Rp {{ number_format($shippingCost, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="border-t border-dashed border-gray-300 my-4"></div>

                    <!-- Total Akhir -->
                    <div class="flex justify-between mb-6 items-center">
                        <span class="font-bold text-lg text-gray-800">Total Bayar</span>
                        <span class="font-bold text-2xl text-[#ff4d4d]">Rp {{ number_format($grandTotal, 0, ',', '.') }}</span>
                    </div>

                    <!-- Tombol Bayar -->
                    <button type="submit" class="w-full bg-[#ff4d4d] hover:bg-[#c63f3f] text-white font-bold py-3.5 rounded-xl shadow-lg shadow-violet-200 transition-transform transform hover:-translate-y-1 flex justify-center items-center gap-2">
                        <span>Buat Pesanan</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>

                    <p class="text-[10px] text-center text-gray-400 mt-4">
                        Pastikan alamat dan pesanan sudah benar sebelum melanjutkan.
                    </p>
                </div>
            </div>

        </div>
    </form>
</div>
@endsection
