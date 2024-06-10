<x-layout>
    <div class="flex justify-evenly">
        <div class="w-40 h-40 rounded-full overflow-hidden">
            <img class="w-full h-full object-cover"
                src="{{ $user->user_profile ? asset('storage/' . $user->user_profile) : asset('/images/user.png') }}"
                alt="">
        </div>
        <div class="max-w-80">
            <p class="text-4xl">{{ $user->username }}</p>
            <p class="text-base">{{ $user->name }}</p>
            <div class="flex">
                <p class="mr-2">{{ $postCount }} posts</p>
                <p>{{ $likedPostCount }} likes</p>
            </div>
            <p>{{ $user->user_description }}</p>
        </div>
        <div>
            <a href="/profile/edit">Edit</a>
        </div>
    </div>
    <div class="mx-24 my-5">
        <!-- Buttons to switch between Posts and Liked -->
        <div class="flex space-x-4 mb-6 text-base">
            <button @click="activeTab = 'posts'"
                :class="activeTab === 'posts' ? 'bg-black text-white' : 'text-black border-black border'"
                class="px-4 rounded-xl">
                Posts
            </button>
            <button @click="activeTab = 'liked'"
                :class="activeTab === 'liked' ? 'bg-black text-white' : 'text-black border-black border'"
                class="px-4 rounded-xl">
                Liked
            </button>
        </div>

        <!-- Posts -->
        <div x-show="activeTab === 'posts'" class="flex justify-start flex-wrap gap-x-8 gap-y-4">
            @foreach ($userPosts as $post)
                <x-post-card :post="$post" />
            @endforeach
        </div>

        <!-- Anime Posts -->
        <div x-show="activeTab === 'liked'" class="flex justify-start flex-wrap gap-x-8 gap-y-4">
            @foreach ($likedPosts as $likedPost)
                <x-post-card :post="$likedPost" />
            @endforeach
        </div>
    </div>
</x-layout>
