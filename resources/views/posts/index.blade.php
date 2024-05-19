@include('layouts.navbar')

<h1>POSTS (Deskripsi)</h1>
@php
    $i = 1;
@endphp
@foreach ($posts as $post)
    <div>
        <p>{{ $i }}</p>
        <p>Likes: 
            @if ($post->likes_count == null)
                0
            @else
                {{ $post->likes_count }}
            @endif
        </p>
        <p>Rate: {{ $post->rate }}</p>
        <a href="/posts/{{ $post->post_id }}/">View Details</a>
        <p>{{ $post->description }}</p>
    </div>
    @php
        $i++;
    @endphp 
@endforeach
