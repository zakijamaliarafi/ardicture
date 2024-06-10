<x-layout>
    <div class="mx-24 my-10 text-3xl">
        @if(isset($tag))
        <p>{{ucfirst(str_replace('_', ' ', $tag->tag))}}</p>
        @elseif(isset($search))
        <p>Search for '{{$search}}'</p>
        @endif
    </div>
    <div class="flex justify-start flex-wrap gap-x-8 mx-24">
    @foreach($posts as $post)
        <x-post-card :post="$post" />
    @endforeach
    </div>
</x-layout>

