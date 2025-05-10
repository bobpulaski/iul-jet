<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.css">

{{--    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">--}}
    {{--        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css">--}}
    <title>Document</title>

</head>


<body class="mx-auto max-w-screen-lg my-12 px-8 text-3xl/[3rem] antialiased font-normal">

<x-blog.header>
    <x-blog.nav>
        <x-blog.logo/>
        <x-blog.header-menu/>
    </x-blog.nav>
</x-blog.header>

<main>
    <div id="container">
        {!! $post['body'] !!}
    </div>
</main>

</body>
</html>

