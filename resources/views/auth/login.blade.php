<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="text-center mb-8">
        <h2 class="text-2xl font-black text-purple-600 mb-2">Selamat Datang Kembali! 👋</h2>
        <p class="text-gray-500 font-medium text-sm">Ayo buka buku catatanmu lagi.</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-5">
            <label for="email" class="block text-sm font-black text-gray-700 mb-2">Email Kamu 💌</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                class="w-full rounded-2xl border-4 border-purple-100 focus:border-purple-400 focus:ring-0 text-gray-800 font-bold p-3 transition-colors placeholder-gray-300" placeholder="contoh@email.com">
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 font-bold text-sm" />
        </div>

        <div class="mb-5">
            <label for="password" class="block text-sm font-black text-gray-700 mb-2">Kata Sandi 🔑</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                class="w-full rounded-2xl border-4 border-purple-100 focus:border-purple-400 focus:ring-0 text-gray-800 font-bold p-3 transition-colors placeholder-gray-300" placeholder="Rahasia negara...">
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 font-bold text-sm" />
        </div>

        <div class="block mb-8">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" name="remember" class="rounded border-2 border-purple-300 text-purple-500 shadow-sm focus:ring-purple-500 w-5 h-5">
                <span class="ms-2 text-sm font-bold text-gray-600">Ingat Aku Terus! 🧠</span>
            </label>
        </div>

        <div class="flex flex-col gap-4">
            <button type="submit" class="w-full py-4 bg-purple-500 text-white rounded-2xl font-black text-lg shadow-[0_4px_0_0_#9333ea] hover:bg-purple-400 active:shadow-none active:translate-y-1 transition-all">
                Masuk Sekarang! 🚀
            </button>

            @if (Route::has('password.request'))
            <a class="text-center text-sm font-bold text-gray-500 hover:text-purple-600 transition-colors" href="{{ route('password.request') }}">
                Lupa kata sandi? 🥺
            </a>
            @endif

            <p class="text-center text-sm font-medium text-gray-500 mt-2">
                Belum punya toples kue? <a href="{{ route('register') }}" class="font-bold text-pink-500 hover:text-pink-600">Daftar di sini!</a>
            </p>
        </div>
    </form>
</x-guest-layout>