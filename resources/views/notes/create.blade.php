<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl leading-tight flex items-center gap-2">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-500 to-pink-500">{{ __('Tulis Catatan Baru') }}</span>
            <span>✍️</span>
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-pink-50 via-purple-50 to-blue-50 min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-3xl border-4 border-purple-300 shadow-[8px_8px_0_0_#d8b4fe] p-8 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-pink-200 rounded-bl-full opacity-30"></div>

                <form action="{{ route('notes.store') }}" method="POST" class="relative z-10">
                    @csrf

                    <div class="mb-6">
                        <label class="block text-lg font-black text-purple-600 mb-2">Judul Catatan 🏷️</label>
                        <input type="text" name="title" class="w-full rounded-2xl border-4 border-purple-200 focus:border-purple-500 focus:ring-0 text-lg font-bold p-4 transition-colors" value="{{ old('title') }}" placeholder="Contoh: Resep Kue Coklat..." required>
                    </div>

                    <div class="mb-8">
                        <label class="block text-lg font-black text-purple-600 mb-2">Isi Cerita 📝</label>
                        <textarea name="content" rows="6" class="w-full rounded-2xl border-4 border-purple-200 focus:border-purple-500 focus:ring-0 text-lg font-medium p-4 transition-colors" placeholder="Ketik apa saja di sini..." required>{{ old('content') }}</textarea>
                    </div>

                    <div class="flex items-center justify-end gap-4">
                        <a href="{{ route('notes.index') }}" class="px-5 py-3 bg-gray-200 text-gray-700 rounded-2xl hover:bg-gray-300 font-bold shadow-[0_4px_0_0_#9ca3af] active:shadow-none active:translate-y-1 transition-all">Kembali 🔙</a>
                        <button type="submit" class="px-6 py-3 bg-purple-500 text-white rounded-2xl hover:bg-purple-400 font-black text-lg shadow-[0_4px_0_0_#7e22ce] active:shadow-none active:translate-y-1 transition-all">
                            Simpan ke Toples! 🍬
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>