<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="description"
        content="Онлайн конструктор ИУЛ для оформления информационно-удостоверяющего листа для государственной и негосударственной экспертизы. Сформируйте и скачайте информационно-удостоверяющий лист с любого устройства на сайте Quartos.">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="{{ asset('icons8-4-32(2).png') }}" type="image/x-icon">


    <!-- <title>{{ config('app.name', 'Laravel') }}</title> -->
    <title>Конструктор ИУЛ проектной документации для экспертизы</title>


    <!-- Fonts -->
    <!-- <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- <script src="https://cdn.tailwindcss.com/"></script> --}}
</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">

    <div class="text-black/80 dark:bg-black dark:text-white/50">


        <section id="hero" class="">

            <header>
                <nav x-data="{ open: false }">

                    <!-- Primary Navigation Menu -->
                    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                        <div class="flex h-16 items-center justify-between">

                            <!-- Logo -->
                            <x-mainpage.logo />

                            <!-- Navigation Links -->


                            <!-- User menu -->
                            <x-mainpage.user-menu />

                            <!-- Hamburger -->
                            <x-mainpage.hamburger />
                        </div>
                    </div>

                    <!-- Responsive Navigation Menu -->
                    <div class="p-4">
                        <x-mainpage.responsive-navigation />
                    </div>

                </nav>
            </header>

            <div class="mx-auto mt-12 max-w-screen-lg px-4 sm:px-6 lg:px-8 h-screen">
                <div>
                    <h1 class="text-center text-5xl font-extrabold lg:text-7xl">Конструктор <span
                            class="rounded-lg bg-sky-500 p-4 text-white">ИУЛ</span><br>
                        <div class="mt-4 rounded-lg bg-slate-800 p-6 text-2xl text-white lg:text-3xl">для
                            проектно-сметной документации</div>
                    </h1>
                    <div class="mt-8 flex flex-row items-center justify-between gap-8">
                        <h2 class="basis-2/3 text-start text-xl text-slate-600">Упростите создание
                            информационно-удостоверяющих листов с помощью удобного сервиса, в соответствии с
                            требованиями <span class="font-bold">ГОСТа Р 21.101-2020.</span></h2>
                        <a href="{{ route('register') }}"
                            class="justify-center rounded-md bg-sky-500 px-4 py-3 text-center font-semibold text-white transition duration-300 ease-in-out hover:bg-sky-600">Начните
                            прямо сейчас →</a>
                    </div>

                </div>
            </div>
        </section>

        {{-- <section>
            <div class="mx-auto mt-12 max-w-7xl px-4 sm:px-6 lg:px-8">
                <h3 class="text-center text-4xl font-bold lg:text-5xl">Гибкий, быстрый и удобный</h3>
                <div class="mt-12 grid grid-cols-1 gap-8 lg:grid-cols-3">
                    <div class="rounded-lg border border-sky-500 p-4">
                        <h3 class="mb-4 text-xl font-semibold dark:text-slate-200">Простая настройка формы</h3>
                        Настройте форму ИУЛ под ваши требования: заголовок, подвал, тип и начертания шрифта - всё
                        сохраняется на-лету.
                    </div>
                    <div class="rounded-lg border border-sky-500 p-4">
                        <h3 class="mb-4 text-xl font-semibold dark:text-slate-200">Молниеносная загрузка файлов</h3>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure nisi et doloribus earum recusandae
                        modi corrupti optio porro, odio dolores minima amet numquam velit explicabo, fuga cum architecto
                        sapiente aperiam.
                    </div>
                    <div class="rounded-lg border border-sky-500 p-4">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt placeat minus, consequatur
                        quisquam impedit natus eaque sit quam nulla? Aliquid sint obcaecati ducimus alias laudantium
                        ullam. Maxime recusandae beatae eaque?
                    </div>
                </div>
            </div>
        </section> --}}




        <div class="flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
            <div class="relative w-full max-w-2xl lg:max-w-6xl">








                {{-- <main class="mt-6">
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
                </main> --}}

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
