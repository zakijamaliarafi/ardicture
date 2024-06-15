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
            @if (Auth::check() && Auth::user()->id == $user->id)
                <a href="/profile/edit">Edit</a>
            @endif
        </div>
    </div>
    <div class="m-10 mt-5 mb-32"
        @if ($liked === true) x-data="{ activeTab: 'liked' }"
        @else x-data="{ activeTab: 'posts' }" @endif>
        <!-- Buttons to switch between Posts and Liked -->
        <div class="flex space-x-4 mb-6 text-base">
            <button @click="activeTab = 'posts'" x-init="() => { console.log('Active Tab:', activeTab); }"
                :class="activeTab === 'posts' ? 'bg-black text-white' : 'text-black border-black border'"
                class="px-4 rounded-xl">
                Posts
            </button>
            <button @click="activeTab = 'liked'" x-init="() => { console.log('Active Tab:', activeTab); }"
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

    <x-footer />
    <script>
        document.addEventListener('alpine:init', () => {
            console.log('Alpine.js initialized');
            Alpine.data('profile_preview_handler', () => ({
                profile_image: '',
                init() {
                    console.log('profile_preview_handler initialized');
                },
                preview_profile(event) {
                    profile_image = '';
                    const files = event.target.files;
                    let reader = new FileReader();
                    reader.onload = (e) => {
                        this.profile_image.push(e.target.result);
                    }
                    reader.readAsDataURL(files);

                    document.getElementById('image_container').classList.add('flex');
                    document.getElementById('preview_image').classList.add('h-full');
                    this.profile_image.style.display = 'flex'
                }
            }));

        });
    </script>
</x-layout>
