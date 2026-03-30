<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TaskCake - Atur Hidupmu Sepemanis Kue!</title>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🧁</text></svg>">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-gray-900 min-h-screen selection:bg-pink-300 selection:text-pink-900 overflow-x-hidden">

    <!-- Custom Cursor -->
    <div id="custom-cursor" class="fixed top-0 left-0 w-6 h-6 bg-pink-500 rounded-full mix-blend-multiply pointer-events-none z-[9999] opacity-70 transform -translate-x-1/2 -translate-y-1/2 will-change-transform hidden md:block"></div>
    <div id="custom-cursor-follower" class="fixed top-0 left-0 w-12 h-12 border-2 border-indigo-500 rounded-full pointer-events-none z-[9998] opacity-50 transform -translate-x-1/2 -translate-y-1/2 will-change-transform hidden md:block"></div>

    <!-- Interactive Particle Background -->
    <canvas id="particle-canvas" class="fixed top-0 left-0 w-full h-full bg-gradient-to-br from-pink-50 via-purple-50 to-blue-50 -z-50 pointer-events-none"></canvas>

    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex justify-between items-center relative z-10">
        <div class="text-3xl font-black flex items-center gap-2 transform transition hover:scale-105">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-pink-500 via-purple-500 to-indigo-500">TaskCake</span>
            <span>🧁</span>
        </div>

        @if (Route::has('login'))
        <div class="flex gap-4">
            @auth
            <a href="{{ url('/dashboard') }}" class="px-6 py-3 bg-pink-500 text-white rounded-2xl hover:bg-pink-400 font-black shadow-[0_4px_0_0_#db2777] active:shadow-none active:translate-y-1 transition-all">
                🚀 Ke Dashboard
            </a>
            @else
            <a href="{{ route('login') }}" class="px-6 py-3 bg-white border-4 border-purple-200 text-purple-600 rounded-2xl hover:bg-purple-50 hover:border-purple-300 font-bold shadow-[4px_4px_0_0_#e9d5ff] active:shadow-none active:translate-y-1 transition-all hidden sm:block">
                👋 Masuk
            </a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="px-6 py-4 bg-purple-500 text-white rounded-2xl hover:bg-purple-400 font-black shadow-[0_4px_0_0_#9333ea] active:shadow-none active:translate-y-1 transition-all">
                ✨ Daftar Gratis!
            </a>
            @endif
            @endauth
        </div>
        @endif
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-20 pb-16 text-center relative z-10">
        <h1 class="text-5xl md:text-7xl font-black mb-6 leading-tight overflow-hidden">
            <span class="gsap-hero-line inline-block transform translate-y-full opacity-0">Atur Jadwal & Catatan,</span><br>
            <span class="gsap-hero-line inline-block transform translate-y-full opacity-0 mt-2">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-pink-500 to-indigo-500">Sepemanis Makan Kue! </span><span class="gsap-cake-emoji inline-block">🍰</span>
            </span>
        </h1>
        <p class="gsap-hero-fade text-xl md:text-2xl text-gray-600 font-medium mb-12 max-w-2xl mx-auto opacity-0 translate-y-10">
            TaskCake membantumu menyusun misi harian dan mencatat ide gila tanpa rasa bosan. Produktif itu harus menyenangkan!
        </p>

        <div class="gsap-hero-fade flex flex-col sm:flex-row justify-center gap-6 opacity-0 translate-y-10">
            @auth
            <a href="{{ url('/dashboard') }}" class="px-8 py-4 bg-pink-500 text-white text-xl rounded-2xl hover:bg-pink-400 font-black shadow-[0_6px_0_0_#db2777] active:shadow-none active:translate-y-2 transition-all">
                Lanjut Main! 🎮
            </a>
            @else
            <a href="{{ route('register') }}" class="px-8 py-4 bg-pink-500 text-white text-xl rounded-2xl hover:bg-pink-400 font-black shadow-[0_6px_0_0_#db2777] active:shadow-none active:translate-y-2 transition-all">
                Mulai Bikin Kue Pertamamu! 👩‍🍳
            </a>
            @endauth
        </div>
    </main>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 relative z-10 overflow-visible">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Card 1 Wrapper -->
            <div class="gsap-draggable-card cursor-grab active:cursor-grabbing transform">
                <div class="gsap-floating-card bg-white rounded-3xl border-4 border-yellow-200 shadow-[8px_8px_0_0_#fef08a] p-8 text-center">
                    <div class="text-6xl mb-4 pointer-events-none">📝</div>
                    <h3 class="text-2xl font-black text-yellow-600 mb-3 pointer-events-none">Catat Apapun</h3>
                    <p class="text-gray-600 font-medium pointer-events-none">Dari resep masakan, list belanja, sampai mimpi aneh semalam. Simpan semuanya di rak buku ajaibmu!</p>
                </div>
            </div>

            <!-- Card 2 Wrapper -->
            <div class="gsap-draggable-card cursor-grab active:cursor-grabbing transform md:-mt-8">
                <div class="gsap-floating-card bg-white rounded-3xl border-4 border-indigo-200 shadow-[8px_8px_0_0_#c7d2fe] p-8 text-center">
                    <div class="text-6xl mb-4 pointer-events-none">🚀</div>
                    <h3 class="text-2xl font-black text-indigo-600 mb-3 pointer-events-none">Misi & Jadwal</h3>
                    <p class="text-gray-600 font-medium pointer-events-none">Jangan sampai kelewatan mabar atau piknik. Buat jadwal tebal yang gak akan pernah kamu lupakan.</p>
                </div>
            </div>

            <!-- Card 3 Wrapper -->
            <div class="gsap-draggable-card cursor-grab active:cursor-grabbing transform">
                <div class="gsap-floating-card bg-white rounded-3xl border-4 border-pink-200 shadow-[8px_8px_0_0_#fbcfe8] p-8 text-center">
                    <div class="text-6xl mb-4 pointer-events-none">🎨</div>
                    <h3 class="text-2xl font-black text-pink-600 mb-3 pointer-events-none">Anti Bosan</h3>
                    <p class="text-gray-600 font-medium pointer-events-none">Warna-warni, border tebal, dan penuh emoji. Siapa bilang aplikasi produktivitas harus kaku seperti kanebo kering?</p>
                </div>
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 relative z-10">
        <div class="text-center mb-12">
            <h3 class="text-3xl font-black text-gray-800 mb-2">TECH STACK</h3>
        </div>

        <div class="flex flex-wrap justify-center gap-6 md:gap-10">
            <div class="group flex flex-col items-center">
                <div class="w-20 h-20 bg-white rounded-2xl border-4 border-red-100 shadow-[4px_4px_0_0_#fee2e2] flex items-center justify-center p-4 group-hover:-translate-y-2 transition-all">
                    <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/laravel/laravel-original.svg" alt="Laravel" class="w-full h-full">
                </div>
                <span class="mt-3 font-black text-gray-700">Laravel 11</span>
            </div>

            <div class="group flex flex-col items-center">
                <div class="w-20 h-20 bg-white rounded-2xl border-4 border-cyan-100 shadow-[4px_4px_0_0_#cffafe] flex items-center justify-center p-4 group-hover:-translate-y-2 transition-all">
                    <img src="https://www.vectorlogo.zone/logos/tailwindcss/tailwindcss-icon.svg" alt="Tailwind CSS" class="w-full h-full">
                </div>
                <span class="mt-3 font-black text-gray-700">Tailwind CSS</span>
            </div>

            <div class="group flex flex-col items-center">
                <div class="w-20 h-20 bg-white rounded-2xl border-4 border-blue-100 shadow-[4px_4px_0_0_#dbeafe] flex items-center justify-center p-4 group-hover:-translate-y-2 transition-all">
                    <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/alpinejs/alpinejs-original.svg" alt="Alpine.js" class="w-full h-full">
                </div>
                <span class="mt-3 font-black text-gray-700">Alpine.js</span>
            </div>

            <div class="group flex flex-col items-center">
                <div class="w-20 h-20 bg-white rounded-2xl border-4 border-indigo-100 shadow-[4px_4px_0_0_#e0e7ff] flex items-center justify-center p-4 group-hover:-translate-y-2 transition-all">
                    <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/mysql/mysql-original-wordmark.svg" alt="MySQL" class="w-full h-full">
                </div>
                <span class="mt-3 font-black text-gray-700">MySQL</span>
            </div>

            <div class="group flex flex-col items-center">
                <div class="w-20 h-20 bg-white rounded-2xl border-4 border-purple-100 shadow-[4px_4px_0_0_#f3e8ff] flex items-center justify-center p-4 group-hover:-translate-y-2 transition-all">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/f/f1/Vitejs-logo.svg" alt="Vite" class="w-full h-full">
                </div>
                <span class="mt-3 font-black text-gray-700">Vite</span>
            </div>
            
            <div class="group flex flex-col items-center">
                <div class="w-20 h-20 bg-white rounded-2xl border-4 border-green-100 shadow-[4px_4px_0_0_#dcfce7] flex items-center justify-center p-4 group-hover:-translate-y-2 transition-all">
                    <img src="https://cdn.worldvectorlogo.com/logos/gsap-greensock.svg" alt="GSAP" class="w-full h-full">
                </div>
                <span class="mt-3 font-black text-gray-700">GSAP</span>
            </div>

            <div class="group flex flex-col items-center">
                <div class="w-20 h-20 bg-gradient-to-br from-blue-100 via-indigo-100 to-purple-100 rounded-2xl border-4 border-blue-200 shadow-[4px_4px_0_0_#c7d2fe] flex items-center justify-center p-4 group-hover:-translate-y-2 transition-all group-hover:scale-110">
                    <img src="https://www.gstatic.com/images/branding/product/2x/gemini_32dp.png" alt="Gemini AI" class="w-10 h-10 group-hover:animate-pulse">
                </div>
                <span class="mt-3 font-black text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600">Gemini AI</span>
                <span class="text-xs font-bold text-gray-400">Agentic Pair Programmer</span>
            </div>
        </div>

    </section>

    <footer class="text-center py-10 text-gray-500 font-bold relative z-10">
        &copy; {{ date('Y') }} TaskCake. <br>
        another project gabut by <a href="http://github.com/dhodhoo" target="_blank" rel="noopener noreferrer">@dhodho</a>
    </footer>

</body>

</html>