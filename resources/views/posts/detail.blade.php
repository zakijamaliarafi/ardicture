<x-layout>
    <div class="ml-6 mt-6">
        <h1 class="text-2xl mg-6">{{ $post->description }}</h1>
        <div class="mt-3">
            <form action="{{ route('posts.like', ['post_id' => $post->id, 'user_id' => auth()->user()->id]) }}"
                method="POST">
                @csrf
                <input type="int" hidden name="post_id" value="{{ $post->id }}">
                <input type="int" hidden name="user_id" value="{{ auth()->user()->id }}">
                <button type="submit" class="text-white px-4 py-1 rounded-md {{ $liked ? 'bg-red-500' : 'bg-black' }}">
                    Likes
                </button>
            </form>
        </div>
    </div>
</x-layout>
