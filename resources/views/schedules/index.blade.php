<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-extrabold text-2xl leading-tight flex items-center gap-2">
                <span>🎯</span>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-500 to-indigo-500">{{ __('Misi & Jadwalku') }}</span>
                <span>🚀</span>
            </h2>
            <a href="{{ route('schedules.create') }}" class="gsap-squishy-btn px-5 py-3 bg-indigo-500 text-white rounded-2xl hover:bg-indigo-400 font-bold shadow-[0_4px_0_0_#4338ca] active:shadow-none active:translate-y-1 transition-all">
                + Jadwal Baru ⏰
            </a>
        </div>
    </x-slot>

    <div class="py-12 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if(session('success'))
            <div class="mb-8 p-4 bg-green-100 border-4 border-green-300 text-green-800 rounded-3xl font-bold shadow-[4px_4px_0_0_#86efac] text-center text-lg">
                🎉 {{ session('success') }}
            </div>
            @endif

            <div class="mb-8">
                <form action="{{ route('schedules.index') }}" method="GET" class="flex flex-col sm:flex-row gap-4">
                    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari misi atau kegiatan... 🔎" class="w-full rounded-2xl border-4 border-indigo-200 focus:border-indigo-500 focus:ring-0 text-lg font-bold p-4 shadow-[4px_4px_0_0_#c7d2fe] transition-colors">
                    <button type="submit" class="gsap-squishy-btn px-8 py-4 bg-yellow-400 text-yellow-900 rounded-2xl font-black text-lg shadow-[0_4px_0_0_#ca8a04] hover:bg-yellow-300 active:shadow-none active:translate-y-1 transition-all">
                        Cari! 🚀
                    </button>
                    @if($search)
                    <a href="{{ route('schedules.index') }}" class="px-6 py-4 bg-gray-200 text-gray-700 rounded-2xl font-bold text-lg shadow-[0_4px_0_0_#9ca3af] hover:bg-gray-300 active:shadow-none active:translate-y-1 transition-all text-center">
                        Batal ✖️
                    </a>
                    @endif
                </form>
            </div>

            @if($schedules->isEmpty())
            <div class="bg-white rounded-3xl border-4 border-indigo-200 shadow-[8px_8px_0_0_#c7d2fe] p-12 text-center">
                @if($search)
                <p class="text-xl text-indigo-500 font-bold">Misi "{{ $search }}" tidak ditemukan, Bos! 🕵️‍♀️</p>
                @else
                <p class="text-xl text-indigo-500 font-bold">Jadwalmu kosong melompong! Waktunya rebahan! 🛋️</p>
                @endif
            </div>
            @else
            <div class="space-y-6 mb-8">
                @foreach($schedules as $schedule)
                <div class="gsap-stagger-card bg-white rounded-3xl border-4 border-indigo-300 shadow-[8px_8px_0_0_#a5b4fc] p-6 flex flex-col md:flex-row items-center justify-between transform transition hover:scale-[1.01]">

                    <div class="bg-yellow-300 border-4 border-yellow-400 rounded-2xl p-4 text-center min-w-[120px] shadow-inner mb-4 md:mb-0">
                        <p class="text-yellow-900 font-black text-sm uppercase">{{ \Carbon\Carbon::parse($schedule->schedule_date)->format('M') }}</p>
                        <p class="text-yellow-900 font-black text-3xl">{{ \Carbon\Carbon::parse($schedule->schedule_date)->format('d') }}</p>
                        <div class="mt-2 bg-yellow-100 rounded-lg py-1 px-2 text-yellow-800 font-bold text-sm">
                            {{ \Carbon\Carbon::parse($schedule->schedule_time)->format('H:i') }}
                        </div>
                    </div>

                    <div class="flex-grow md:px-8 text-center md:text-left w-full min-w-0">
                        <h3 class="text-2xl font-black text-gray-800 mb-2 break-words">{{ $schedule->title }}</h3>
                        <p class="text-gray-500 font-medium text-lg whitespace-pre-wrap break-words">{{ $schedule->description ?? 'Tidak ada deskripsi' }}</p>
                    </div>

                    <div class="flex space-x-3 mt-4 md:mt-0 flex-shrink-0">
                        <a href="{{ route('schedules.edit', $schedule) }}" class="p-3 bg-blue-400 text-white rounded-xl hover:bg-blue-300 font-bold shadow-[0_4px_0_0_#1d4ed8] active:shadow-none active:translate-y-1 transition-all">🛠️ Edit</a>
                        <form action="{{ route('schedules.destroy', $schedule) }}" method="POST" onsubmit="return confirm('Coret jadwal ini? ❌');" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-3 bg-red-400 text-white rounded-xl hover:bg-red-300 font-bold shadow-[0_4px_0_0_#991b1b] active:shadow-none active:translate-y-1 transition-all">🗑️ Hapus</button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $schedules->links() }}
            </div>
            @endif

        </div>
    </div>
</x-app-layout>