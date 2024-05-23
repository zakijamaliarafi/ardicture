@props(['post'])

<div>
    <a href="/posts/{{$post->id}}">
        <img class="w-48 h-64 rounded-xl object-cover" src="{{$post->image ? asset('storage/' . $post->image) : asset('images/NoImage.jpg')}}" alt="">
        <p class="font-medium mx-1">{{$post->description}}</p>
    </a>
    <a href="/users/{{$post->userId}}">
        <div class="flex mx-1">
            <div class="w-6 h-6 rounded-full overflow-hidden">
                <img class="w-full h-full object-cover" src="{{$post->profile ? asset('storage/' . $post->profile) : asset('/images/user.png')}}" alt="">
            </div>
            <p class="ml-2">{{$post->username}}</p>
        </div>
    </a>
    
</div>