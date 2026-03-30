<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl leading-tight flex items-center gap-2">
            <span>✨</span>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-pink-500 to-violet-500">
                {{ Auth::user()->name }}'s Dashboard
            </span>
            <span>🧁</span>
        </h2>
    </x-slot>

    <div class="py-12 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white rounded-3xl border-4 border-pink-200 shadow-[8px_8px_0_0_#fbcfe8] p-6 transform transition duration-300 hover:-translate-y-2">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-pink-500 uppercase font-black tracking-widest mb-1">Total Catatan 📝</p>
                            <h3 class="text-5xl font-black text-pink-600 drop-shadow-sm">{{ $notesCount }}</h3>
                        </div>
                        <a href="{{ route('notes.index') }}" class="px-5 py-3 bg-pink-500 text-white rounded-2xl hover:bg-pink-400 font-bold shadow-[0_4px_0_0_#db2777] active:shadow-none active:translate-y-1 transition-all">
                            Buka Buku! 📖
                        </a>
                    </div>
                </div>

                <div class="bg-white rounded-3xl border-4 border-indigo-200 shadow-[8px_8px_0_0_#c7d2fe] p-6 transform transition duration-300 hover:-translate-y-2">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-indigo-500 uppercase font-black tracking-widest mb-1">Jadwal Hari Ini 🎯</p>
                            <h3 class="text-5xl font-black text-indigo-600 drop-shadow-sm">{{ $todaySchedules->count() }}</h3>
                        </div>
                        <a href="{{ route('schedules.index') }}" class="px-5 py-3 bg-indigo-500 text-white rounded-2xl hover:bg-indigo-400 font-bold shadow-[0_4px_0_0_#4338ca] active:shadow-none active:translate-y-1 transition-all">
                            Gasskeun! 🚀
                        </a>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                <div class="bg-white rounded-3xl border-4 border-yellow-200 shadow-[8px_8px_0_0_#fef08a] overflow-hidden relative flex flex-col h-full">
                    <div class="absolute -top-6 -right-6 w-20 h-20 bg-yellow-400 rounded-full opacity-20"></div>
                    <div class="p-8 relative z-10 flex-grow">
                        <h3 class="text-2xl font-black text-gray-800 mb-6 border-b-4 border-dashed border-yellow-200 pb-4">
                            Agenda Hari Ini 🌟
                        </h3>

                        @if($todaySchedules->isEmpty())
                        <div class="bg-yellow-50 border-2 border-yellow-200 p-6 rounded-2xl text-center text-yellow-700 font-bold text-lg">
                            🎉 Kosong! Waktunya main game! 🎮
                        </div>
                        @else
                        <ul class="space-y-4">
                            @foreach($todaySchedules as $schedule)
                            <li class="p-4 bg-gradient-to-r from-gray-50 to-white border-2 border-gray-100 rounded-2xl flex justify-between items-center hover:shadow-md transition">
                                <div class="flex items-center gap-4 min-w-0">
                                    <div class="bg-yellow-400 text-yellow-900 font-black px-3 py-1 rounded-xl shadow-sm flex-shrink-0">
                                        {{ \Carbon\Carbon::parse($schedule->schedule_time)->format('H:i') }}
                                    </div>
                                    <div class="min-w-0">
                                        <p class="font-bold text-gray-800 text-lg truncate">{{ $schedule->title }}</p>
                                        <p class="text-sm text-gray-500 truncate">{{ $schedule->description }}</p>
                                    </div>
                                </div>
                                <div class="text-2xl flex-shrink-0 ml-2">📌</div>
                            </li>
                            @endforeach
                        </ul>
                        @endif
                    </div>
                </div>

                <div class="bg-white rounded-3xl border-4 border-cyan-200 shadow-[8px_8px_0_0_#a5f3fc] overflow-hidden relative flex flex-col h-full">
                    <div class="absolute -bottom-6 -left-6 w-24 h-24 bg-cyan-400 rounded-full opacity-20"></div>
                    <div class="p-8 relative z-10 flex-grow">
                        <div class="flex justify-between items-end border-b-4 border-dashed border-cyan-200 pb-4 mb-6">
                            <h3 class="text-2xl font-black text-gray-800">Misi Mendatang 🔭</h3>
                            <a href="{{ route('schedules.index') }}" class="text-sm font-bold text-cyan-600 hover:text-cyan-800">Lihat Semua &rarr;</a>
                        </div>

                        @if($upcomingSchedules->isEmpty())
                        <div class="bg-cyan-50 border-2 border-cyan-200 p-6 rounded-2xl text-center text-cyan-700 font-bold text-lg">
                            Belum ada rencana masa depan. Yuk buat rencana! 🗓️
                        </div>
                        @else
                        <ul class="space-y-4">
                            @foreach($upcomingSchedules as $schedule)
                            <li class="p-4 bg-gradient-to-r from-cyan-50 to-white border-2 border-cyan-100 rounded-2xl flex items-center gap-4 hover:shadow-md transition">
                                <div class="bg-cyan-300 text-cyan-900 font-black px-3 py-2 rounded-xl shadow-sm text-center flex-shrink-0 leading-none">
                                    <div class="text-xs uppercase">{{ \Carbon\Carbon::parse($schedule->schedule_date)->format('M') }}</div>
                                    <div class="text-xl">{{ \Carbon\Carbon::parse($schedule->schedule_date)->format('d') }}</div>
                                </div>
                                <div class="min-w-0">
                                    <p class="font-bold text-gray-800 text-lg truncate">{{ $schedule->title }}</p>
                                    <p class="text-sm text-gray-500 font-bold">{{ \Carbon\Carbon::parse($schedule->schedule_time)->format('H:i') }} WIB</p>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                        @endif
                    </div>
                </div>

            </div>

            <div class="bg-white rounded-3xl border-4 border-purple-200 shadow-[8px_8px_0_0_#e9d5ff] relative overflow-hidden">
                <div class="absolute top-0 right-0 w-40 h-40 bg-pink-100 rounded-bl-full opacity-30"></div>
                <div class="p-8 relative z-10">
                    <div class="flex justify-between items-end border-b-4 border-dashed border-purple-200 pb-4 mb-6">
                        <h3 class="text-2xl font-black text-gray-800">Catatan Terakhir Ditulis ✍️</h3>
                        <a href="{{ route('notes.index') }}" class="text-sm font-bold text-purple-600 hover:text-purple-800">Buka Rak Buku &rarr;</a>
                    </div>

                    @if($recentNotes->isEmpty())
                    <div class="bg-purple-50 border-2 border-purple-200 p-6 rounded-2xl text-center text-purple-700 font-bold text-lg">
                        Kosong nih... Tulis sesuatu yang lucu hari ini! 🦄
                    </div>
                    @else
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach($recentNotes as $note)
                        <a href="{{ route('notes.edit', $note) }}" class="block bg-purple-50 border-4 border-purple-100 rounded-2xl p-5 hover:border-purple-300 hover:shadow-[4px_4px_0_0_#d8b4fe] hover:-translate-y-1 transition-all group">
                            <h4 class="font-black text-lg text-gray-800 mb-2 truncate group-hover:text-purple-600">{{ $note->title }}</h4>
                            <p class="text-gray-500 text-sm whitespace-pre-wrap break-words line-clamp-3 mb-4">{{ $note->content }}</p>
                            <p class="text-xs font-bold text-purple-400">{{ $note->created_at->diffForHumans() }}</p>
                        </a>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>