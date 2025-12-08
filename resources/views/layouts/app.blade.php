<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'WEMS') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <style>
        @keyframes slide-in {
            0% {
                opacity: 0;
                transform: translateX(40px);
            }

            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .animate-slide-in {
            animation: slide-in 0.3s ease-out;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        @if (session('success'))
            <div id="alert-success"
                class="fixed top-5 right-5 z-50 bg-green-600 text-white px-4 py-3 rounded-lg shadow-lg flex items-center gap-2 animate-slide-in">
                <span>{{ session('success') }}</span>
                <button onclick="this.parentElement.remove()" class="text-white font-bold">&times;</button>
            </div>

            <script>
                setTimeout(() => {
                    let el = document.getElementById('alert-success');
                    if (el) el.remove();
                }, 3000); // 3 seconds
            </script>
        @endif

        @if (session('error'))
            <div id="alert-error"
                class="fixed top-5 right-5 z-50 bg-red-600 text-white px-4 py-3 rounded-lg shadow-lg flex items-center gap-2 animate-slide-in">
                <span>{{ session('error') }}</span>
                <button onclick="this.parentElement.remove()" class="text-white font-bold">&times;</button>
            </div>

            <script>
                setTimeout(() => {
                    let el = document.getElementById('alert-error');
                    if (el) el.remove();
                }, 3000); // 3 seconds
            </script>
        @endif



        <!-- Page Content -->
        <main>
            {{-- {{ $slot }} --}}
            {{-- @yield('content') --}}
        </main>
    </div>
</body>

</html>
