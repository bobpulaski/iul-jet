<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="description"
        content="Онлайн конструктор ИУЛ для оформления информационно-удостоверяющего листа для государственной и негосударственной экспертизы. Сформируйте и скачайте информационно-удостоверяющий лист с любого устройства на сайте Quartos.">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <title>{{ config('app.name', 'Laravel') }}</title> -->
    <title>Конструктор ИУЛ проектной документации для экспертизы</title>


    <!-- Fonts -->
    <!-- <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    @endif
</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">

    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <div class="flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
            <div class="relative w-full max-w-2xl lg:max-w-6xl">
                <header>
                    <nav x-data="{ open: false }"
                        class="{{-- border-b border-gray-100 bg-white dark:border-gray-700 dark:bg-gray-800 --}}">
                        <!-- Primary Navigation Menu -->
                        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                            <div class="flex h-16 justify-between items-center">
                                <div class="flex">

                                    <!-- Logo -->
                                    <x-mainpage.logo />

                                    <!-- Navigation Links -->

                                </div>

                                <!-- User menu -->
                                <x-mainpage.user-menu />

                                <!-- Hamburger -->
                                <x-mainpage.hamburger />
                            </div>
                        </div>

                        <!-- Responsive Navigation Menu -->
                        <x-mainpage.responsive-navigation />

                    </nav>
                </header>




                <main class="mt-6">
                    <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                        <h1 class="text-4xl">Конструктор ИУЛ для проектно-сметной документации</h1>
                        <ol>
                            <li>Поддерживаемые форматы</li>
                            <li>Поддерживаемые версии браузеров (десктоп и мобильный)</li>
                            <li>ГОСТ Р 21.101-2020 Система проектной документации для строительства. Основные требования
                                к
                                проектной и рабочей документации</li>
                            <li>УЛ рекомендуется выполнять в соответствии с формой 15 на листах формата A4, A5 по ГОСТ
                                2.301.68 «Единая система конструкторской документации»</li>
                            <li>Скорость загрузки фалов</li>
                            <li>Неограниченный размер входного файла (ограничения накладываются вашим железом)</li>
                            <li>Несколько алгоритмов расчета контрольных сумм</li>
                            <li>Гибкая настройка формы листа</li>
                        </ol>
                    </div>
                </main>

                <footer class="py-16 text-center text-sm text-black dark:text-white/70">
                    {{-- Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }}) --}}
                    © 2025 Quatros
                </footer>
            </div>
        </div>
    </div>

    @stack('modals')

    @livewireScripts
</body>

</html>