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
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    @endif
</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">

    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        {{-- <img id="background" class="absolute -left-20 top-0 max-w-[877px]" src="https://laravel.com/assets/img/welcome/background.svg" alt="Laravel background" /> --}}
        <div
            class="{{-- min-h-screen --}} relative flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <header>
                    <nav x-data="{ open: false }" class="{{-- border-b border-gray-100 bg-white dark:border-gray-700 dark:bg-gray-800 --}}">
                        <!-- Primary Navigation Menu -->
                        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                            <div class="flex h-16 justify-between">
                                <div class="flex">

                                    <!-- Logo -->
                                    <div class="flex shrink-0 items-center">
                                        <a href="{{ route('home') }}">
                                            <img src="{{ asset('storage/images/logo.png') }}" alt="Quartos Logo">

                                            {{-- <x-application-mark class="block h-9 w-auto" /> --}}

                                        </a>
                                    </div>

                                    <!-- Navigation Links -->
                                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                                        {{-- <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                                            {{ __('Документация') }}
                                        </x-nav-link>
                                        <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                                            {{ __('Тарифы') }}
                                        </x-nav-link> --}}
                                    </div>
                                </div>

                                <!-- User menu -->
                                <div class="hidden sm:ms-6 sm:flex sm:items-center">
                                    @if (Route::has('login'))
                                        <nav class="-mx-3 flex flex-1 justify-end">
                                            @auth
                                                <a href="{{ url('/dashboard') }}"
                                                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                                    Личный кабинет
                                                </a>
                                            @else
                                                <a href="{{ route('login') }}"
                                                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                                    Войти
                                                </a>

                                                @if (Route::has('register'))
                                                    <a href="{{ route('register') }}"
                                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                                        Регистрация
                                                    </a>
                                                @endif
                                            @endauth
                                        </nav>
                                    @endif
                                </div>

                                {{-- <div class="hidden sm:ms-6 sm:flex sm:items-center">
                                <!-- Teams Dropdown -->
                                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                                    <div class="relative ms-3">
                                        <x-dropdown align="right" width="60">
                                            <x-slot name="trigger">
                                                <span class="inline-flex rounded-md">
                                                    <button type="button"
                                                        class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:bg-gray-50 focus:outline-none active:bg-gray-50 dark:bg-gray-800 dark:text-gray-400 dark:hover:text-gray-300 dark:focus:bg-gray-700 dark:active:bg-gray-700">
                                                        {{ Auth::user()->currentTeam->name }}

                                                        <svg class="-me-0.5 ms-2 size-4"
                                                            xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5"
                                                            stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                                        </svg>
                                                    </button>
                                                </span>
                                            </x-slot>

                                            <x-slot name="content">
                                                <div class="w-60">
                                                    <!-- Team Management -->
                                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                                        {{ __('Manage Team') }}
                                                    </div>

                                                    <!-- Team Settings -->
                                                    <x-dropdown-link
                                                        href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                                        {{ __('Team Settings') }}
                                                    </x-dropdown-link>

                                                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                                        <x-dropdown-link href="{{ route('teams.create') }}">
                                                            {{ __('Create New Team') }}
                                                        </x-dropdown-link>
                                                    @endcan

                                                    <!-- Team Switcher -->
                                                    @if (Auth::user()->allTeams()->count() > 1)
                                                        <div class="border-t border-gray-200 dark:border-gray-600">
                                                        </div>

                                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                                            {{ __('Switch Teams') }}
                                                        </div>

                                                        @foreach (Auth::user()->allTeams() as $team)
                                                            <x-switchable-team :team="$team" />
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </x-slot>
                                        </x-dropdown>
                                    </div>
                                @endif

                                <!-- Settings Dropdown -->
                                <div class="relative ms-3">
                                    <x-dropdown align="right" width="48">
                                        <x-slot name="trigger">
                                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                                <button
                                                    class="flex rounded-full border-2 border-transparent text-sm transition focus:border-gray-300 focus:outline-none">
                                                    <img class="size-8 rounded-full object-cover"
                                                        src="{{ Auth::user()->profile_photo_url }}"
                                                        alt="{{ Auth::user()->name }}" />
                                                </button>
                                            @else
                                                <span class="inline-flex rounded-md">
                                                    <button type="button"
                                                        class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:bg-gray-50 focus:outline-none active:bg-gray-50 dark:bg-gray-800 dark:text-gray-400 dark:hover:text-gray-300 dark:focus:bg-gray-700 dark:active:bg-gray-700">
                                                        {{ Auth::user()->name }}

                                                        <svg class="-me-0.5 ms-2 size-4"
                                                            xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5"
                                                            stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                        </svg>
                                                    </button>
                                                </span>
                                            @endif
                                        </x-slot>

                                        <x-slot name="content">
                                            <!-- Account Management -->
                                            <div class="block px-4 py-2 text-xs text-gray-400">
                                                {{ __('Manage Account') }}
                                            </div>

                                            <x-dropdown-link href="{{ route('profile.show') }}">
                                                {{ __('Profile') }}
                                            </x-dropdown-link>

                                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                                <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                                    {{ __('API Tokens') }}
                                                </x-dropdown-link>
                                            @endif

                                            <div class="border-t border-gray-200 dark:border-gray-600"></div>

                                            <!-- Authentication -->
                                            <form method="POST" action="{{ route('logout') }}" x-data>
                                                @csrf

                                                <x-dropdown-link href="{{ route('logout') }}"
                                                    @click.prevent="$root.submit();">
                                                    {{ __('Log Out') }}
                                                </x-dropdown-link>
                                            </form>
                                        </x-slot>
                                    </x-dropdown>
                                </div>
                            </div> --}}

                                <!-- Hamburger -->
                                <div class="-me-2 flex items-center sm:hidden">
                                    <button @click="open = ! open"
                                        class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none dark:text-gray-500 dark:hover:bg-gray-900 dark:hover:text-gray-400 dark:focus:bg-gray-900 dark:focus:text-gray-400">
                                        <svg class="size-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                            <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 6h16M4 12h16M4 18h16" />
                                            <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Responsive Navigation Menu -->
                        <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
                            {{-- <div class="space-y-1 pb-3 pt-2">
                                <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                                    {{ __('Документация') }}
                                </x-responsive-nav-link>
                                <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                                    {{ __('Тарифы') }}
                                </x-responsive-nav-link>
                                <x-responsive-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')">
                                    {{ __('Регистрация') }}
                                </x-responsive-nav-link> --}}
                            @if (Route::has('login'))
                                <nav class="-mx-3 flex flex-1 justify-end">
                                    @auth
                                        <a href="{{ url('/dashboard') }}"
                                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                            Личный кабинет
                                        </a>
                                    @else
                                        <a href="{{ route('login') }}"
                                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                            Войти
                                        </a>

                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}"
                                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                                Регистрация
                                            </a>
                                        @endif
                                    @endauth
                                </nav>
                            @endif
                        </div>

                        <!-- Responsive Settings Options -->
                        {{-- <div class="border-t border-gray-200 pb-1 pt-4 dark:border-gray-600">
                            <div class="flex items-center px-4">
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <div class="me-3 shrink-0">
                                        <img class="size-10 rounded-full object-cover"
                                            src="{{ Auth::user()->profile_photo_url }}"
                                            alt="{{ Auth::user()->name }}" />
                                    </div>
                                @endif

                                <div>
                                    <div class="text-base font-medium text-gray-800 dark:text-gray-200">
                                        {{ Auth::user()->name }}</div>
                                    <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
                                </div>
                            </div>

                            <div class="mt-3 space-y-1">
                                <!-- Account Management -->
                                <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                                    {{ __('Profile') }}
                                </x-responsive-nav-link>

                                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                    <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                                        {{ __('API Tokens') }}
                                    </x-responsive-nav-link>
                                @endif

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf

                                    <x-responsive-nav-link href="{{ route('logout') }}"
                                        @click.prevent="$root.submit();">
                                        {{ __('Log Out') }}
                                    </x-responsive-nav-link>
                                </form>

                                <!-- Team Management -->
                                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                                    <div class="border-t border-gray-200 dark:border-gray-600"></div>

                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Team') }}
                                    </div>

                                    <!-- Team Settings -->
                                    <x-responsive-nav-link
                                        href="{{ route('teams.show', Auth::user()->currentTeam->id) }}"
                                        :active="request()->routeIs('teams.show')">
                                        {{ __('Team Settings') }}
                                    </x-responsive-nav-link>

                                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                        <x-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                                            {{ __('Create New Team') }}
                                        </x-responsive-nav-link>
                                    @endcan

                                    <!-- Team Switcher -->
                                    @if (Auth::user()->allTeams()->count() > 1)
                                        <div class="border-t border-gray-200 dark:border-gray-600"></div>

                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            {{ __('Switch Teams') }}
                                        </div>

                                        @foreach (Auth::user()->allTeams() as $team)
                                            <x-switchable-team :team="$team" component="responsive-nav-link" />
                                        @endforeach
                                    @endif
                                @endif
                            </div>
                        </div> --}}
            </div>
            </nav>
            </header>




            <main class="mt-6">
                <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                    <h1 class="text-4xl">Конструктор ИУЛ для проектно-сметной документации</h1>
                    <ol>
                        <li>Поддерживаемые форматы</li>
                        <li>Поддерживаемые версии браузеров (десктоп и мобильный)</li>
                        <li>ГОСТ Р 21.101-2020 Система проектной документации для строительства. Основные требования к проектной и рабочей документации</li>
                        <li>УЛ рекомендуется выполнять в соответствии с формой 15 на листах формата A4, A5 по ГОСТ 2.301.68 «Единая система конструкторской документации»</li>
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
