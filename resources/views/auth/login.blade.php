<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Jajanyuk</title>

    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-[#f0edff] min-h-screen grid place-items-center m-0 text-gray-700">

    <main class="flex flex-col md:flex-row w-full max-w-[900px] m-4 bg-white rounded-[10px] shadow-[0_10px_30px_rgba(0,0,0,0.1)] overflow-hidden">

        <div class="w-full md:w-1/2 bg-[#ff4d4d] p-12 text-white flex flex-col justify-center text-center">
            <h2 class="text-2xl font-bold mb-4 uppercase tracking-wide">WELCOME TO</h2>
            <div class="w-full h-[200px] bg-[#ff4d4d] rounded-lg grid place-items-center mb-8 text-sm opacity-90">
                <img src="{{asset('assets/logojajanyuk.png')}}" alt="Logo jajanyuk" class="h-40 w-auto object-contain drop-shadow-lg">
            </div>

            <div class="flex justify-around text-sm">
                <div class="flex flex-col items-center w-[30%]">
                    <p class="text-xs">kue</p>
                </div>
                <div class="flex flex-col items-center w-[30%]">
                    <p class="text-xs">enak</p>
                </div>
                <div class="flex flex-col items-center w-[30%]">
                    <p class="text-xs">Murah</p>
                </div>
            </div>
        </div>

        <div class="w-full md:w-1/2 bg-white p-12">

            <h2 class="text-3xl font-bold text-[#333] mb-2">Login</h2>
            <p class="mb-8 text-[#777]">
                Tidak punya akun?
                <a href="{{'register'}}" class="text-[#c63f3f] font-semibold no-underline hover:underline">Daftar</a>
            </p>

            @if ($errors->any())
                <div class="bg-red-100 border border-red-200 text-red-800 p-4 rounded-md mb-6 text-sm">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf

                <div class="mb-6">
                    <label for="email" class="block mb-2 font-semibold text-[#555] text-sm">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full border-b-2 border-[#e0e0e0] py-2 text-base transition-colors duration-300 focus:outline-none focus:border-[#c63f3f] placeholder-gray-400 text-black">
                </div>

                <div class="mb-6">
                    <label for="password" class="block mb-2 font-semibold text-[#555] text-sm">Password</label>
                    <div class="relative">
                        <input type="password" id="password" name="password" required
                                class="w-full border-b-2 border-[#e0e0e0] py-2 text-base transition-colors duration-300 focus:outline-none focus:border-[#c63f3f] placeholder-gray-400 text-black">

                        <span class="absolute right-0 top-1/2 -translate-y-1/2 cursor-pointer text-gray-400 hover:text-gray-600">
                        </span>
                    </div>
                </div>

                <div class="flex justify-between items-center mb-6 text-sm">
                    <div class="flex items-center">
                        <input type="checkbox" id="remember" name="remember" class="mr-2 rounded text-[#c63f3f] focus:ring-[#c63f3f] accent-[#c63f3f]">
                        <label for="remember" class="text-gray-600 cursor-pointer">Remember me</label>
                    </div>
                    <a href="#" class="text-[#c63f3f] font-semibold no-underline hover:underline">Forgot password?</a>
                </div>

                <div class="mb-6">
                    <button type="submit"
                            class="w-full py-3.5 rounded-full bg-[#ff4d4d] text-white font-bold text-lg shadow-md hover:bg-[#c63f3f] transition duration-200 transform hover:-translate-y-0.5">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </main>

</body>
</html>
