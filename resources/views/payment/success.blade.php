<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="description"
          content="На этой странице вы можете поддержать онлайн конструктор ИУЛ для оформления информационно-удостоверяющего листа для государственной и негосударственной экспертизы Quartos.">

    <meta name="Keywords"
          content="конструктор иул, поддержать проект, информационно-удостоверяющий лист, создать иул, сервис иул, quatros">
    <meta name="robots" content="noindex, nofollow">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link rel="canonical" href="https://quatros.ru/payment/success">


    <title>{{ config('app.name', 'Спасибо за поддержку проекта Quatros!') }}</title>


    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <x-ya-metrika/>


</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">

<div class="text-black/80 dark:bg-black dark:text-white/50">

    <section id="hero" class="2xl:h-screen">

        <header>
            <nav x-data="{ open: false }">

                <!-- Primary Navigation Menu -->
                <div class="mx-auto max-w-7xl px-4 py-4 sm:px-6 lg:px-8">
                    <div class="flex h-16 items-center justify-between">

                        <!-- Logo -->
                        <x-mainpage.logo/>

                        <!-- Navigation Links -->


                        <!-- User menu -->
                        <x-mainpage.user-menu/>

                        <!-- Hamburger -->
                        <x-mainpage.hamburger/>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div class="p-4">
                    <x-mainpage.responsive-navigation/>
                </div>

            </nav>
        </header>

        <div class="mx-auto max-w-screen-lg px-4 sm:px-6 lg:px-8">
            <h1 class="flex flex-col text-center text-6xl 2xl:text-9xl font-extrabold mt-12 text-cyan-800">
                Спасибо!
            </h1>

            <!-- +++ -->
            <div class="mt-8 flex flex-col items-center justify-between gap-4">

                <h4 class="basis-1/4 text-center text-md text-slate-600">Мы хотим, чтобы <span
                        class="font-bold">Quatros</span> всегда оставался <span class="font-bold">бесплатным</span>.
                    Ваша поддержка помогает делать сервис ещё лучше, стабильнее и удобнее. Каждое пожертвование
                    мотивирует на новые функции и улучшения. Ваша поддержка — это прямой вклад в развитие инструмента,
                    которым вы пользуетесь. Еще раз, спасибо, что вы с нами!</h4>
                <br>
                <div class="flex flex-row gap-6">
                    <a href="/" class="font-medium text-sky-700 underline mb-12">На главную</a>
                    <a href="{{route('dashboard')}}" class="font-medium text-sky-700 underline mb-12">Личный кабинет</a>

                </div>

            </div>
        </div>


    </section>


    <footer
        class=" bg-slate-800 items-center py-16 text-center text-sm text-white dark:text-white/70">

        <div
            class="flex flex-col my-[2rem] px-4 sm:px-6 lg:px-8 justify-center items-center gap-2 md:flex-row md:gap-8">

            <a href="{{ route('home') }}" class="mb-2 flex flex-row items-center gap-1 text-2xl font-bold"
               title="На главную">
                <span>Quatros</span>
                <span class="text-sm text-sky-600">4</span>
            </a>
            <a href="/docs/intro/">Документация</a>
            <a href="/terms.pdf" target="_blank">Пользовательское соглашение</a>
            <a href="/policy.pdf" target="_blank">Политика конфиденциальности</a>
            <a class="flex flex-row items-center gap-2" href="mailto:support@quatros.ru">
                <svg
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                    class="size-5">
                    <path
                        d="M3 4a2 2 0 0 0-2 2v1.161l8.441 4.221a1.25 1.25 0 0 0 1.118 0L19 7.162V6a2 2 0 0 0-2-2H3Z"/>
                    <path
                        d="m19 8.839-7.77 3.885a2.75 2.75 0 0 1-2.46 0L1 8.839V14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V8.839Z"/>
                </svg>
                support@quatros.ru</a>
            <p>© 2025 Quatros</p>

        </div>
        <div
            class="flex flex-col my-[2rem] px-4 sm:px-6 lg:px-8 justify-center items-center gap-2 md:flex-row md:gap-2 text-slate-500">

            <p>ИНН 583601302278 | ОГРНИП 325580000040783</p>

        </div>
    </footer>
</div>

@stack('modals')

@livewireScripts



</body>

</html>

