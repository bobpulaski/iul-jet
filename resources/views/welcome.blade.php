<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="description"
        content="Онлайн конструктор ИУЛ для оформления информационно-удостоверяющего листа для государственной и негосударственной экспертизы. Сформируйте и скачайте информационно-удостоверяющий лист с любого устройства на сайте Quartos.">

    <meta name="Keywords" content="конструктор иул, информационно-удостоверяющий лист, создать иул,  сервис иул, quatros">
    <meta name="robots" content="all" />

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link rel="canonical" href="https://quatros.ru/">


    <title>{{ config('app.name', 'Конструктор ИУЛ проектной документации для экспертизы') }}</title>
    {{-- <title>Конструктор ИУЛ проектной документации для экспертизы</title> --}}


    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <x-ya-metrika />


</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">

    <div class="text-black/80 dark:bg-black dark:text-white/50">

        <section id="hero" class="h-screen bg-gradient-to-r from-indigo-50 via-sky-50 to-red-50">

            <header>
                <nav x-data="{ open: false }">

                    <!-- Primary Navigation Menu -->
                    <div class="mx-auto max-w-7xl px-4 py-4 sm:px-6 lg:px-8">
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

            <div class="mx-auto mt-20 max-w-screen-lg px-4 sm:px-6 lg:px-8">
                <h1 class="flex flex-col text-center text-5xl font-extrabold">
                    <span class="flex flex-col items-center justify-center gap-2 md:flex-row">
                        <span class="md:text-7xl">Конструктор</span>
                        <span class="mt-4 rounded-lg bg-sky-600 p-4 text-white md:text-7xl">ИУЛ</span>
                    </span>
                    <span class="mt-4 rounded-lg bg-slate-800 p-6 text-2xl text-white lg:text-3xl">для
                        проектно-сметной документации
                    </span>
                </h1>

                <!-- +++ -->
                <div class="mt-8 flex flex-col items-center justify-between gap-8">

                    Упростите создание
                    информационно-удостоверяющих листов с помощью удобного сервиса, в соответствии с
                    требованиями <span class="font-bold basis-2/3 text-center text-xl text-slate-600">ГОСТа Р
                        21.101-2020.</span>

                    <a href="{{ route('register') }}"
                        class="flex flex-row items-center justify-between gap-2 rounded-md bg-pink-700 px-4 py-3 text-center font-semibold text-white transition duration-300 ease-in-out hover:bg-pink-600 pulsing-div"><span>Начните
                            прямо сейчас</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                        </svg>
                    </a>

                    <div class="flex flex-col items-center mt-32">
                        <div class="flex items-baseline space-x-1 pt-5 sm:ps-5 sm:pt-0">
                            <div class="flex space-x-1"> <!-- Your star ratings -->

                                <x-ui.icons.star-icon />
                                <x-ui.icons.star-icon />
                                <x-ui.icons.star-icon />
                                <x-ui.icons.star-icon />
                                <!-- Adding additional half-star --> <svg
                                    class="h-4 w-4 text-yellow-500 dark:text-yellow-400" width="51" height="51"
                                    viewBox="0 0 51 51" fill="none">
                                    <path
                                        d="M49.6867 20.0305C50.2889 19.3946 49.9878 18.1228 49.0846 18.1228L33.7306 15.8972C33.4296 15.8972 33.1285 15.8972 32.8275 15.2613L25.9032 0.317944C25.6021 0 25.3011 0 25 0V42.6046C25 42.6046 25.3011 42.6046 25.6021 42.6046L39.7518 49.9173C40.3539 50.2352 41.5581 49.5994 41.2571 48.6455L38.5476 32.4303C38.5476 32.1124 38.5476 31.7944 38.8486 31.4765L49.6867 20.0305Z"
                                        fill="transparent"></path>
                                    <path
                                        d="M0.313299 20.0305C-0.288914 19.3946 0.0122427 18.1228 0.915411 18.1228L16.2694 15.8972C16.5704 15.8972 16.8715 15.8972 17.1725 15.2613L24.0968 0.317944C24.3979 0 24.6989 0 25 0V42.6046C25 42.6046 24.6989 42.6046 24.3979 42.6046L10.2482 49.9173C9.64609 50.2352 8.44187 49.5994 8.74292 48.6455L11.4524 32.4303C11.4524 32.1124 11.4524 31.7944 11.1514 31.4765L0.313299 20.0305Z"
                                        fill="currentColor"></path>
                                </svg>
                            </div>
                            <p class="text-neutral-400 dark:text-neutral-200"> <span class="font-bold">4.9</span> / 5
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </section>


        <x-mainpage.section>
            <x-mainpage.h2>
                Формирование ИУЛ стало проще
            </x-mainpage.h2>
            <x-mainpage.p-center>
                Сервис Quatros акцентирует внимание на содержимом
                информационно-удостоверяющих листов, а не на их оформлении.
            </x-mainpage.p-center>
            <div class="flex flex-col gap-24 p-4 md:flex-row">
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
                            src="{{ asset('images/iul-interface.jpg') }}" alt="ИУЛ Интерфейс" title="Интерфейс ИУЛ" />
                    </div>
                </div>
            </div>
        </x-mainpage.section>

        <x-mainpage.section>
            <div class="flex flex-col-reverse gap-24 p-4 md:flex-row">
                <div class="flex basis-1/2">
                    <div class="relative">
                        <div
                            class="absolute inset-0 rotate-3 transform rounded-xl bg-gradient-to-r from-pink-600 to-sky-700">
                        </div>

                        <img class="relative z-10 rounded-xl border border-slate-200"
                            src="{{ asset('images/iul-signs.jpg') }}" alt="Подписи ИУЛ" title="Подписи ИУЛ" />
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
            </div>
        </x-mainpage.section>

        <x-mainpage.section>
            <div class="flex flex-col gap-24 p-4 md:flex-row">
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
                            src="{{ asset('images/iul-history.jpg') }}" alt="История ИУЛ" title="История ИУЛ" />
                    </div>
                </div>
            </div>
        </x-mainpage.section>

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

        <x-mainpage.section>
            <x-mainpage.h2>
                Быстрый, лёгкий и удобный
            </x-mainpage.h2>
            <x-mainpage.p-center>
                Исключите ошибки в оформлении и ускорьте процесс подачи документов в органы экспертизы.
            </x-mainpage.p-center>
        </x-mainpage.section>


        <x-mainpage.section>

            <x-mainpage.grid-3-col>
                <div>
                    <div class="mb-8 h-3 w-14 rounded-md bg-sky-700"></div>
                    <x-mainpage.h4>
                        Гибкая и простая настройка
                    </x-mainpage.h4>
                    <x-mainpage.p>
                        Настройте форму ИУЛ под ваши требования: заголовок, подвал, тип и
                        начертания шрифта – всё сохраняется на лету.
                    </x-mainpage.p>
                </div>
                <div>
                    <div class="mb-8 h-3 w-14 rounded-md bg-sky-700"></div>
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
                    <div class="mb-8 h-3 w-14 rounded-md bg-sky-700"></div>
                    <x-mainpage.h4 class="text-sm">
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

        <x-mainpage.section>
            <x-mainpage.h2>
                Сохраняйте в удобном для вас формате
            </x-mainpage.h2>
            <x-mainpage.p-center>
                Поддержка нескольких типов файлов для выгрузки сформированного ИУЛ.
            </x-mainpage.p-center>
            <div class="flex flex-row justify-around">
                <x-mainpage.export-format class="saturate-75 bg-sky-800">*.DOCX</x-mainpage.export-format>
                <x-mainpage.export-format class="saturate-75 bg-rose-800">*.PDF</x-mainpage.export-format>
                <x-mainpage.export-format class="saturate-75 bg-indigo-800">*.HTML</x-mainpage.export-format>
            </div>
        </x-mainpage.section>


        <x-mainpage.section>
            <x-mainpage.h2>
                Вопросы и ответы
            </x-mainpage.h2>

            <div x-data="{ openIndex: null }">
                <div class="mb-0">
                    <button @click="openIndex === 1 ? openIndex = null : openIndex = 1"
                        class="flex w-full items-center justify-between gap-3 rounded-t-xl border border-b-0 border-gray-200 p-5 font-medium text-gray-500 hover:bg-gray-100 focus:ring-1 focus:ring-gray-200 rtl:text-right dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-800 dark:focus:ring-gray-800">
                        <span class="font-semibold">Какие возможности и преимущества при использовании
                            сервиса?</span>
                        <svg class="h-5 w-5 transform" :class="openIndex === 1 ? 'rotate-180' : 'rotate-0'"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
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

                <div class="mb-0">
                    <button @click="openIndex === 2 ? openIndex = null : openIndex = 2"
                        class="flex w-full items-center justify-between gap-3 border border-b-0 border-gray-200 p-5 font-medium text-gray-500 hover:bg-gray-100 focus:ring-1 focus:ring-gray-200 rtl:text-right dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-800 dark:focus:ring-gray-800">
                        <span class="font-semibold">Как начать пользоваться конструктором?</span>
                        <svg class="h-5 w-5 transform" :class="openIndex === 2 ? 'rotate-180' : 'rotate-0'"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
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

                <div class="mb-0">
                    <button @click="openIndex === 3 ? openIndex = null : openIndex = 3"
                        class="flex w-full items-center justify-between gap-3 border border-b-0 border-gray-200 p-5 font-medium text-gray-500 hover:bg-gray-100 focus:ring-1 focus:ring-gray-200 rtl:text-right dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-800 dark:focus:ring-gray-800">
                        <span class="font-semibold">Должен ли я что-то устанавливать на свой компьютер?</span>
                        <svg class="h-5 w-5 transform" :class="openIndex === 3 ? 'rotate-180' : 'rotate-0'"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
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

                <div class="mb-0">
                    <button @click="openIndex === 4 ? openIndex = null : openIndex = 4"
                        class="flex w-full items-center justify-between gap-3 border border-b-0 border-gray-200 p-5 font-medium text-gray-500 hover:bg-gray-100 focus:ring-1 focus:ring-gray-200 rtl:text-right dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-800 dark:focus:ring-gray-800">
                        <span class="font-semibold">Соответствует ли выходная форма ИУЛ требованиям действующего
                            законодательства?</span>
                        <svg class="h-5 w-5 transform" :class="openIndex === 4 ? 'rotate-180' : 'rotate-0'"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
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

                <div class="mb-0">
                    <button @click="openIndex === 5 ? openIndex = null : openIndex = 5"
                        class="border-b-1 flex w-full items-center justify-between gap-3 border border-gray-200 p-5 font-medium text-gray-500 hover:bg-gray-100 focus:ring-1 focus:ring-gray-200 rtl:text-right dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-800 dark:focus:ring-gray-800">
                        <span class="font-semibold">Если у меня остались вопросы?</span>
                        <svg class="h-5 w-5 transform" :class="openIndex === 5 ? 'rotate-180' : 'rotate-0'"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
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
            <x-mainpage.h2
                class="bg-gradient-to-r from-pink-700 via-indigo-500 to-sky-800 bg-clip-text text-transparent">
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
                    <a href="/terms.pdf" target="_blank">Пользовательское соглашение</a>
                    <a href="mailto:smeta@ces.nnov.ru">support@quatros.ru</a>
                </footer>
            </div>
        </div>

    </div>

    @stack('modals')

    @livewireScripts


    <style>
        .pulsing-div {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0% {
                transform: scale(1);
            }

            5% {
                transform: scale(1.01);
                /* Первое "тук" */
            }

            80% {
                transform: scale(1);
                /* Пауза */
            }

            95% {
                transform: scale(1.01);
                /* Второе "тук" */
            }

            100% {
                transform: scale(1);
                /* Заканчиваем в исходном состоянии */
            }
        }
    </style>


</body>

</html>
