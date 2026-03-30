<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TaskCake') }} 🧁</title>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🧁</text></svg>">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-gray-900 selection:bg-pink-300 selection:text-pink-900 overflow-x-hidden">

    <!-- Custom Cursor -->
    <div id="custom-cursor" class="fixed top-0 left-0 w-6 h-6 bg-pink-500 rounded-full mix-blend-multiply pointer-events-none z-[9999] opacity-70 transform -translate-x-1/2 -translate-y-1/2 will-change-transform hidden md:block"></div>
    <div id="custom-cursor-follower" class="fixed top-0 left-0 w-12 h-12 border-2 border-indigo-500 rounded-full pointer-events-none z-[9998] opacity-50 transform -translate-x-1/2 -translate-y-1/2 will-change-transform hidden md:block"></div>

    <!-- Interactive Particle Background -->
    <canvas id="particle-canvas" class="fixed top-0 left-0 w-full h-full bg-gradient-to-br from-pink-50 via-purple-50 to-blue-50 -z-50 pointer-events-none"></canvas>

    <div class="min-h-screen relative z-0">

        @include('layouts.navigation')

        @if (isset($header))
        <header class="max-w-7xl mx-auto pt-8 px-4 sm:px-6 lg:px-8">
            <div class="bg-white/70 backdrop-blur-xl border-4 border-white shadow-[8px_8px_0_0_rgba(255,255,255,0.8)] rounded-[2rem] p-6 relative overflow-hidden transform transition hover:scale-[1.01]">

                <div class="gsap-floating-element absolute top-3 right-12 w-3 h-8 bg-pink-300 rounded-full rotate-45 opacity-60"></div>
                <div class="gsap-floating-element absolute bottom-4 right-24 w-4 h-4 bg-yellow-300 rounded-full opacity-60"></div>
                <div class="gsap-floating-element absolute top-6 left-1/4 w-3 h-8 bg-indigo-300 rounded-full -rotate-12 opacity-60"></div>
                <div class="gsap-floating-element absolute bottom-2 left-1/3 w-5 h-5 bg-purple-300 rounded-full opacity-40"></div>

                <div class="relative z-10">
                    {{ $header }}
                </div>
            </div>
        </header>
        @endif

        <main class="pb-12">
            {{ $slot }}
        </main>

    </div>
</body>

</html>