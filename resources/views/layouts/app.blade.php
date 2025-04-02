<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('icons8-4-48.png') }}" type="image/x-icon">


    <title>{{ config('app.name', 'Quatros') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    {{-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet"> --}}

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- load all algortihms into the global `hashwasm` variable -->
    <script src="https://cdn.jsdelivr.net/npm/hash-wasm@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/hash-wasm@4/dist/md5.umd.min.js"></script>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    @endif

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <x-banner />

    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @livewire('navigation-menu')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow dark:bg-gray-800">
                <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    @stack('modals')

    @livewireScripts



    {{-- <script>
        document.addEventListener('DOMContentLoaded', () => {
            const themeToggleButton = document.getElementById('theme-toggle');

            // Установка темы при загрузке страницы
            const currentTheme = localStorage.getItem('theme') || 'light';
            if (currentTheme === 'dark') {
                document.documentElement.classList.add('dark');
            }

            // Обработчик события для переключателя
            themeToggleButton.addEventListener('click', () => {
                document.documentElement.classList.toggle('dark');

                // Сохранение текущей темы в localStorage
                if (document.documentElement.classList.contains('dark')) {
                    localStorage.setItem('theme', 'dark');
                } else {
                    localStorage.setItem('theme', 'light');
                }
            });
        });
    </script> --}}

</body>

</html>
