<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl leading-tight flex items-center gap-2">
            <span>⚙️</span>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-500 to-pink-500">{{ __('Pengaturan Akun') }}</span>
            <span>🧁</span>
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-pink-50 via-purple-50 to-blue-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <div class="p-8 sm:p-10 bg-white rounded-3xl border-4 border-pink-300 shadow-[8px_8px_0_0_#f9a8d4] relative overflow-hidden transform transition hover:-translate-y-1">
                <div class="absolute top-0 right-0 w-40 h-40 bg-pink-100 rounded-bl-full opacity-50"></div>
                <div class="max-w-xl relative z-10">
                    <h3 class="text-xl font-black text-pink-600 mb-4 border-b-4 border-dashed border-pink-200 pb-2">Informasi Dasar 🎀</h3>
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-8 sm:p-10 bg-white rounded-3xl border-4 border-indigo-300 shadow-[8px_8px_0_0_#a5b4fc] relative overflow-hidden transform transition hover:-translate-y-1">
                <div class="absolute top-0 right-0 w-40 h-40 bg-indigo-100 rounded-bl-full opacity-50"></div>
                <div class="max-w-xl relative z-10">
                    <h3 class="text-xl font-black text-indigo-600 mb-4 border-b-4 border-dashed border-indigo-200 pb-2">Keamanan & Password 🛡️</h3>
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-8 sm:p-10 bg-white rounded-3xl border-4 border-red-300 shadow-[8px_8px_0_0_#fca5a5] relative overflow-hidden transform transition hover:-translate-y-1">
                <div class="absolute top-0 right-0 w-40 h-40 bg-red-50 rounded-bl-full opacity-80"></div>
                <div class="max-w-xl relative z-10">
                    <h3 class="text-xl font-black text-red-600 mb-4 border-b-4 border-dashed border-red-200 pb-2">Zona Berbahaya 🚨</h3>
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>