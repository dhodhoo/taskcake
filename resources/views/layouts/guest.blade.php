<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TaskCake') }} 🧁 - Masuk / Daftar</title>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🧁</text></svg>">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased bg-gradient-to-br from-pink-50 via-purple-50 to-blue-50 min-h-screen selection:bg-pink-300 selection:text-pink-900">

    <div class="fixed top-0 left-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
        <div class="absolute top-10 left-10 w-40 h-40 bg-pink-200 rounded-full mix-blend-multiply filter blur-2xl opacity-60"></div>
        <div class="absolute bottom-10 right-10 w-40 h-40 bg-indigo-200 rounded-full mix-blend-multiply filter blur-2xl opacity-60"></div>
    </div>

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-10 sm:pt-0 px-4">

        <div class="mb-8 transform transition hover:scale-105 hover:-translate-y-1">
            <a href="/" class="text-5xl font-black flex items-center gap-2">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-pink-500 via-purple-500 to-indigo-500">TaskCake</span>
                <span>🧁</span>
            </a>
        </div>

        <div class="w-full sm:max-w-md px-8 py-10 bg-white rounded-3xl border-4 border-purple-200 shadow-[8px_8px_0_0_#e9d5ff] relative overflow-hidden">
            <div class="absolute top-0 right-0 w-24 h-24 bg-pink-100 rounded-bl-full opacity-50"></div>

            <div class="relative z-10">
                {{ $slot }}
            </div>
        </div>

    </div>
</body>

</html>