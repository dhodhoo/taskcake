<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-extrabold text-2xl leading-tight flex items-center gap-2">
                <span>🌍</span>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-500 to-cyan-500">{{ __('Global Notes') }}</span>
                <span>✨</span>
            </h2>
        </div>
    </x-slot>

    <div class="py-12 min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            @if(session('success'))
            <div class="mb-8 p-4 bg-green-100 border-4 border-green-300 text-green-800 rounded-3xl font-bold shadow-[4px_4px_0_0_#86efac] text-center text-lg">
                🎉 {{ session('success') }}
            </div>
            @endif

            <!-- Form to Create New Post -->
            <div class="bg-white rounded-3xl border-4 border-blue-300 shadow-[8px_8px_0_0_#bfdbfe] p-6 mb-12 transform transition hover:-translate-y-1 hover:shadow-[10px_10px_0_0_#bfdbfe]">
                <form action="{{ route('posts.store') }}" method="POST">
                    @csrf
                    <textarea name="content" rows="3" placeholder="Apa yang sedang kamu pikirkan? Bagikan ke semua orang! 🌟" class="w-full rounded-2xl border-4 border-blue-200 focus:border-blue-500 focus:ring-0 text-lg font-bold p-4 shadow-[4px_4px_0_0_#dbeafe] transition-colors mb-4 resize-none" required></textarea>
                    <div class="flex justify-end">
                        <button type="submit" class="px-8 py-4 bg-blue-500 text-white rounded-2xl font-black text-lg shadow-[0_4px_0_0_#1d4ed8] hover:bg-blue-400 active:shadow-none active:translate-y-1 transition-all">
                            Posting! 🚀
                        </button>
                    </div>
                </form>
            </div>

            <!-- List of Posts -->
            <div class="space-y-8">
                @foreach($posts as $post)
                <div class="bg-white rounded-3xl border-4 border-purple-300 shadow-[8px_8px_0_0_#e9d5ff] flex flex-col transform transition hover:-translate-y-1 hover:shadow-[12px_12px_0_0_#e9d5ff]" x-data="{ showComments: false }">
                    <!-- Post Header & Content -->
                    <div class="p-6 pb-4">
                        <div class="flex justify-between items-center mb-4 border-b-4 border-dashed border-purple-100 pb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 bg-purple-200 rounded-full flex items-center justify-center font-black text-purple-700 text-xl border-4 border-purple-400 shadow-[2px_2px_0_0_#a855f7]">
                                    {{ substr($post->user->name, 0, 1) }}
                                </div>
                                <div>
                                    <h3 class="font-black text-gray-800 text-lg">{{ $post->user->name }}</h3>
                                    <span class="text-sm font-bold text-purple-400">{{ $post->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                            @if(auth()->id() === $post->user_id)
                            <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Yakin mau hapus post ini? 🥺');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 bg-red-400 text-white rounded-xl hover:bg-red-300 font-bold shadow-[0_3px_0_0_#991b1b] active:shadow-none active:translate-y-1 transition-all">🗑️</button>
                            </form>
                            @endif
                        </div>
                        <p class="text-gray-700 font-medium text-lg whitespace-pre-wrap break-words leading-relaxed">{{ $post->content }}</p>
                    </div>

                    <!-- Post Actions (Likes & Comments Toggle) -->
                    <div class="bg-purple-50 px-6 py-4 border-y-4 border-purple-200 flex justify-between items-center">
                        <div class="flex gap-4">
                            <!-- Like Button -->
                            <form action="{{ route('likes.toggle', $post) }}" method="POST">
                                @csrf
                                @php
                                    $hasLiked = $post->likes->contains('user_id', auth()->id());
                                @endphp
                                <button type="submit" class="flex items-center gap-2 px-4 py-2 {{ $hasLiked ? 'bg-pink-100 text-pink-600 border-pink-300 shadow-[0_3px_0_0_#f9a8d4]' : 'bg-white text-gray-500 border-gray-200 shadow-[0_3px_0_0_#e5e7eb]' }} rounded-xl border-4 font-bold hover:bg-pink-50 active:shadow-none active:translate-y-1 transition-all">
                                    <span>{{ $hasLiked ? '❤️' : '🤍' }}</span>
                                    <span>{{ $post->likes->count() }}</span>
                                </button>
                            </form>

                            <!-- Comment Button -->
                            <button @click="showComments = !showComments" class="flex items-center gap-2 px-4 py-2 bg-white text-blue-500 border-4 border-blue-200 shadow-[0_3px_0_0_#bfdbfe] rounded-xl font-bold hover:bg-blue-50 active:shadow-none active:translate-y-1 transition-all">
                                <span>💬</span>
                                <span>{{ $post->comments->count() }}</span>
                            </button>
                        </div>
                    </div>

                    <!-- Comments Section -->
                    <div x-show="showComments" x-transition class="bg-purple-50 rounded-b-2xl p-6 pt-2">
                        
                        <!-- Add Comment Form -->
                        <form action="{{ route('comments.store', $post) }}" method="POST" class="flex gap-2 mb-6 mt-4">
                            @csrf
                            <input type="text" name="content" placeholder="Tulis komentar... 🪁" class="w-full rounded-2xl border-4 border-purple-200 focus:border-purple-400 focus:ring-0 font-bold p-3 shadow-[4px_4px_0_0_#e9d5ff] transition-colors" required>
                            <button type="submit" class="px-6 py-3 bg-yellow-400 text-yellow-900 rounded-2xl font-black shadow-[0_4px_0_0_#ca8a04] hover:bg-yellow-300 active:shadow-none active:translate-y-1 transition-all">
                                Kirim
                            </button>
                        </form>

                        <!-- List of Comments -->
                        <div class="space-y-4">
                            @forelse($post->comments as $comment)
                            <div class="bg-white p-4 rounded-3xl border-4 border-purple-100 shadow-[4px_4px_0_0_#f3e8ff]">
                                <div class="flex justify-between items-start mb-2 border-b-2 border-purple-50 pb-2">
                                    <div class="flex gap-2 items-center">
                                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center font-bold text-blue-600 border-2 border-blue-300 text-sm shadow-[1px_1px_0_0_#93c5fd]">
                                            {{ substr($comment->user->name, 0, 1) }}
                                        </div>
                                        <span class="font-black text-gray-700">{{ $comment->user->name }}</span>
                                        <span class="text-xs font-bold text-purple-300">{{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                    @if(auth()->id() === $comment->user_id)
                                    <form action="{{ route('comments.destroy', $comment) }}" method="POST" onsubmit="return confirm('Hapus komentar?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-300 hover:text-red-500 text-sm font-black p-1">✖</button>
                                    </form>
                                    @endif
                                </div>
                                <p class="text-gray-600 font-medium pl-10 leading-snug">{{ $comment->content }}</p>
                            </div>
                            @empty
                            <div class="text-center font-bold text-purple-300 py-2">
                                Belum ada komentar nih. 🎈
                            </div>
                            @endforelse
                        </div>

                    </div>
                </div>
                @endforeach
            </div>

            @if($posts->isEmpty())
            <div class="bg-white rounded-3xl border-4 border-purple-200 shadow-[8px_8px_0_0_#e9d5ff] p-12 text-center mt-8">
                <p class="text-xl text-purple-500 font-bold">Belum ada post di catatan global... Jadilah yang pertama! 🍭</p>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>
