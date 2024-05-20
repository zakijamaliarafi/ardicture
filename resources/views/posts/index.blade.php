<x-app-layout>
@include('layouts.navbar')

<h1>POSTS (Deskripsi)</h1>
@php
    $i = 1;
@endphp
<div class="container">
    @foreach ($posts as $post)
        <p>{{ $i }}</p>
        <div>
            @foreach ($images as $image)
                @if ($image->post_id == $post->post_id)
                    @if (Str::startsWith($image->image, 'http'))
                        <img src="{{ $image->image }}" alt="Image {{ $i }}" width="20%" height="20%">
                    @else
                        <img src="{{ asset('storage/' . $image->image) }}" alt="Image {{ $i }}" width="20%" height="20%">
                    @endif
                @endif
            @endforeach
        </div>
        <div>
            <p>Likes: 
                @if ($post->likes_count == null)
                    0
                @else
                    {{ $post->likes_count }}
                @endif
            </p>
            <p>Rate: {{ $post->rate }}</p>
            <a href="{{ route('posts.show', ['post' => $post->post_id]) }}">View Details</a>
            <p>{{ $post->description }}</p>
        </div>
        @php
            $i++;
        @endphp 
    @endforeach
</div>

</x-app-layout>

