<x-layout>
    <div class="ml-6 mt-6">
        <h1 class="text-2xl mg-6">{{ $post->description }}</h1>
        <div class="mt-3" x-data="likes({{ $like_id }}, {{ $post->id }}, {{ auth()->user()->id }})">
            <form @submit.prevent="toggle">
                @csrf
                <div>
                    <button type="submit" :class="like_id ? 'bg-red-500' : 'bg-black'"
                        class="text-white px-4 py-1 rounded-md">
                        Likes
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function likes(like_id, post_id, user_id) {
            return {
                like_id: like_id,
                post_id: post_id,
                user_id: user_id,
                toggle() {
                    fetch('/likes/toggle', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.head.querySelector('meta[name=csrf-token]').content
                            },
                            body: JSON.stringify({
                                like_id: this.like_id,
                                post_id: this.post_id,
                                user_id: this.user_id
                            })
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(`HTTP error! status: ${response.status}`);
                            }
                            return response.json();
                        })
                        .then(data => {
                            this.like_id = data.like_id;
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            this.message = 'An error occurred.';
                        });
                }
            }
        }
    </script>
</x-layout>
