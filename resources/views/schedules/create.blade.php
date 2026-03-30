<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl leading-tight flex items-center gap-2">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-500 to-blue-500">{{ __('Buat Misi Baru') }}</span>
            <span>🛸</span>
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-pink-50 via-purple-50 to-blue-50 min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-3xl border-4 border-indigo-300 shadow-[8px_8px_0_0_#a5b4fc] p-8">

                <form action="{{ route('schedules.store') }}" method="POST">
                    @csrf

                    <div class="mb-6">
                        <label class="block text-lg font-black text-indigo-600 mb-2">Nama Misi / Kegiatan 🎯</label>
                        <input type="text" name="title" class="w-full rounded-2xl border-4 border-indigo-200 focus:border-indigo-500 focus:ring-0 text-lg font-bold p-4 transition-colors" value="{{ old('title') }}" placeholder="Contoh: Meeting sama Alien..." required>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-lg font-black text-indigo-600 mb-2">Tanggal Berangkat 📅</label>
                            <input type="date" name="schedule_date" class="w-full rounded-2xl border-4 border-indigo-200 focus:border-indigo-500 focus:ring-0 text-lg font-bold p-4 transition-colors" value="{{ old('schedule_date') }}" required>
                        </div>
                        <div>
                            <label class="block text-lg font-black text-indigo-600 mb-2">Jam Main ⏰</label>
                            <input type="time" name="schedule_time" class="w-full rounded-2xl border-4 border-indigo-200 focus:border-indigo-500 focus:ring-0 text-lg font-bold p-4 transition-colors" value="{{ old('schedule_time') }}" required>
                        </div>
                    </div>

                    <div class="mb-8">
                        <label class="block text-lg font-black text-indigo-600 mb-2">Detail Misi (Opsional) 🗺️</label>
                        <textarea name="description" rows="4" class="w-full rounded-2xl border-4 border-indigo-200 focus:border-indigo-500 focus:ring-0 text-lg font-medium p-4 transition-colors" placeholder="Siapin mental dan camilan...">{{ old('description') }}</textarea>
                    </div>

                    <div class="flex items-center justify-end gap-4">
                        <a href="{{ route('schedules.index') }}" class="px-5 py-3 bg-gray-200 text-gray-700 rounded-2xl hover:bg-gray-300 font-bold shadow-[0_4px_0_0_#9ca3af] active:shadow-none active:translate-y-1 transition-all">Mundur 🔙</a>
                        <button type="submit" class="px-6 py-3 bg-indigo-500 text-white rounded-2xl hover:bg-indigo-400 font-black text-lg shadow-[0_4px_0_0_#4338ca] active:shadow-none active:translate-y-1 transition-all">
                            Kunci Jadwal! 🚀
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>