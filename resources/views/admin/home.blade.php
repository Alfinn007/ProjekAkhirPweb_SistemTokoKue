@extends('layouts.main')

@section('content')
<div class="max-w-6xl mx-auto my-10 animate-fade-in-down">

    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Dashboard Admin</h1>
            <p class="text-gray-500 text-sm mt-1">Halo, {{ Auth::user()->name }}! Pantau performa tokomu hari ini.</p>
        </div>

        <div class="flex items-center gap-3">
            <span class="hidden md:block bg-indigo-50 text-[#6a5af9] px-4 py-2 rounded-lg text-sm font-bold">
                {{ now()->format('d F Y') }}
            </span>

            <a href="{{ route('admin.report.pdf') }}" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-bold flex items-center gap-2 shadow-md transition transform hover:-translate-y-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Export Laporan
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4 hover:shadow-lg transition">
            <div class="bg-green-100 p-4 rounded-xl text-green-600">💰</div>
            <div>
                <p class="text-sm text-gray-500 font-medium mb-1">Total Pendapatan</p>
                <h3 class="text-2xl font-bold text-gray-800">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4 hover:shadow-lg transition">
            <div class="bg-blue-100 p-4 rounded-xl text-blue-600">📦</div>
            <div>
                <p class="text-sm text-gray-500 font-medium mb-1">Total Pesanan</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ $totalOrders }}</h3>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4 hover:shadow-lg transition">
            <div class="bg-purple-100 p-4 rounded-xl text-purple-600">🍰</div>
            <div>
                <p class="text-sm text-gray-500 font-medium mb-1">Total Produk</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ $totalProducts }}</h3>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4 hover:shadow-lg transition">
            <div class="bg-orange-100 p-4 rounded-xl text-orange-600">👥</div>
            <div>
                <p class="text-sm text-gray-500 font-medium mb-1">Pelanggan</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ $totalCustomers }}</h3>
            </div>
        </div>
    </div>

    </div>
@endsection
