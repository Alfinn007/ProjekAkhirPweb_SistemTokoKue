@extends('layouts.main')

@section('content')
<div class="max-w-7xl mx-auto my-10">

    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">

        <h1 class="text-2xl font-bold text-gray-800">Manajemen Produk</h1>

        <div class="flex flex-col md:flex-row gap-4 w-full md:w-auto">

            <form action="{{ route('admin.dashboard') }}" method="GET" class="relative w-full md:w-64">
                <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari nama / harga..."
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#ff4d4d] focus:ring-1 focus:ring-[#ff4d4d] transition text-sm">

                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 absolute left-3 top-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </form>

            <a href="{{ route('products.create') }}" class="bg-[#ff4d4d] hover:bg-[#5a4bcd] text-white px-4 py-2 rounded-lg font-bold flex items-center justify-center gap-2 transition shadow-md text-sm whitespace-nowrap">
                <span>+ Tambah Produk</span>
            </a>

        </div>
    </div>

    @if(request('search'))
        <div class="mb-4 bg-gray-50 p-3 rounded-lg border border-dashed border-gray-300 flex justify-between items-center">
            <p class="text-sm text-gray-600">Hasil pencarian untuk: <span class="font-bold">"{{ request('search') }}"</span></p>
            <a href="{{ route('admin.dashboard') }}" class="text-red-500 text-xs font-bold hover:underline">Reset</a>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">

        @forelse($products as $product)
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300 border border-gray-100 flex flex-col h-full">

                <div class="relative h-48 w-full bg-gray-100 overflow-hidden group">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}"
                                alt="{{ $product->name }}"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gray-200 text-gray-400">
                            <span class="text-sm">No Image</span>
                        </div>
                    @endif

                    <div class="absolute top-3 right-3">
                        <span class="bg-gray-900/80 text-white text-xs font-bold px-2 py-1 rounded-md backdrop-blur-sm">
                            Stok: {{ $product->stock }}
                        </span>
                    </div>
                </div>

                <div class="p-5 flex flex-col flex-grow">
                    <h3 class="text-lg font-bold text-gray-800 mb-1 truncate">
                        {{ $product->name }}
                    </h3>

                    <p class="text-xl font-bold text-[#ff4d4d] mb-2">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </p>

                    <p class="text-gray-500 text-sm line-clamp-2 mb-4">
                        {{ $product->description ?? 'Tidak ada deskripsi' }}
                    </p>
                </div>

                <div class="bg-gray-50 p-4 border-t border-gray-100 flex gap-3">
                    <a href="{{ route('products.edit', $product->id) }}"
                        class="flex-1 text-center bg-amber-100 hover:bg-amber-200 text-amber-700 py-2 rounded-lg text-sm font-bold transition-colors">
                        Edit
                    </a>

                    <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                            class="flex-1"
                            onsubmit="return confirm('Hapus barang ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="w-full bg-red-100 hover:bg-red-200 text-red-700 py-2 rounded-lg text-sm font-bold transition-colors">
                            Hapus
                        </button>
                    </form>
                </div>

            </div>

        @empty
            <div class="col-span-full py-12 text-center bg-gray-50 rounded-xl border border-dashed border-gray-300">
                <div class="flex flex-col items-center justify-center">
                    <p class="text-4xl mb-3">🔍</p>
                    <h3 class="text-lg font-bold text-gray-800">Tidak ada produk ditemukan.</h3>
                    <p class="text-sm text-gray-500 mt-1">Coba kata kunci lain atau tambah produk baru.</p>
                </div>
            </div>
        @endforelse

    </div>
    @endsection
