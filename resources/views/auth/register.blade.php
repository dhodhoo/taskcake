<x-guest-layout>
    <div class="text-center mb-8">
        <h2 class="text-2xl font-black text-pink-500 mb-2">Buat Akun Baru! ✨</h2>
        <p class="text-gray-500 font-medium text-sm">Satu langkah lagi menuju hidup terorganisir.</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-sm font-black text-gray-700 mb-2">Nama Lengkap 📛</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                class="w-full rounded-2xl border-4 border-pink-100 focus:border-pink-400 focus:ring-0 text-gray-800 font-bold p-3 transition-colors" placeholder="Nama kamu...">
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500 font-bold text-sm" />
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-black text-gray-700 mb-2">Email Aktif 💌</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                class="w-full rounded-2xl border-4 border-pink-100 focus:border-pink-400 focus:ring-0 text-gray-800 font-bold p-3 transition-colors" placeholder="contoh@email.com">
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 font-bold text-sm" />
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-black text-gray-700 mb-2">Kata Sandi 🔑</label>
            <input id="password" type="password" name="password" required autocomplete="new-password"
                class="w-full rounded-2xl border-4 border-pink-100 focus:border-pink-400 focus:ring-0 text-gray-800 font-bold p-3 transition-colors">
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 font-bold text-sm" />
        </div>

        <div class="mb-8">
            <label for="password_confirmation" class="block text-sm font-black text-gray-700 mb-2">Ketik Ulang Sandi 🔒</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                class="w-full rounded-2xl border-4 border-pink-100 focus:border-pink-400 focus:ring-0 text-gray-800 font-bold p-3 transition-colors">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500 font-bold text-sm" />
        </div>

        <div class="flex flex-col gap-4">
            <button type="submit" class="w-full py-4 bg-pink-500 text-white rounded-2xl font-black text-lg shadow-[0_4px_0_0_#db2777] hover:bg-pink-400 active:shadow-none active:translate-y-1 transition-all">
                Buat Akunku! 🎉
            </button>

            <p class="text-center text-sm font-medium text-gray-500 mt-2">
                Sudah punya akun? <a href="{{ route('login') }}" class="font-bold text-purple-600 hover:text-purple-700">Yuk Masuk!</a>
            </p>
        </div>
    </form>
</x-guest-layout>