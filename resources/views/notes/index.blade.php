<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-extrabold text-2xl leading-tight flex items-center gap-2">
                <span>✨</span>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-pink-500 to-rose-500">{{ __('Koleksi Catatanku') }}</span>
                <span>📖</span>
            </h2>
            <a href="{{ route('notes.create') }}" class="gsap-squishy-btn px-5 py-3 bg-pink-500 text-white rounded-2xl hover:bg-pink-400 font-bold shadow-[0_4px_0_0_#db2777] active:shadow-none active:translate-y-1 transition-all">
                + Tulis Baru 🧁
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
                <form action="{{ route('notes.index') }}" method="GET" class="flex flex-col sm:flex-row gap-4">
                    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari judul atau isi catatan di sini... 🔎" class="w-full rounded-2xl border-4 border-pink-200 focus:border-pink-500 focus:ring-0 text-lg font-bold p-4 shadow-[4px_4px_0_0_#fbcfe8] transition-colors">
                    <button type="submit" class="gsap-squishy-btn px-8 py-4 bg-yellow-400 text-yellow-900 rounded-2xl font-black text-lg shadow-[0_4px_0_0_#ca8a04] hover:bg-yellow-300 active:shadow-none active:translate-y-1 transition-all">
                        Cari! 🚀
                    </button>
                    @if($search)
                    <a href="{{ route('notes.index') }}" class="px-6 py-4 bg-gray-200 text-gray-700 rounded-2xl font-bold text-lg shadow-[0_4px_0_0_#9ca3af] hover:bg-gray-300 active:shadow-none active:translate-y-1 transition-all text-center">
                        Batal ✖️
                    </a>
                    @endif
                </form>
            </div>

            @if($notes->isEmpty())
            <div class="bg-white rounded-3xl border-4 border-pink-200 shadow-[8px_8px_0_0_#fbcfe8] p-12 text-center">
                @if($search)
                <p class="text-xl text-pink-500 font-bold">Waduh, catatan "{{ $search }}" tidak ditemukan! 🕵️‍♀️</p>
                @else
                <p class="text-xl text-pink-500 font-bold">Belum ada catatan nih... Yuk buat catatan pertamamu! 🍭</p>
                @endif
            </div>
            @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-8">
                @foreach($notes as $note)
                <div class="gsap-stagger-card bg-white rounded-3xl border-4 border-pink-300 shadow-[8px_8px_0_0_#f9a8d4] flex flex-col transform transition hover:-translate-y-2 hover:shadow-[12px_12px_0_0_#f9a8d4]">
                    <div class="p-6 flex-grow relative overflow-hidden">
                        <div class="absolute -top-4 -right-4 w-16 h-16 bg-yellow-200 rounded-full opacity-40"></div>
                        <h3 class="text-xl font-black text-gray-800 mb-3 relative z-10 break-words">{{ $note->title }}</h3>
                        <p class="text-gray-600 font-medium whitespace-pre-wrap break-words relative z-10">{{ Str::limit($note->content, 120) }}</p>
                    </div>
                    <div class="bg-pink-50 px-6 py-4 border-t-4 border-pink-200 flex justify-between items-center rounded-b-2xl">
                        <span class="text-sm font-bold text-pink-400">{{ $note->created_at->format('d M, H:i') }}</span>
                        <div class="flex space-x-3">
                            <a href="{{ route('notes.edit', $note) }}" class="p-2 bg-yellow-400 text-yellow-900 rounded-xl hover:bg-yellow-300 font-bold shadow-[0_3px_0_0_#a16207] active:shadow-none active:translate-y-1 transition-all">✏️</a>
                            <form action="{{ route('notes.destroy', $note) }}" method="POST" onsubmit="return confirm('Yakin mau buang catatan ini? 🥺');" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 bg-red-400 text-white rounded-xl hover:bg-red-300 font-bold shadow-[0_3px_0_0_#991b1b] active:shadow-none active:translate-y-1 transition-all">🗑️</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $notes->links() }}
            </div>
            @endif

        </div>
    </div>
</x-app-layout>