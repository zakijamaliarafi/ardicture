<x-layout>
    <header>
        <div class="flex justify-evenly">
            <div>
                <img class="h-40" src="{{$user->user_profile ? asset('storage/' . $user->user_profile) : asset('/images/user.png')}}" alt="">
            </div>
            <div>
                <p class="text-4xl">{{$user->username}}</p>
                <p class="text-base">{{$user->name}}</p>
                <div class="flex">
                    <p class="mr-2">{{$postCount}} posts</p>
                    <p>{{$likedPostCount}} likes</p>
                </div>
                <p>{{$user->user_description}}</p>
            </div>
            <div>
                <a href="/profile/edit">Edit</a>
            </div>
        </div>
    </header>
</x-layout>