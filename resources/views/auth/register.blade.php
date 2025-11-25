<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Jajanyuk</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>body { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="bg-[#f0edff] min-h-screen grid place-items-center m-0 text-gray-700">

    <main class="flex flex-col md:flex-row w-full max-w-[900px] m-4 bg-white rounded-[10px] shadow-[0_10px_30px_rgba(0,0,0,0.1)] overflow-hidden">

        <div class="hidden md:flex w-full md:w-1/2 bg-[#ff4d4d] p-12 text-white flex-col justify-center text-center">
            <h2 class="text-2xl font-bold mb-4 uppercase tracking-wide">JOIN JAJANYUK</h2>
            <p class="mb-6 text-white/90">Daftar sekarang untuk mulai belanja jajanan favoritmu!</p>

            <div class="w-full h-[150px] bg-[#c63f3f] rounded-lg grid place-items-center mb-8 text-sm opacity-90">
                <img src="{{asset('assets/logojajanyuk.png')}}" alt="Logo" class="h-24 object-contain">
            </div>
        </div>

        <div class="w-full md:w-1/2 bg-white p-8 md:p-12">

            <h2 class="text-3xl font-bold text-[#333] mb-2">Daftar Akun</h2>
            <p class="mb-6 text-[#777]">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-[#c63f3f] font-semibold hover:underline">Login disini</a>
            </p>

            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-600 p-3 rounded-lg mb-4 text-sm">
                    <ul class="list-disc pl-4">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block mb-1 font-semibold text-[#555] text-sm">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" required autofocus
                        class="w-full border-b-2 border-[#e0e0e0] py-2 text-base focus:outline-none focus:border-[#c63f3f] placeholder-gray-400 transition-colors"
                        placeholder="Nama lengkap Anda">
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-semibold text-[#555] text-sm">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full border-b-2 border-[#e0e0e0] py-2 text-base focus:outline-none focus:border-[#c63f3f] placeholder-gray-400 transition-colors"
                        placeholder="nama@email.com">
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-semibold text-[#555] text-sm">Password</label>
                    <input type="password" name="password" required
                        class="w-full border-b-2 border-[#e0e0e0] py-2 text-base focus:outline-none focus:border-[#c63f3f] placeholder-gray-400 transition-colors"
                        placeholder="Minimal 8 karakter">
                </div>

                <div class="mb-8">
                    <label class="block mb-1 font-semibold text-[#555] text-sm">Ulangi Password</label>
                    <input type="password" name="password_confirmation" required
                        class="w-full border-b-2 border-[#e0e0e0] py-2 text-base focus:outline-none focus:border-[#c63f3f] placeholder-gray-400 transition-colors"
                        placeholder="Ketik ulang password">
                </div>

                <button type="submit"
                        class="w-full py-3.5 rounded-full bg-[#ff4d4d] text-white font-bold text-lg shadow-md hover:bg-[#c63f3f] transition duration-200 transform hover:-translate-y-0.5">
                    Buat Akun
                </button>

            </form>
        </div>
    </main>
</body>
</html>
