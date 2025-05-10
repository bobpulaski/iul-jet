<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>Blog</h1>
<main>
    @foreach($posts as $post)
        <p>{!!  $post['meta']['title'] !!}</p>
{{--        <a href="{{$post['slug']}}">{{$post['slug']}}</a>--}}
        <a href="{{ route('article', ['slug' => $post['slug']]) }}">{!! $post['slug'] !!}</a>

    @endforeach
</main>
</body>
</html>
