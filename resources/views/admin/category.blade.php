@extends('layouts.main')

@section('content')
<div class="max-w-5xl mx-auto my-10">

    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-[#6a5af9] transition font-medium">
            &larr; Kembali ke Dashboard
        </a>
        <h1 class="text-2xl font-bold text-gray-800">Kelola Kategori 🏷️</h1>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-4 text-sm font-bold border border-green-200">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-4 text-sm font-bold border border-red-200">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

        <div class="md:col-span-1">
            <div class="bg-white p-6 rounded-xl shadow-md border border-gray-100 sticky top-24">
                <h2 class="text-lg font-bold text-gray-800 mb-4">Tambah Baru</h2>

                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-semibold text-gray-600">Nama Kategori</label>
                        <input type="text" name="name" required placeholder="Contoh: Kue Kering"
                                class="w-full border-b-2 border-[#e0e0e0] py-2 text-base focus:outline-none focus:border-[#6a5af9] transition-colors bg-transparent">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="w-full bg-[#6a5af9] hover:bg-[#5a4bcd] text-white font-bold py-3 rounded-lg shadow-lg transition transform hover:-translate-y-1">
                        + Simpan
                    </button>
                </form>
            </div>
        </div>

        <div class="md:col-span-2">
            <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
                <div class="p-4 bg-gray-50 border-b border-gray-100">
                    <h3 class="font-bold text-gray-700">Daftar Kategori Tersedia</h3>
                </div>

                <ul class="divide-y divide-gray-100">
                    @forelse($categories as $category)
                        <li class="p-4 flex justify-between items-center hover:bg-gray-50 transition">
                            <span class="font-medium text-gray-800">{{ $category->name }}</span>

                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-bold px-3 py-1 rounded hover:bg-red-50 transition">
                                    Hapus 🗑️
                                </button>
                            </form>
                        </li>
                    @empty
                        <li class="p-8 text-center text-gray-400">Belum ada kategori.</li>
                    @endforelse
                </ul>
            </div>
        </div>

    </div>
</div>
@endsection
