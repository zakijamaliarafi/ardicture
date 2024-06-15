<x-layout>
    <div class="ml-24 mb-10">
        <img src="{{asset('images/Hero.png')}}" alt="">
    </div>
    <div class="ml-24 my-5 flex justify-center">
        <form action="/search">
        <div class="inline-flex border-2 items-center rounded-2xl">
                <input
                type="text"
                name="search"
                placeholder="Searching for someting?"
                class="text-lg px-6 py-4 rounded-l-xl w-[42rem]"
                />
                <div class="bg-ardicture-orange px-6 py-3 rounded-r-xl">
                    <button type="submit">
                        <img class="h-8" src="{{asset('images/Search.png')}}" alt="">
                    </button>
                </div>
        </div>
    </form>
    </div>
    <div class="ml-24 my-5">
        <p class="text-2xl">Home</p>
    </div>
    <div x-data="{ activeTab: getDynamicPostsParamName() || 'all' }" class="ml-24 mb-16">

        <!-- Buttons to switch between categories -->
        <div class="flex space-x-4 mb-6 text-base">
            <button @click="activeTab = 'all'" 
                    :class="activeTab === 'all' ? 'bg-black text-white' : 'text-black border-black border'" 
                    class="px-4 rounded-xl">
                All
            </button>
            <button @click="activeTab = 'posts1'" 
                    :class="activeTab === 'posts1' ? 'bg-black text-white' : 'text-black border-black border'" 
                    class="px-4 rounded-xl">
                {{ ucwords(str_replace('_', ' ', $tags[0])) }}

            </button>
            <button @click="activeTab = 'posts2'" 
                    :class="activeTab === 'posts2' ? 'bg-black text-white' : 'text-black border-black border'" 
                    class="px-4 rounded-xl">
                {{ ucwords(str_replace('_', ' ', $tags[1])) }}
            </button>
            <button @click="activeTab = 'posts3'" 
                    :class="activeTab === 'posts3' ? 'bg-black text-white' : 'text-black border-black border'" 
                    class="px-4 rounded-xl">
                {{ ucwords(str_replace('_', ' ', $tags[2])) }}
            </button>
            <button @click="activeTab = 'posts4'" 
                    :class="activeTab === 'posts4' ? 'bg-black text-white' : 'text-black border-black border'" 
                    class="px-4 rounded-xl">
                {{ ucwords(str_replace('_', ' ', $tags[3])) }}
            </button>
            <button @click="activeTab = 'posts5'" 
                    :class="activeTab === 'posts5' ? 'bg-black text-white' : 'text-black border-black border'" 
                    class="px-4 rounded-xl">
                {{ ucwords(str_replace('_', ' ', $tags[4])) }}
            </button>
            <button @click="activeTab = 'posts6'" 
                    :class="activeTab === 'posts6' ? 'bg-black text-white' : 'text-black border-black border'" 
                    class="px-4 rounded-xl">
                {{ ucwords(str_replace('_', ' ', $tags[5])) }}
            </button>
            <button @click="activeTab = 'posts7'" 
                    :class="activeTab === 'posts7' ? 'bg-black text-white' : 'text-black border-black border'" 
                    class="px-4 rounded-xl">
                {{ ucwords(str_replace('_', ' ', $tags[6])) }}
            </button>
            <button @click="activeTab = 'posts8'" 
                    :class="activeTab === 'posts8' ? 'bg-black text-white' : 'text-black border-black border'" 
                    class="px-4 rounded-xl">
                {{ ucwords(str_replace('_', ' ', $tags[7])) }}
            </button>
        </div>

        <!-- All posts -->
        <div x-show="activeTab === 'all'" >
            <div class="flex justify-start flex-wrap gap-x-8 gap-y-4 mb-8">
                @foreach($posts as $post)
                    <x-post-card :post="$post" />
                @endforeach
            </div>
            <div class="flex place-content-center">
                {{ $posts->links() }}
            </div>
        </div>

        <!-- Tag 1 -->
        <div x-show="activeTab === 'posts1'" >
            <div class="flex justify-start flex-wrap gap-x-8 gap-y-4 mb-8">
                @foreach($posts1 as $post1)
                    <x-post-card :post="$post1" />
                @endforeach
            </div>
            <div class="flex place-content-center">
                {{ $posts1->links() }}
            </div>
        </div>

        <!-- Tag 2 -->
        <div x-show="activeTab === 'posts2'" >
            <div class="flex justify-start flex-wrap gap-x-8 gap-y-4 mb-8">
                @foreach($posts2 as $post2)
                    <x-post-card :post="$post2" />
                @endforeach
            </div>
            <div class="flex place-content-center">
                {{ $posts2->links() }}
            </div>
        </div>

        <!-- Tag 3 -->
        <div x-show="activeTab === 'posts3'" >
            <div class="flex justify-start flex-wrap gap-x-8 gap-y-4 mb-8">
                @foreach($posts3 as $post3)
                    <x-post-card :post="$post3" />
                @endforeach
            </div>
            <div class="flex place-content-center">
                {{ $posts3->links() }}
            </div>
        </div>

        <!-- Tag 4 -->
        <div x-show="activeTab === 'posts4'" >
            <div class="flex justify-start flex-wrap gap-x-8 gap-y-4 mb-8">
                @foreach($posts4 as $post4)
                    <x-post-card :post="$post4" />
                @endforeach
            </div>
            <div class="flex place-content-center">
                {{ $posts4->links() }}
            </div>
        </div>

        <!-- Tag 5 -->
        <div x-show="activeTab === 'posts5'" >
            <div class="flex justify-start flex-wrap gap-x-8 gap-y-4 mb-8">
                @foreach($posts5 as $post5)
                    <x-post-card :post="$post5" />
                @endforeach
            </div>
            <div class="flex place-content-center">
                {{ $posts5->links() }}
            </div>
        </div>

        <!-- Tag 6 -->
        <div x-show="activeTab === 'posts6'" >
            <div class="flex justify-start flex-wrap gap-x-8 gap-y-4 mb-8">
                @foreach($posts6 as $post6)
                    <x-post-card :post="$post6" />
                @endforeach
            </div>
            <div class="flex place-content-center">
                {{ $posts6->links() }}
            </div>
        </div>

        <!-- Tag 7 -->
        <div x-show="activeTab === 'posts7'" >
            <div class="flex justify-start flex-wrap gap-x-8 gap-y-4 mb-8">
                @foreach($posts7 as $post7)
                    <x-post-card :post="$post7" />
                @endforeach
            </div>
            <div class="flex place-content-center">
                {{ $posts7->links() }}
            </div>
        </div>

        <!-- Tag 8 -->
        <div x-show="activeTab === 'posts8'" >
            <div class="flex justify-start flex-wrap gap-x-8 gap-y-4 mb-8">
                @foreach($posts8 as $post8)
                    <x-post-card :post="$post8" />
                @endforeach
            </div>
            <div class="flex place-content-center">
                {{ $posts8->links() }}
            </div>
        </div>
    </div>
    <x-footer />
</x-layout>

<script>
    function getDynamicPostsParamName() {
        const urlParams = new URLSearchParams(window.location.search);
        for (const [key, value] of urlParams.entries()) {
            if (key.startsWith('posts')) {
                return key;
            }
        }
        return null;
    }
</script>
