<x-layout>
    <div class="ml-10 my-10 text-3xl">
        <p>{{ucfirst(str_replace('_', ' ', $tag->tag))}}</p>
    </div>
    <div class="flex justify-start flex-wrap gap-x-8 gap-y-4 ml-10 mb-8">
    @foreach($posts as $post)
        <x-post-card :post="$post" />
    @endforeach
    </div>
    <div class="flex place-content-center mb-16">
        {{ $posts->links() }}
    </div>
    <x-footer />
</x-layout>

