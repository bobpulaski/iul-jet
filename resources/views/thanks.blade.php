<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="description"
          content="На этой странице вы можете поддержать онлайн конструктор ИУЛ для оформления информационно-удостоверяющего листа для государственной и негосударственной экспертизы Quartos.">

    <meta name="keywords"
          content="конструктор иул, поддержать проект, информационно-удостоверяющий лист, создать иул, сервис иул, quatros">
    <meta name="robots" content="all"/>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link rel="canonical" href="https://quatros.ru/thanks">


    <title>Поддержать проект конструктора ИУЛ Quatros</title>


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

    <section id="hero" class="2xl:h-screen mb-4">

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
            <h1 class="flex flex-col text-center text-2xl font-extrabold">
                    <span class="flex flex-col items-center justify-center gap-2 md:flex-row">
                        <span class="md:text-5xl mt-4 rounded-lg bg-sky-600 p-6 text-white">Поддержите развитие проекта</span></span>
            </h1>

            <!-- +++ -->
            <div class="mt-8 flex flex-col items-center justify-between gap-8">

                <h4 class="basis-1/4 text-center text-md text-slate-600">Мы хотим, чтобы <span class="font-bold">Quatros</span> всегда оставался <span class="font-bold">бесплатным</span>. Ваша поддержка помогает делать сервис ещё лучше, стабильнее и удобнее. Каждое пожертвование мотивирует на новые функции и улучшения — это прямой вклад в развитие инструмента, которым вы пользуетесь. Спасибо, что вы с нами!</h4>

            </div>
        </div>


        @livewire('thanks-component')

    </section>

    <section class="text-gray-600 body-font bg-slate-100">
        <div class="container px-5 py-24 mx-auto">
            <div class="xl:w-1/2 lg:w-3/4 w-full mx-auto text-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="inline-block w-8 h-8 text-gray-400 mb-8" viewBox="0 0 975.036 975.036">
                    <path d="M925.036 57.197h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.399 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l36 76c11.6 24.399 40.3 35.1 65.1 24.399 66.2-28.6 122.101-64.8 167.7-108.8 55.601-53.7 93.7-114.3 114.3-181.9 20.601-67.6 30.9-159.8 30.9-276.8v-239c0-27.599-22.401-50-50-50zM106.036 913.497c65.4-28.5 121-64.699 166.9-108.6 56.1-53.7 94.4-114.1 115-181.2 20.6-67.1 30.899-159.6 30.899-277.5v-239c0-27.6-22.399-50-50-50h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.4 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l35.9 75.8c11.601 24.399 40.501 35.2 65.301 24.399z"></path>
                </svg>
                <p class="leading-relaxed text-lg">Ваша поддержка — это инвестиция в будущее проекта. Она позволяет планировать развитие, добавлять функции, о которых вы меня просите, и становиться лучше. Огромное спасибо за ваш вклад. Это многое значит!</p>
                <span class="inline-block h-1 w-10 rounded bg-indigo-500 mt-8 mb-6"></span>
                <h2 class="text-gray-900 font-medium title-font tracking-wider text-sm">КИРИЛЛ ШОШИН</h2>
                <p class="text-gray-500">Разработчик Quatros</p>
            </div>
        </div>
    </section>





    <footer
        class=" bg-slate-800 items-center py-16 text-center text-sm text-white dark:text-white/70">

        <div class="flex flex-col my-[2rem] px-4 sm:px-6 lg:px-8 justify-center items-center gap-2 md:flex-row md:gap-8">

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
        <div class="flex flex-col my-[2rem] px-4 sm:px-6 lg:px-8 justify-center items-center gap-2 md:flex-row md:gap-2 text-slate-500">

            <p>ИНН 583601302278 | ОГРНИП 325580000040783</p>

        </div>
    </footer>
</div>

@stack('modals')

@livewireScripts



</body>

</html>

