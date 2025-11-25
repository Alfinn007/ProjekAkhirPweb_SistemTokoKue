@extends('layouts.main')

@section('content')
<div class="max-w-3xl mx-auto my-10">

    <div class="flex items-center gap-4 mb-8">
        @php
            $dashboardRoute = Auth::user()->role == 'admin' ? route('admin.dashboard') : route('customer.dashboard');
        @endphp

        <a href="{{ $dashboardRoute }}" class="text-gray-500 hover:text-[#6a5af9] transition">
            &larr; Kembali ke Dashboard
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="bg-[#ff4d4d] h-24 w-full relative">
            <div class="absolute -bottom-10 left-8">
                <div class="relative">
                    @if($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" class="w-24 h-24 rounded-full border-4 border-white object-cover shadow-md">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random" class="w-24 h-24 rounded-full border-4 border-white shadow-md">
                    @endif
                </div>
            </div>
        </div>

        <div class="pt-14 px-8 pb-8">
            <h1 class="text-2xl font-bold text-gray-800">{{ $user->name }}</h1>
            <p class="text-sm text-gray-500">{{ $user->email }} ({{ ucfirst($user->role) }})</p>

            @if(session('success'))
                <div class="mt-4 bg-green-100 text-green-800 p-3 rounded-lg text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:border-[#6a5af9] focus:ring-[#6a5af9] outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:border-[#6a5af9] focus:ring-[#6a5af9] outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Password Baru (Opsional)</label>
                        <input type="password" name="password" placeholder="Isi jika ingin ganti password"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:border-[#6a5af9] focus:ring-[#6a5af9] outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Ulangi Password</label>
                        <input type="password" name="password_confirmation" placeholder="Ketik ulang password baru"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:border-[#6a5af9] focus:ring-[#6a5af9] outline-none">
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Ganti Foto Profil</label>
                        <input type="file" name="avatar" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100 transition-all">
                    </div>
                </div>

                <div class="border-t border-gray-100 pt-6 flex justify-end">
                    <button type="submit" class="bg-[#6a5af9] hover:bg-[#5a4bcd] text-white font-bold py-2.5 px-6 rounded-lg transition-all shadow-lg">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
