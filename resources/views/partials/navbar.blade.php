<nav class="bg-white shadow-[0_2px_4px_rgba(0,0,0,0.1)] px-8 py-4 flex justify-between items-center sticky top-0 z-50 rounded-[10px] font-poppins m-4">

    <div class="text-2xl font-bold text-[#333]">
        <a href="/dashboard" class="flex items-center gap-2 no-underline text-[#333]">
            <img src="{{ asset('assets/logojajanyuk2.png') }}" alt="Logo" class="h-10 w-auto object-contain">
        </a>
    </div>

    <ul class="hidden md:flex gap-6 list-none m-0 p-0 items-center">

        @if(Auth::user()->role == 'admin')
            <li><a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'text-[#6a5af9]' : 'text-[#555]' }} font-medium hover:text-[#6a5af9] transition">Produk</a></li>
            <li>
                <a href="{{ Auth::user()->role == 'admin' ? route('admin.home') : route('customer.dashboard') }}"
                    class="{{ request()->routeIs('admin.home') || request()->routeIs('customer.dashboard') ? 'text-[#6a5af9]' : 'text-[#555]' }} font-medium hover:text-[#6a5af9] transition">
                    Home
                </a>
            </li>
            <li>
                <a href="{{ route('categories.index') }}"
                    class="{{ request()->routeIs('categories.index') ? 'text-[#6a5af9]' : 'text-[#555]' }} font-medium hover:text-[#6a5af9] transition">Kategori
                </a>
            </li>
            <li>
                <a href="{{ route('admin.orders.index') }}"
                    class="{{ request()->routeIs('admin.orders.index') ? 'text-[#6a5af9]' : 'text-[#555]' }} font-medium hover:text-[#6a5af9] transition">
                    Pesanan Masuk
                    @php
                        $pendingOrders = \App\Models\Order::where('status', 'pending')->count();
                    @endphp
                    @if($pendingOrders > 0)
                        <span class="bg-red-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full shadow-sm animate-pulse">
                            {{ $pendingOrders }}
                        </span>
                    @endif
                </a>
            </li>

        @else
            <li>
                <a href="{{ route('customer.orders') }}" class="text-[#555] font-medium transition-colors hover:text-[#6a5af9]">
                    Pesanan
                </a>
            </li>
            <li>
                <a href="{{ route('customer.dashboard') }}"
                    class="{{ request()->routeIs('customer.dashboard') ? 'text-[#6a5af9]' : 'text-[#555]' }} font-medium hover:text-[#6a5af9] transition">
                    Belanja
                </a>
            </li>

            <li>
                <a href="{{ route('cart.index') }}"
                    class="{{ request()->routeIs('cart.index') ? 'text-[#6a5af9]' : 'text-[#555]' }} font-medium hover:text-[#6a5af9] transition flex items-center gap-1">

                    Keranjang

                    @auth
                        @php
                            $cartCount = \App\Models\Cart::where('user_id', Auth::id())->sum('quantity');
                        @endphp

                        @if($cartCount > 0)
                            <span class="bg-red-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full shadow-sm">
                                {{ $cartCount }}
                            </span>
                        @endif
                    @endauth
                </a>
            </li>
        @endif
    </ul>

    <div class="relative">
        <button onclick="toggleDropdown()" class="flex items-center gap-2 focus:outline-none">
            <div class="text-right hidden md:block">
                <p class="text-sm font-bold text-gray-700">{{ Auth::user()->name }}</p>
                <p class="text-xs text-gray-500">{{ ucfirst(Auth::user()->role) }}</p>
            </div>

            @if(Auth::user()->avatar)
                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Profile" class="w-10 h-10 rounded-full object-cover border border-gray-200 shadow-sm">
            @else
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=6a5af9&color=fff" alt="Profile" class="w-10 h-10 rounded-full object-cover border border-gray-200 shadow-sm">
            @endif
        </button>

        <div id="profileDropdown" class="hidden absolute right-0 mt-3 w-48 bg-white rounded-xl shadow-xl border border-gray-100 py-2 overflow-hidden z-50 origin-top-right transition-all">
            <div class="px-4 py-2 border-b border-gray-100 md:hidden">
                <p class="text-sm font-bold text-gray-800">{{ Auth::user()->name }}</p>
            </div>

            @if(Auth::user()->role == 'admin')
                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#6a5af9]">
                    ⚙️ Edit Profil
            </a>
            @else
                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#6a5af9]">
                    ⚙️ Edit Profil Saya
                </a>
            @endif

            <div class="border-t border-gray-100 my-1"></div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition font-semibold">
                    🚪 Logout
                </button>
            </form>
        </div>
    </div>
</nav>
