@extends('layouts.main')

@section('content')

<div class="form-container" style="max-width: 800px; margin: 0 auto;">

    <div class="dashboard-header" style="margin-bottom: 20px; display: flex; align-items: center; gap: 15px;">
        {{-- Tombol Kembali --}}
        <a href="{{ route('admin.dashboard') }}" style="text-decoration: none; color: #333; font-size: 20px;">&larr;</a>
        <h1 style="font-family: 'Poppins', sans-serif; margin: 0;">Tambah Barang Baru</h1>
    </div>

    <div class="card-form" style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label class="block mb-1 font-semibold text-[#555] text-sm">Nama Barang</label>
                <input type="text" name="name" required
                class="w-full border-b-2 border-[#e0e0e0] py-2 text-base focus:outline-none focus:border-[#c63f3f] placeholder-gray-400 transition-colors"
                placeholder="Masukkan nama barang">
            </div>

            <div class="grid grid-cols-2 gap-6 mb-4">
                <div>
                    <label class="block mb-1 font-semibold text-[#555] text-sm">Harga (Rp)</label>
                    <input type="number" name="price" required
                    class="w-full border-b-2 border-[#e0e0e0] py-2 text-base focus:outline-none focus:border-[#c63f3f] placeholder-gray-400 transition-colors"
                    placeholder="0">
            </div>

                <div>
                    <label class="block mb-1 font-semibold text-[#555] text-sm">Stok Awal</label>
                    <input type="number" name="stock" required
                    class="w-full border-b-2 border-[#e0e0e0] py-2 text-base focus:outline-none focus:border-[#c63f3f] placeholder-gray-400 transition-colors"
                    placeholder="0">
                </div>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-semibold text-[#555] text-sm">Kategori</label>
                <select name="category_id"
                    class="w-full border-b-2 border-[#e0e0e0] py-2 text-base focus:outline-none focus:border-[#c63f3f] bg-transparent transition-colors cursor-pointer">
                    <option value="">-- Pilih Kategori (Opsional) --</option>
                        @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-semibold text-[#555] text-sm">Deskripsi Produk</label>
                <textarea name="description" rows="3"
                class="w-full border-b-2 border-[#e0e0e0] py-2 text-base focus:outline-none focus:border-[#c63f3f] placeholder-gray-400 transition-colors resize-none"
                placeholder="Jelaskan detail produk..."></textarea>
            </div>

            <div class="mb-6">
                <label class="block mb-2 font-semibold text-[#555] text-sm">Foto Produk</label>
                <input type="file" name="image"
                class="block w-full text-sm text-gray-500; file:mr-4 file:py-2 file:px-4; file:rounded-full file:border-0; file:text-sm file:font-semibold; file:bg-red-50 file:text-[#c63f3f]; hover:file:bg-red-100; transition-all cursor-pointer">
                <p class="mt-1 text-xs text-gray-400">Format: JPG, PNG, JPEG. Maks 2MB.</p>
            </div>

            <button type="submit" style="width: 100%; background: #6a5af9; color: white; padding: 12px; border: none; border-radius: 8px; font-weight: bold; font-size: 16px; cursor: pointer;">
                Simpan Produk
            </button>

        </form>
    </div>

</div>

@endsection
