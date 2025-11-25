@extends('layouts.main')

@section('content')
<div class="max-w-4xl mx-auto my-10">

    <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-[#6a5af9] transition font-medium, margin: 1rem">
        &larr; Kembali
    </a>
    <div class="flex items-center gap-4 mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Edit Produk: <span class="text-[#6a5af9]">{{ $product->name }}</span></h1>
    </div>

    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label class="block mb-1 font-semibold text-[#555] text-sm">Nama Barang</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" required
                        class="w-full border-b-2 border-[#e0e0e0] py-2 text-base focus:outline-none focus:border-[#c63f3f] placeholder-gray-400 transition-colors bg-transparent">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block mb-1 font-semibold text-[#555] text-sm">Harga (Rp)</label>
                    <input type="number" name="price" value="{{ old('price', $product->price) }}" required
                            class="w-full border-b-2 border-[#e0e0e0] py-2 text-base focus:outline-none focus:border-[#c63f3f] placeholder-gray-400 transition-colors bg-transparent">
                </div>
                <div>
                    <label class="block mb-1 font-semibold text-[#555] text-sm">Stok</label>
                    <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" required
                            class="w-full border-b-2 border-[#e0e0e0] py-2 text-base focus:outline-none focus:border-[#c63f3f] placeholder-gray-400 transition-colors bg-transparent">
                </div>
            </div>

            <div class="mb-6">
                <label class="block mb-1 font-semibold text-[#555] text-sm">Kategori</label>
                <select name="category_id"
                        class="w-full border-b-2 border-[#e0e0e0] py-2 text-base focus:outline-none focus:border-[#c63f3f] bg-transparent transition-colors cursor-pointer">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-6">
                <label class="block mb-1 font-semibold text-[#555] text-sm">Deskripsi Produk</label>
                <textarea name="description" rows="4"
                            class="w-full border-b-2 border-[#e0e0e0] py-2 text-base focus:outline-none focus:border-[#c63f3f] placeholder-gray-400 transition-colors bg-transparent resize-none">{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="mb-8">
                <label class="block mb-3 font-semibold text-[#555] text-sm">Foto Produk</label>

                @if($product->image)
                    <div class="flex items-center gap-4 mb-4 p-3 bg-gray-50 rounded-lg border border-dashed border-gray-300">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Foto Lama" class="w-16 h-16 object-cover rounded-md shadow-sm">
                        <div>
                            <p class="text-sm font-bold text-gray-700">Foto Saat Ini</p>
                            <p class="text-xs text-gray-500">Biarkan input di bawah kosong jika tidak ingin mengubah foto.</p>
                        </div>
                    </div>
                @endif

                <input type="file" name="image"
                        class="block w-full text-sm text-gray-500
                            file:mr-4 file:py-2 file:px-4; file:rounded-full file:border-0; file:text-sm file:font-semibold; file:bg-red-50 file:text-[#c63f3f]; hover:file:bg-red-100; transition-all cursor-pointer">
                <p class="mt-2 text-xs text-gray-400">Format: JPG, PNG. Maks 2MB.</p>
            </div>

            <button type="submit" class="w-full bg-[#6a5af9] hover:bg-[#5a4bcd] text-white font-bold py-3 rounded-xl transition-all shadow-lg transform hover:-translate-y-1">
                Simpan Perubahan
            </button>

        </form>
    </div>
</div>
@endsection
