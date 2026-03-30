<nav x-data="{ open: false }" class="bg-white/80 backdrop-blur-md border-b-4 border-pink-200 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex items-center gap-8">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="text-3xl font-black hover:scale-105 transition-transform flex items-center gap-2">
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-pink-500 via-purple-500 to-indigo-500">TaskCake</span>
                        <span>🧁</span>
                    </a>
                </div>

                @php
                // Styling untuk tombol yang sedang aktif vs tidak aktif
                $activeClass = 'bg-pink-100 border-4 border-pink-400 text-pink-700 shadow-[4px_4px_0_0_#f472b6]';
                $inactiveClass = 'bg-white border-4 border-transparent text-gray-500 hover:bg-purple-50 hover:border-purple-300 hover:text-purple-600 hover:shadow-[4px_4px_0_0_#d8b4fe]';
                @endphp

                <div class="hidden sm:flex sm:items-center sm:space-x-4">
                    <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-2xl font-bold transition-all {{ request()->routeIs('dashboard') ? $activeClass : $inactiveClass }}">
                        🏠 Dashboard
                    </a>
                    <a href="{{ route('schedules.index') }}" class="px-4 py-2 rounded-2xl font-bold transition-all {{ request()->routeIs('schedules.*') ? $activeClass : $inactiveClass }}">
                        🚀 Jadwal
                    </a>
                    <a href="{{ route('notes.index') }}" class="px-4 py-2 rounded-2xl font-bold transition-all {{ request()->routeIs('notes.*') ? $activeClass : $inactiveClass }}">
                        📖 Catatan
                    </a>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-4">

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center gap-2 px-4 py-2 bg-yellow-100 border-4 border-yellow-400 text-yellow-800 shadow-[4px_4px_0_0_#facc15] rounded-2xl font-bold hover:translate-y-1 hover:shadow-none transition-all focus:outline-none">
                            <div class="text-lg">😎</div>
                            <div>{{ Auth::user()->name }}</div>
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="bg-white border-4 border-purple-200 rounded-xl overflow-hidden shadow-[4px_4px_0_0_#e9d5ff]">
                            <x-dropdown-link :href="route('profile.edit')" class="hover:bg-purple-50 font-bold text-purple-700">
                                ⚙️ {{ __('Pengaturan Akun') }}
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="hover:bg-red-50 font-bold text-red-600 border-t border-purple-100">
                                    👋 {{ __('Keluar / Logout') }}
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-3 bg-pink-100 border-4 border-pink-300 text-pink-600 rounded-xl shadow-[4px_4px_0_0_#f9a8d4] hover:bg-pink-200 focus:outline-none transition-all">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-pink-50 border-t-4 border-pink-200">
        <div class="pt-2 pb-3 space-y-2 px-4">
            <a href="{{ route('dashboard') }}" class="block px-4 py-3 rounded-2xl font-bold {{ request()->routeIs('dashboard') ? 'bg-pink-200 text-pink-800' : 'text-pink-600 hover:bg-pink-100' }}">
                🏠 Dashboard
            </a>
            <a href="{{ route('schedules.index') }}" class="block px-4 py-3 rounded-2xl font-bold {{ request()->routeIs('schedules.*') ? 'bg-indigo-200 text-indigo-800' : 'text-indigo-600 hover:bg-indigo-100' }}">
                🚀 Jadwal
            </a>
            <a href="{{ route('notes.index') }}" class="block px-4 py-3 rounded-2xl font-bold {{ request()->routeIs('notes.*') ? 'bg-purple-200 text-purple-800' : 'text-purple-600 hover:bg-purple-100' }}">
                📖 Catatan
            </a>
        </div>

        <div class="pt-4 pb-4 border-t-4 border-pink-200 bg-white">
            <div class="px-6 flex items-center gap-3">
                <div class="text-3xl">😎</div>
                <div>
                    <div class="font-black text-lg text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-bold text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-4 space-y-2 px-4">
                <a href="{{ route('profile.edit') }}" class="block px-4 py-3 rounded-2xl font-bold text-purple-600 hover:bg-purple-100">
                    ⚙️ Profile
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="block px-4 py-3 rounded-2xl font-bold text-red-600 hover:bg-red-100">
                        👋 Log Out
                    </a>
                </form>
            </div>
        </div>
    </div>
</nav>