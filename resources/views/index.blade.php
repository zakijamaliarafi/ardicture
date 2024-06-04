<x-layout>
    <div class="mx-24 my-5">
        <p class="text-2xl">Home</p>
    </div>
    <div x-data="{ activeTab: 'all' }" class="mx-24 mb-5">

        <!-- Buttons to switch between categories -->
        <div class="flex space-x-4 mb-6 text-base">
            <button @click="activeTab = 'all'" 
                    :class="activeTab === 'all' ? 'bg-black text-white' : 'text-black border-black border'" 
                    class="px-4 rounded-xl">
                All
            </button>
            <button @click="activeTab = 'anime'" 
                    :class="activeTab === 'anime' ? 'bg-black text-white' : 'text-black border-black border'" 
                    class="px-4 rounded-xl">
                Anime
            </button>
            <button @click="activeTab = 'art'" 
                    :class="activeTab === 'art' ? 'bg-black text-white' : 'text-black border-black border'" 
                    class="px-4 rounded-xl">
                Art
            </button>
            <button @click="activeTab = 'poster'" 
                    :class="activeTab === 'poster' ? 'bg-black text-white' : 'text-black border-black border'" 
                    class="px-4 rounded-xl">
                Poster
            </button>
            <button @click="activeTab = 'wallpaper'" 
                    :class="activeTab === 'wallpaper' ? 'bg-black text-white' : 'text-black border-black border'" 
                    class="px-4 rounded-xl">
                Wallpaper
            </button>
        </div>

        <!-- All Posts -->
        <div x-show="activeTab === 'all'" class="flex justify-start flex-wrap gap-x-8 gap-y-4">
            @foreach($posts as $post)
                <x-post-card :post="$post" />
            @endforeach
        </div>

        <!-- Anime Posts -->
        <div x-show="activeTab === 'anime'" class="flex justify-start flex-wrap gap-x-8 gap-y-4">
            @foreach($animePosts as $animePost)
                <x-post-card :post="$animePost" />
            @endforeach
        </div>

        <!-- Art Posts -->
        <div x-show="activeTab === 'art'" class="flex justify-start flex-wrap gap-x-8 gap-y-4">
            @foreach($artPosts as $artPost)
                <x-post-card :post="$artPost" />
            @endforeach
        </div>

        <!-- Poster Posts -->
        <div x-show="activeTab === 'poster'" class="flex justify-start flex-wrap gap-x-8 gap-y-4">
            @foreach($posterPosts as $posterPost)
                <x-post-card :post="$posterPost" />
            @endforeach
        </div>

        <!-- Wallpaper Posts -->
        <div x-show="activeTab === 'wallpaper'" class="flex justify-start flex-wrap gap-x-8">
            @foreach($wallpaperPosts as $wallpaperPost)
                <x-post-card :post="$wallpaperPost" />
            @endforeach
        </div>
    </div>
</x-layout>
