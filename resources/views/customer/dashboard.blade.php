@extends('layouts.main')

@section('content')
<div class="max-w-6xl mx-auto">

    <div class="bg-gradient-to-r from-[#ff4d4d] to-violet-500 rounded-2xl p-8 text-white mb-10 shadow-lg relative overflow-hidden">
        <div class="relative z-10">
            <h1 class="text-3xl font-bold mb-2">Halo, {{ Auth::user()->name }}! 👋</h1>
            <p class="text-white/90">Mau jajan apa hari ini? Yuk cek koleksi terbaru kami.</p>
        </div>
        <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-white/20 rounded-full blur-2xl"></div>
    </div>

    <div class="mb-8">
        <form action="{{ route('customer.dashboard') }}" method="GET" class="relative">
            <input type="text" name="search"
                    value="{{ request('search') }}"
                    placeholder="Mau cari jajanan apa?"
                    class="w-full px-6 py-4 rounded-full border border-gray-200 shadow-sm focus:outline-none focus:ring-2 focus:ring-[#6a5af9] focus:border-transparent pl-14 transition-all">

            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400 absolute left-5 top-1/2 transform -translate-y-1/2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>

            <button type="submit" class="absolute right-2 top-2 bottom-2 bg-[#ff4d4d] hover:bg-[#c63f3f] text-white px-6 rounded-full font-bold transition">
                Cari
            </button>
        </form>

        @if(request('search'))
            <div class="mt-4 flex items-center justify-between">
                <p class="text-gray-600">
                    Menampilkan hasil untuk: <span class="font-bold text-gray-800">"{{ request('search') }}"</span>
                </p>
                <a href="{{ route('customer.dashboard') }}" class="text-red-500 hover:text-red-700 text-sm font-semibold">
                    ❌ Reset Pencarian
                </a>
            </div>
        @endif
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">


        @forelse($products as $product)
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-all duration-300 flex flex-col h-full group">

                <div class="relative h-48 bg-gray-100 overflow-hidden">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}"
                            alt="{{ $product->name }}"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gray-200 text-gray-400">No Image</div>
                    @endif

                    <span class="absolute top-2 left-2 bg-white/90 backdrop-blur text-xs font-bold px-2 py-1 rounded-md shadow-sm text-gray-600">
                        {{ $product->category->name ?? 'Umum' }}
                    </span>
                </div>

                <div class="p-4 flex flex-col flex-grow">
                    <h3 class="font-bold text-gray-800 text-lg truncate mb-1">{{ $product->name }}</h3>
                    <p class="text-gray-500 text-sm line-clamp-2 mb-3">{{ $product->description }}</p>

                    <div class="mt-auto flex items-center justify-between">
                        <div class="flex flex-col">
                            <span class="text-xs text-gray-400">Harga</span>
                            <span class="text-[#ff4d4d] font-bold text-lg">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </span>
                        </div>
                        <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded">
                            Stok: {{ $product->stock }}
                        </span>
                    </div>
                </div>

                <form action="{{route('cart.add', $product->id)}}" method="POST" class="mt-2">
                    @csrf
                    <button type="submit"
                        class="w-full bg-[#ff4d4d] hover:bg-[#5a4bcd] text-white font-bold py-3 px-4 rounded-b-xl transition-colors">
                        Tambah ke Keranjang
                    </button>
                </form>

            </div>
        @empty
            <div class="col-span-full py-12 text-center">
                <div class="bg-gray-50 rounded-2xl p-8 border border-dashed border-gray-300 inline-block">
                    <div class="text-5xl mb-4">😢</div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Yah, produknya nggak ketemu...</h3>
                    <p class="text-gray-500">
                        Coba cari kata kunci lain, misalnya:
                        <span class="font-mono bg-gray-200 px-1 rounded">Nasi</span>
                    </p>

                    @if(request('search'))
                        <a href="{{ route('customer.dashboard') }}" class="mt-4 inline-block text-[#6a5af9] font-bold hover:underline">
                            Lihat Semua Produk
                        </a>
                    @endif
                </div>
            </div>
        @endforelse

    </div>

</div>
@endsection
