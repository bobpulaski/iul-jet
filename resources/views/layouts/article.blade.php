@props(['post'])

    <!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">


    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.css">

    <title>{{ $post['meta']['title'] ? $post['meta']['title'] . ' – Блог Quatros' : 'Блог Quatros' }}</title>

    <meta name="description" content="{{ $post['meta']['description'] }}" />
    <meta name="keywords" content="{{ $post['meta']['keywords'] }}" />
    <link rel="canonical" href="{{ url()->current() }}">
    <meta name="robots" content="all"/>
    <meta name="yandex" content="all" />

</head>


<body class="mx-auto max-w-screen-lg my-12 px-8 text-3xl/[3rem] antialiased font-normal">

<x-blog.header>
    <x-blog.nav>
        <x-blog.logo/>
        <x-blog.header-menu/>
    </x-blog.nav>
</x-blog.header>

<!-- Article Page Content -->
<main>
    {{ $slot }}
</main>

</body>
</html>

