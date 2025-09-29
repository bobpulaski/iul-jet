<x-blog-layout :posts="$posts">
    <main>
        <div id="container">
            <h1>Блог</h1>
            @foreach($posts as $post)
                <div
                    style="box-shadow: 0px 0px 0px 1px #DCDCDC; padding: 2rem; border-radius: 8px; margin-bottom: 3rem">
                    <h2><a href="{{ route('article', ['slug' => $post['slug']]) }}">{!!  $post['meta']['title'] !!}</a>
                    </h2>
                    <p>{!!  $post['meta']['description'] !!}</p>
                    <div style="display: flex; justify-content: space-between;">

                        @php
                            $date = new DateTime();
                            $date->setTimestamp($post['meta']['published']);
                            $published = $date->format('d.m.Y');
                        @endphp

                        <small style="color: #999">{!!  $published !!}</small>
                        <a href="{{ route('article', ['slug' => $post['slug']]) }}" class="button button-outline">Читать
                            далее</a>
                    </div>
                </div>
        @endforeach
    </main>
</x-blog-layout>
