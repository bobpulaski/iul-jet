<x-article-layout :post="$post">

    @php
        $date = new DateTime();
        $date->setTimestamp($post['meta']['published']);
        $published = $date->format('d.m.Y');
    @endphp

    <main>
        <div id="container">
            <small style="color: #999;">{!!  $published !!}</small>
            {!! $post['body'] !!}
        </div>
    </main>
</x-article-layout>
