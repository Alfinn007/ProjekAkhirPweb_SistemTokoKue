<div class="mb-12 animate-fade-in-down">

    <div class="bg-gradient-to-r from-[#6a5af9] to-[#8b5cf6] rounded-3xl p-8 md:p-12 text-white shadow-xl relative overflow-hidden">
        <div class="absolute top-0 right-0 -mt-10 -mr-10 w-64 h-64 bg-white opacity-10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-40 h-40 bg-white opacity-10 rounded-full blur-2xl"></div>

        <div class="relative z-10 grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
            <div>
                <h1 class="text-4xl md:text-5xl font-bold mb-4 leading-tight">
                    Selamat Datang, <br> <span class="text-yellow-300">{{ Auth::user()->name }}!</span> 👋
                </h1>
                <p class="text-lg text-indigo-100 mb-6 leading-relaxed">
                    Mau ngemil apa hari ini? Yuk cek koleksi kue dan jajanan terbaru kami.
                </p>
                @if(!request('search'))
                    <a href="#katalog" class="bg-white text-[#6a5af9] font-bold px-8 py-3 rounded-full hover:bg-yellow-300 hover:text-[#6a5af9] transition shadow-lg inline-block transform hover:-translate-y-1">
                        Lihat Menu &darr;
                    </a>
                @endif
            </div>

            <div class="hidden md:flex justify-end">
                <div class="bg-white/20 p-4 rounded-2xl backdrop-blur-sm border border-white/30 rotate-3 hover:rotate-0 transition duration-500">
                    <img src="https://images.unsplash.com/photo-1559553156-2e97137af16f?auto=format&fit=crop&w=500&q=80"
                            alt="Toko Kue" class="rounded-xl shadow-lg w-64 h-64 object-cover">
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
        <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm flex items-center gap-4">
            <span class="text-2xl">🚀</span>
            <div><h3 class="font-bold text-gray-800">Cepat Sampai</h3><p class="text-xs text-gray-500">Pengiriman instan tersedia</p></div>
        </div>
        <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm flex items-center gap-4">
            <span class="text-2xl">🍰</span>
            <div><h3 class="font-bold text-gray-800">Selalu Fresh</h3><p class="text-xs text-gray-500">Dibuat setiap pagi</p></div>
        </div>
        <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm flex items-center gap-4">
            <span class="text-2xl">💖</span>
            <div><h3 class="font-bold text-gray-800">Rasa Juara</h3><p class="text-xs text-gray-500">Bahan premium pilihan</p></div>
        </div>
    </div>

</div>
