<x-blog-layout :posts="$posts">
<main>
        <div id="container">
            <h1>Блог</h1>
            @foreach($posts as $post)
                <h2><a href="{{ route('article', ['slug' => $post['slug']]) }}">{!!  $post['meta']['title'] !!}</a></h2>
                <p>{!!  $post['meta']['description'] !!}</p>
        @endforeach
    </main>
</x-blog-layout>
