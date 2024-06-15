<x-layout>
    <div class="ml-10 my-10 text-3xl">
        <p>Search for '{{$search}}'</p>
    </div>
    @if($posts && $posts->isNotEmpty())
    <div class="flex justify-start flex-wrap gap-x-8 gap-y-4 ml-10 mb-8">
        @foreach($posts as $post)
            <x-post-card :post="$post" />
        @endforeach
    </div>
    <div class="flex place-content-center mb-16">
        {{ $posts->links() }}
    </div>
    @else
    <div class="ml-10 mt-10 mb-16 text-xl">
        <p>Posts not found</p>
    </div>
    @endif
    <x-footer />
</x-layout>