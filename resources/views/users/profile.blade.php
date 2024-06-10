<x-layout>
    <div class="flex justify-evenly">
        <div class="w-40 h-40 rounded-full overflow-hidden">
            <img class="w-full h-full object-cover" src="{{$user->user_profile ? asset('storage/' . $user->user_profile) : asset('/images/user.png')}}" alt="">
        </div>
        <div class="max-w-80">
            <p class="text-4xl">{{$user->username}}</p>
            <p class="text-base">{{$user->name}}</p>
            <div class="flex">
                <p class="mr-2">{{$postCount}} posts</p>
                <p>{{$likedPostCount}} likes</p>
            </div>
            <p>{{$user->user_description}}</p>
        </div>
        <div>
            @if (Auth::check() && Auth::user()->id == $user->id)
            <a href="/profile/edit">Edit</a>
            @endif
        </div>
    </div>
    <div class="mx-24 ">
        <a href="/posts/create" class="bg-blue-400 p-1 rounded">add new post</a>
    </div>
    <div class="mx-24 my-5">
        <p>Post</p>
    </div>
    <div class="flex justify-start flex-wrap gap-x-8 gap-y-4 mx-24 mb-5">
        @foreach($userPosts as $post)
            <x-post-card :post="$post" />
        @endforeach
    </div>
</x-layout>