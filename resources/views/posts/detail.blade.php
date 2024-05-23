<x-layout>
    <div class="mx-24 flex">
        <!-- Image Contaianer -->
        <div class="w-3/5 h-96 flex flex-col justify-center items-center">
            <div class="mx-auto relative"
            x-data="{ activeSlide: 1, slides: {{ $images}} }">
                <!-- Slides -->
                <template x-for="(slide, index) in slides" :key="index">
                    <div x-show="activeSlide === index + 1"
                        class="px-14 font-bold text-5xl h-96 flex items-center">
                        <img class="object-contain h-full" :src="slide" alt="">
                    </div>
                </template>
                <!-- Prev/Next Arrows -->
                <div class="absolute inset-0 flex" x-show="slides.length > 1"> 
                    <div class="flex items-center justify-start w-1/2">
                        <button class="text-black hover:text-orange-500 font-bold hover:shadow-lg rounded-full w-12 h-12"
                                x-on:click="activeSlide = activeSlide === 1 ? 1 : activeSlide - 1">
                            &#8592;
                        </button>
                    </div>
                    <div class="flex items-center justify-end w-1/2">
                        <button class="text-black hover:text-orange-500 font-bold hover:shadow rounded-full w-12 h-12"
                                x-on:click="activeSlide = activeSlide === slides.length ? slides.length : activeSlide + 1">
                            &#8594;
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Recomendation Contaianer -->
        <div class="w-2/5 px-10">
            <p>More by {{$user->username}}</p>
            <div class="flex gap-x-2">
                @foreach ($morePosts as $morePost)
                    <a href="/posts/{{$morePost->id}}">
                        <img class="h-20 w-20 rounded-lg object-cover" src="{{$morePost->image ? asset('storage/' . $morePost->image) : asset('images/NoImage.jpg')}}" alt="">
                    </a>
                @endforeach
            </div>
            <p>Post you might like</p>
            <div class="flex gap-x-2">
                @foreach ($randomPosts as $randomPost)
                    <a href="/posts/{{$randomPost->id}}">
                        <img class="h-20 w-20 rounded-lg object-cover" src="{{$randomPost->image ? asset('storage/' . $randomPost->image) : asset('images/NoImage.jpg')}}" alt="">
                    </a>
                @endforeach
            </div>
        </div>
    </div>
    <div class="mx-24 flex">
        <div class="w-3/5">
            <!-- add favorite and action button container -->
            <div class="flex justify-between">
                <a href="/favorites">Add to Favorites</a>
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="focus:outline-none">
                        <img class="w-10" src="{{asset('images/TripleDotAction.png')}}" alt="">
                    </button>
                    <ul
                        x-show="open"
                        @click.away="open = false"
                        class="absolute right-0 w-48 py-2 mt-2 bg-white rounded-lg shadow-xl"
                    >
                        @if (Auth::check() && Auth::user()->id == $user->id)
                            <li>
                                <a href="/posts/{{$post->id}}/edit" 
                                class="block px-4 py-2 text-gray-800 hover:bg-indigo-500 hover:text-white"
                                >Edit</a>
                            </li>
                            <li>
                                <form method="POST" action="/posts/{{$post->id}}" onsubmit="return confirm('Are you sure you want to delete this post?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="block px-4 py-2 text-gray-800 hover:bg-indigo-500 hover:text-white">
                                        Delete
                                    </button>
                                </form>
                            </li>
                        @elseif (Auth::check() && Auth::user()->role === 'admin')
                            <li>
                                <form method="POST" action="/posts/{{$post->id}}" onsubmit="return confirm('Are you sure you want to delete this post?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="block px-4 py-2 text-gray-800 hover:bg-indigo-500 hover:text-white">
                                        Delete
                                    </button>
                                </form>
                            </li>
                        @elseif (Auth::check())
                            <li>
                                <a href="/report" 
                                class="block px-4 py-2 text-gray-800 hover:bg-indigo-500 hover:text-white"
                                >Report</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            <!-- post detail -->
            <div>
                <p class="font-medium text-lg">{{$post->description}}</p>
                <a href="/users/{{$user->id}}">
                    <div class="flex mx-1">
                        <div class="w-6 h-6 rounded-full overflow-hidden">
                            <img class="w-full h-full object-cover" src="{{$user->user_profile ? asset('storage/' . $user->user_profile) : asset('/images/user.png')}}" alt="">
                        </div>
                        <p class="ml-2">{{$user->username}}</p>
                    </div>
                </a>
            </div>
        </div>
        <div class="w-2/5">
        </div>
    </div>
    
    

    
</x-layout>