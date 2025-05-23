<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">


    @if (request()->routeIs('login'))
        <meta name="description" content="Страница входа">
        <title>Войти | Конструктор ИУЛ проектной документации для экспертизы</title>
    @elseif (request()->routeIs('register'))
        <meta name="description" content="Страница регистрации">
        <title>Регистрация | Конструктор ИУЛ проектной документации для экспертизы</title>
    @elseif (request()->routeIs('forgot-password'))
        <meta name="description" content="Страница восстановления пароля">
        <title>Восстановление пароля</title>
    @else
        <meta name="description" content="Страница восстановления пароля">
        <title>Восстановление пароля | Конструктор ИУЛ проектной документации для экспертизы</title>
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body>
    <div class="font-sans text-gray-900 antialiased dark:text-gray-100">
        {{ $slot }}
    </div>

    @livewireScripts
</body>

</html>
