<x-layout>


    @php
        $i = 1;
    @endphp
    <div class="container mx-6 my-6">
        <h1>POSTS (Deskripsi)</h1>
        @foreach ($posts as $post)
            <p>{{ $i }}</p>
            <div>
                @foreach ($images as $image)
                    @if ($image->id == $post->id)
                        @if (Str::startsWith($image->image, 'http'))
                            <img src="{{ $image->image }}" alt="Image {{ $i }}" width="20%" height="20%">
                        @else
                            <img src="{{ asset('storage/' . $image->image) }}" alt="Image {{ $i }}"
                                width="20%" height="20%">
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
                <a href="{{ route('posts.show', ['post' => $post->id]) }}">View Details</a>
                <p>{{ $post->description }}</p>
            </div>
            @php
                $i++;
            @endphp
        @endforeach
    </div>

</x-layout>
