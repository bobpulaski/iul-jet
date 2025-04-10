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
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">

<div class="text-black/80 dark:bg-black dark:text-white/50">

    <section id="hero" class="h-screen bg-gradient-to-r from-indigo-50 via-sky-50 to-red-50 border-t-2">

        <header>
            <nav x-data="{ open: false }">

                <!-- Primary Navigation Menu -->
                <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
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

        <div class="mx-auto mt-24 max-w-screen-lg px-4 sm:px-6 lg:px-8">
            <div>
                <h1 class="text-center text-5xl font-extrabold lg:text-7xl">Конструктор <span
                        class="rounded-lg bg-sky-600 p-4 text-white">ИУЛ</span><br>
                    <div class="mt-4 rounded-lg bg-slate-800 p-6 text-2xl text-white lg:text-3xl">для
                        проектно-сметной документации
                    </div>
                </h1>
                <div class="mt-8 flex flex-row items-center justify-between gap-8">
                    <h4 class="basis-2/3 text-start text-xl text-slate-600">Упростите создание
                        информационно-удостоверяющих листов с помощью удобного сервиса, в соответствии с
                        требованиями <span class="font-bold">ГОСТа Р 21.101-2020.</span></h4>
                    <a href="{{ route('register') }}"
                       class="flex flex-row justify-between items-center gap-2 rounded-md bg-pink-700 px-4 py-3 text-center font-semibold text-white transition duration-300 ease-in-out hover:bg-pink-600"><span>Начните
                        прямо сейчас</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/>
                        </svg>

                    </a>
                </div>

            </div>
        </div>
    </section>


    <!-- Формирование ИУЛ стало проще -->
    <x-mainpage.section>
        <x-mainpage.h2>
            Формирование ИУЛ стало проще
        </x-mainpage.h2>
        <x-mainpage.p-center>
            Сервис Quatros акцентирует внимание на содержимом
            информационно-удостоверяющих листов, а не на их оформлении.
        </x-mainpage.p-center>
        <x-mainpage.flex-row>
            <div class="flex basis-1/2 flex-col justify-center">
                <x-mainpage.h3>
                    Интуитивный интерфейс
                </x-mainpage.h3>
                <x-mainpage.p>
                    Порядок заполнения разделов для формирования ИУЛ соответствует
                    форме № 15 из приложения Х рекомендуемых правил ГОСТ Р
                    21.101-2020.
                </x-mainpage.p>
                <x-mainpage.p>
                    Настраиваемые опции позволяют учитывать требования к выходной
                    форме листа.
                </x-mainpage.p>
            </div>
            <div class="flex basis-1/2">
                <div class="relative">
                    <div
                        class="absolute inset-0 rotate-3 transform rounded-xl bg-gradient-to-r from-pink-600 to-sky-700">
                    </div>

                    <img class="relative z-10 rounded-xl border border-slate-200"
                         src="{{ asset('images/iul-interface.jpg') }}" alt="ИУЛ Интерфейс"/>
                </div>
            </div>
        </x-mainpage.flex-row>
    </x-mainpage.section>

    <x-mainpage.section>
        <x-mainpage.flex-row>
            <div class="flex basis-1/2">
                <div class="relative">
                    <div
                        class="absolute inset-0 rotate-3 transform rounded-xl bg-gradient-to-r from-pink-600 to-sky-700">
                    </div>

                    <img class="relative z-10 rounded-xl border border-slate-200"
                         src="{{ asset('images/iul-signs.jpg') }}"/>
                </div>
            </div>
            <div class="flex basis-1/2 flex-col justify-center">
                <x-mainpage.h3>
                    Удобно подписывать
                </x-mainpage.h3>
                <x-mainpage.p>
                    Добавляя строки с информацией о лицах, подписавших документ, не
                    нужно беспокоиться о том, что при формировании нового ИУЛ придется
                    заполнять этот раздел заново – просто включите опцию «Запомнить».
                </x-mainpage.p>
                <x-mainpage.p>
                    Если вы предпочитаете заполнять этот раздел от руки, достаточно
                    оставить поля пустыми.
                </x-mainpage.p>
            </div>
        </x-mainpage.flex-row>
    </x-mainpage.section>

    <x-mainpage.section>
        <x-mainpage.flex-row>
            <div class="flex basis-1/2 flex-col justify-center">
                <x-mainpage.h3>
                    Ничего не потеряется
                </x-mainpage.h3>
                <x-mainpage.p>
                    Вся работа по формированию информационно-удостоверяющих листов
                    сохраняется в разделе «История».
                </x-mainpage.p>
                <x-mainpage.p>
                    Вы всегда можете вернуться к нужному ИУЛ для внесения изменений
                    или для формировании нового на основе имеющегося.
                </x-mainpage.p>
            </div>
            <div class="flex basis-1/2">
                <div class="relative">
                    <div
                        class="absolute inset-0 rotate-3 transform rounded-xl bg-gradient-to-r from-pink-600 to-sky-700">
                    </div>

                    <img class="relative z-10 rounded-xl border border-slate-200"
                         src="{{ asset('images/iul-history.jpg') }}" alt="История ИУЛ"/>
                </div>
            </div>
        </x-mainpage.flex-row>
    </x-mainpage.section>

    <!-- Три алгоритма расчета контрольной суммы -->
    <x-mainpage.section>
        <x-mainpage.h2>
            Три алгоритма расчета контрольной суммы
        </x-mainpage.h2>
        <x-mainpage.p-center>
            Используйте любой алгоритм расчета по согласованию с принимающей
            стороной.
        </x-mainpage.p-center>
        <div class="flex flex-row justify-around">
            <x-mainpage.algorithm-circle>MD5</x-mainpage.algorithm-circle>
            <x-mainpage.algorithm-circle>CRC32</x-mainpage.algorithm-circle>
            <x-mainpage.algorithm-circle>SHA1</x-mainpage.algorithm-circle>
        </div>
    </x-mainpage.section>

    <!-- Быстрый и удобный -->
    <x-mainpage.section>
        <x-mainpage.h2>
            Быстрый, лёгкий и удобный
        </x-mainpage.h2>
        <x-mainpage.p-center>
            Исключите ошибки в оформлении и ускорьте процесс подачи документов в органы экспертизы.
        </x-mainpage.p-center>
        <x-mainpage.grid-3-col>
            <div>
                <div class="w-14 h-3 mb-8 bg-sky-700 rounded-md"></div>
                <x-mainpage.h4>
                    Гибкая и простая настройка
                </x-mainpage.h4>
                <x-mainpage.p>
                    Настройте форму ИУЛ под ваши требования: заголовок, подвал, тип и
                    начертания шрифта – всё сохраняется налету.
                </x-mainpage.p>
            </div>
            <div>
                <div class="w-14 h-3 mb-8 bg-sky-700 rounded-md"></div>
                <x-mainpage.h4>
                    Молниеносная загрузка файлов
                </x-mainpage.h4>
                <x-mainpage.p>
                    Анализ файлов проекта происходит практически мгновенно. Благодаря
                    оптимизированному коду алгоритмов обработки сервис не накладывает
                    никаких ограничений на размер загружаемого файла.
                </x-mainpage.p>
            </div>
            <div>
                <div class="w-14 h-3 mb-8 bg-sky-700 rounded-md"></div>
                <x-mainpage.h4>
                    История всегда под рукой
                </x-mainpage.h4>
                <x-mainpage.p>
                    Все сформированные информационно-удостоверяющие листы сохраняются
                    в истории. Вы всегда можете вернуться к любому из них
                    отредактировать или использовать в качестве шаблона.
                </x-mainpage.p>
            </div>
        </x-mainpage.grid-3-col>
    </x-mainpage.section>

    <!-- Сохраняйте в удобном для вас формате -->
    <x-mainpage.section>
        <x-mainpage.h2>
            Сохраняйте в удобном для вас формате
        </x-mainpage.h2>
        <x-mainpage.p-center>
            Поддержка нескольких типов файлов для выгрузки сформированного ИУЛ.
        </x-mainpage.p-center>
        <div class="flex flex-row justify-around">
            <x-mainpage.export-format class="bg-sky-800 saturate-75">*.DOCX</x-mainpage.export-format>
            <x-mainpage.export-format class="bg-rose-800 saturate-75">*.PDF</x-mainpage.export-format>
            <x-mainpage.export-format class="bg-indigo-800 saturate-75">*.HTML</x-mainpage.export-format>
        </div>
    </x-mainpage.section>


    <!-- Вопросы и ответы -->
    <x-mainpage.section>
        {{-- <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8"> --}}
        <x-mainpage.h2>
            Вопросы и ответы
        </x-mainpage.h2>

        <div x-data="{ openIndex: null }">
            <!-- Аккордеон секция 1 -->
            <div class="mb-0">
                <button @click="openIndex === 1 ? openIndex = null : openIndex = 1"
                        class="flex w-full items-center justify-between gap-3 rounded-t-xl border border-b-0 border-gray-200 p-5 font-medium text-gray-500 hover:bg-gray-100 focus:ring-1 focus:ring-gray-200 rtl:text-right dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-800 dark:focus:ring-gray-800">
                    <span class="font-semibold">Какие возможности и преимущества при использовании сервиса?</span>
                    <svg class="h-5 w-5 transform" :class="openIndex === 1 ? 'rotate-180' : 'rotate-0'"
                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="openIndex === 1"
                     class="border border-b-0 border-gray-200 p-5 dark:border-gray-700 dark:bg-gray-900">
                    <p>
                        Сокращение времени на подготовку и составление ИУЛ, исключение ошибок при оформлении
                        документов, обновление, корректировка данных, сохранение истории и многое другое!
                    </p>
                </div>
            </div>

            <!-- Аккордеон секция 2 -->
            <div class="mb-0">
                <button @click="openIndex === 2 ? openIndex = null : openIndex = 2"
                        class="flex w-full items-center justify-between gap-3 border border-b-0 border-gray-200 p-5 font-medium text-gray-500 hover:bg-gray-100 focus:ring-1 focus:ring-gray-200 rtl:text-right dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-800 dark:focus:ring-gray-800">
                    <span class="font-semibold">Как начать пользоваться конструктором?</span>
                    <svg class="h-5 w-5 transform" :class="openIndex === 2 ? 'rotate-180' : 'rotate-0'"
                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="openIndex === 2"
                     class="border border-b-0 border-gray-200 p-5 dark:border-gray-700 dark:bg-gray-900">
                    <p>
                        Чтобы начать пользоваться конструктором ИУЛ, вам необходимо
                        зарегистрироваться. После регистрации на указанный вами email
                        придёт письмо с подтверждением вашего электронного почтового
                        ящика. Подтвердив свою учетную запись, вам будет доступен весь
                        функционал сервиса.
                    </p>
                </div>
            </div>

            <!-- Аккордеон секция 3 -->
            <div class="mb-0">
                <button @click="openIndex === 3 ? openIndex = null : openIndex = 3"
                        class="flex w-full items-center justify-between gap-3 border border-b-0 border-gray-200 p-5 font-medium text-gray-500 hover:bg-gray-100 focus:ring-1 focus:ring-gray-200 rtl:text-right dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-800 dark:focus:ring-gray-800">
                    <span class="font-semibold">Должен ли я что-то устанавливать на свой компьютер?</span>
                    <svg class="h-5 w-5 transform" :class="openIndex === 3 ? 'rotate-180' : 'rotate-0'"
                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="openIndex === 3"
                     class="border border-b-0 border-gray-200 p-5 dark:border-gray-700 dark:bg-gray-900">
                    <p>
                        Конструктор ИУЛ работает через веб-браузер, как любое
                        SaaS-приложение. Это очень удобно, ведь вам не нужно
                        беспокоиться о скачивании и установке программ. Просто зайдите в
                        браузер, и вы готовы к работе из любой места, где есть интернет!
                    </p>
                </div>
            </div>

            <!-- Аккордеон секция 4 -->
            <div class="mb-0">
                <button @click="openIndex === 4 ? openIndex = null : openIndex = 4"
                        class="flex w-full items-center justify-between gap-3 border border-b-0 border-gray-200 p-5 font-medium text-gray-500 hover:bg-gray-100 focus:ring-1 focus:ring-gray-200 rtl:text-right dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-800 dark:focus:ring-gray-800">
                        <span class="font-semibold">Соответствует ли выходная форма ИУЛ требованиям действующего
                            законодательства?</span>
                    <svg class="h-5 w-5 transform" :class="openIndex === 4 ? 'rotate-180' : 'rotate-0'"
                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="openIndex === 4"
                     class="border border-b-0 border-gray-200 p-5 dark:border-gray-700 dark:bg-gray-900">
                    <p>
                        Да, соответствует. При формировании
                        информационно-удостоверяющего листа (ИУЛ) приняты положения
                        <i>ГОСТ Р 21.101-2020 «Система проектной документации для
                            строительства. Основные требования к проектной и рабочей
                            документации»</i>, действующего в настоящее время.
                    </p>
                </div>
            </div>

            <!-- Аккордеон секция 5 -->
            <div class="mb-0">
                <button @click="openIndex === 5 ? openIndex = null : openIndex = 5"
                        class="border-b-1 flex w-full items-center justify-between gap-3 border border-gray-200 p-5 font-medium text-gray-500 hover:bg-gray-100 focus:ring-1 focus:ring-gray-200 rtl:text-right dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-800 dark:focus:ring-gray-800">
                    <span class="font-semibold">Если у меня остались вопросы?</span>
                    <svg class="h-5 w-5 transform" :class="openIndex === 5 ? 'rotate-180' : 'rotate-0'"
                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="openIndex === 5"
                     class="border-b-1 border border-gray-200 p-5 dark:border-gray-700 dark:bg-gray-900">
                    <p>
                        Конечно, если у вас остались вопросы, вы всегда можете
                        обратиться за помощью! После регистрации вам будет доступен
                        раздел «Техподдержка», где вы сможете задать вопрос, указать на
                        ошибку или написать отзыв о работе конструктора. Мы всегда рады
                        помочь!
                    </p>
                </div>
            </div>
        </div>
    </x-mainpage.section>

    <x-mainpage.section>
        <x-mainpage.h2 class="bg-gradient-to-r from-pink-700 via-indigo-500 to-sky-800 text-transparent bg-clip-text">
            Начните прямо сейчас!
        </x-mainpage.h2>
        <x-mainpage.p-center>
            <a href="/login" class="font-medium text-sky-700 underline">Войдите</a>
            или
            <a href="/register" class="font-medium text-sky-700 underline">зарегистрируйтесь</a>.
        </x-mainpage.p-center>
    </x-mainpage.section>


    <div class="flex flex-col items-center justify-center bg-slate-800">
        <div class="relative w-full max-w-2xl lg:max-w-6xl">
            <footer
                class="flex flex-row justify-between py-16 text-center align-middle text-sm text-white dark:text-white/70">
                <div>
                    <a href="{{ route('home') }}" class="flex flex-row items-center gap-1 text-2xl font-bold"
                       title="На главную">
                        <span>Quatros</span>
                        <span class="text-sm text-sky-600">4</span>
                    </a>
                </div>
                <p>© 2025 Quatros</p>
                <a href="mailto:smeta@ces.nnov.ru">support@quatros.ru</a>
            </footer>
        </div>
    </div>

</div>

@stack('modals')

@livewireScripts
</body>

</html>
