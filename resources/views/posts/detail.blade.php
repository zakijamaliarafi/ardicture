    <x-layout>
        <div class="m-10 flex">
            <!-- Image Container -->
            <div class="w-3/5 h-96 flex flex-col justify-center items-center">
                <div class="mx-auto relative z-40" x-data="{ activeSlide: 1, slides: {{ $images }} }">
                    <!-- Slides -->
                    <template x-for="(slide, index) in slides" :key="index">
                        <div x-show="activeSlide === index + 1" class="px-14 font-bold text-5xl h-96 flex items-center">
                            <img class="object-contain h-full" :src="slide" alt="">
                        </div>
                    </template>
                    <!-- Prev/Next Arrows -->
                    <div class="absolute inset-0 flex" x-show="slides.length > 1">
                        <div class="flex items-center justify-start w-1/2">
                            <button
                                class="text-black hover:text-orange-500 font-bold hover:shadow-lg rounded-full w-12 h-12"
                                x-on:click="activeSlide = activeSlide === 1 ? 1 : activeSlide - 1">
                                &#8592;
                            </button>
                        </div>
                        <div class="flex items-center justify-end w-1/2">
                            <button
                                class="text-black hover:text-orange-500 font-bold hover:shadow rounded-full w-12 h-12"
                                x-on:click="activeSlide = activeSlide === slides.length ? slides.length : activeSlide + 1">
                                &#8594;
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Recomendation Contaianer -->
            <div class="w-2/5 px-10">
                <p>More by {{ $user->username }}</p>
                <div class="flex gap-x-2">
                    @foreach ($morePosts as $morePost)
                        <a href="/posts/{{ $morePost->id }}">
                            <img class="h-20 w-20 rounded-lg object-cover"
                                src="{{ $morePost->image ? asset('storage/' . $morePost->image) : asset('images/NoImage.jpg') }}"
                                alt="">
                        </a>
                    @endforeach
                </div>
                <p>Post you might like</p>
                <div class="flex gap-x-2">
                    @foreach ($randomPosts as $randomPost)
                        <a href="/posts/{{ $randomPost->id }}">
                            <img class="h-20 w-20 rounded-lg object-cover"
                                src="{{ $randomPost->image ? asset('storage/' . $randomPost->image) : asset('images/NoImage.jpg') }}"
                                alt="">
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="m-10 flex">
            <div class="w-3/5">
                <!-- like button and action button container -->
                <div class="flex justify-between">
                    <!-- like button and action button container -->
                    @if (Auth::check())
                        <div class="mt-3" x-data="likes({{ $like_id }}, {{ $post->id }}, {{ auth()->user()->id }})">
                            <form @submit.prevent="toggle">
                                @csrf
                                <div class="flex">
                                    <button type="submit">
                                        <img x-show="!like_id" class="h-8"
                                            src="{{ asset('images/Heart-Empty.png') }}" alt="">
                                        <img x-show="like_id" class="h-8" src="{{ asset('images/Heart-Fill.png') }}"
                                            alt="">
                                    </button>
                                    <span class="ml-3 self-center">Add to Bookmark</span>
                                </div>
                            </form>
                        </div>
                    @else
                        <div class="mt-3">
                            <a href="/login" class="px-4 py-1 rounded-md bg-white text-black">Likes</a>
                        </div>
                    @endif
                    <div x-data="{ open: false }" class="relative self-center" x-cloak>
                        <button @click="open = !open" class="focus:outline-none">
                            <img class="w-10" src="{{ asset('images/TripleDotAction.png') }}" alt="">
                        </button>
                        @if (Auth::check())
                            <ul x-show="open" @click.away="open = false"
                                class="absolute right-0 w-48 py-2 mt-2 bg-white rounded-lg shadow-xl">
                                @if (Auth::user()->id == $user->id)
                                    <li>
                                        <a href="/posts/{{ $post->id }}/edit"
                                            class="block px-4 py-2 text-gray-800 hover:bg-indigo-500 hover:text-white">Edit</a>
                                    </li>
                                    <li>
                                        <form method="POST" action="/posts/{{ $post->id }}"
                                            onsubmit="return confirm('Are you sure you want to delete this post?');">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                class="block px-4 py-2 text-gray-800 hover:bg-indigo-500 hover:text-white">
                                                Delete
                                            </button>
                                        </form>
                                    </li>
                                @elseif (Auth::user()->role === 'admin')
                                    <li>
                                        <form method="POST" action="/posts/{{ $post->id }}"
                                            onsubmit="return confirm('Are you sure you want to delete this post?');">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                class="block px-4 py-2 text-gray-800 hover:bg-indigo-500 hover:text-white">
                                                Delete
                                            </button>
                                        </form>
                                    </li>
                                @else
                                    <li>
                                        <div x-data="Object.assign(reports({{ $report_id }}, {{ $post->id }}, {{ auth()->user()->id }}), { toggle_popup: false })">
                                            <form @submit.prevent="toggle">
                                                @csrf
                                                <template x-if="!report_id">
                                                    <button type="button" x-on:click="toggle_popup = !toggle_popup"
                                                        id="report"
                                                        class="w-full
                                                    block px-4 py-2 text-gray-800 hover:bg-indigo-500 hover:text-white">
                                                        <span x-text="report_id ? 'Undo Report' : 'Report'"></span>
                                                    </button>
                                                </template>
                                                <template x-if="report_id">
                                                    <button type="submit" id="report"
                                                        class="w-full
                                                    block px-4 py-2 text-gray-800 hover:bg-indigo-500 hover:text-white">
                                                        <span x-text="report_id ? 'Undo Report' : 'Report'"></span>
                                                    </button>
                                                </template>

                                                <div x-cloak x-show="toggle_popup"
                                                    class="fixed inset-0 z-50 flex justify-center bg-black/70">
                                                    <div class="flex flex-col w-5/12 h-1/3 bg-white rounded-xl self-center p-8"
                                                        @click.outside="toggle_popup = !toggle_popup">
                                                        <span class="font-medium text-2xl">Detail of Report</span>
                                                        <select x-model="report_description"
                                                            class="border-2 border-orange-500 rounded-md text-lg mt-3"
                                                            id="">
                                                            <option value="Plagiarism" class="text-lg">Plagiarism
                                                            </option>
                                                            <option value="AI Image" class="text-lg">AI Image</option>
                                                            <option value="NSFW" class="text-lg">NSFW</option>
                                                        </select>
                                                        <button type="submit" @click="toggle_popup = !toggle_popup"
                                                            class="w-full h-8 rounded-full mt-5 bg-orange-500 text-white text-center">Send
                                                        </button>
                                                        <button type="button" @click="toggle_popup = !toggle_popup"
                                                            class="w-full h-8 rounded-full mt-2 bg-white border-2 border-orange-500 text-center">Cancel
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                    </li>
                                @endif
                            </ul>
                        @endif
                    </div>
                </div>

                <!-- post detail -->
                <div>
                    <p class="font-medium text-lg">{{ $post->title }}</p>
                    <a href="/users/{{ $user->id }}">
                        <div class="flex mx-1">
                            <div class="w-6 h-6 rounded-full overflow-hidden">
                                <img class="w-full h-full object-cover"
                                    src="{{ $user->user_profile ? asset('storage/' . $user->user_profile) : asset('/images/user.png') }}"
                                    alt="">
                            </div>
                            <p class="ml-2">{{ $user->username }}</p>
                        </div>
                    </a>
                </div>
                <!-- Display tags -->
                <div class="flex gap-2" x-data="tagList({{ json_encode($tags) }})" id="tag-list">
                    <template x-for="tag in tags" :key="tag.id">
                        <a class="bg-gray-200 rounded p-1 mr-2 my-2" :href="'/tags/' + tag.tag"
                            x-text="formatTag(tag.tag)"></a>
                    </template>
                </div>
                <!-- Add Tag -->
                @if (Auth::check() && (Auth::user()->id == $user->id || Auth::user()->role === 'admin'))
                    <div x-data="addTag({{ $post->id }})">
                        <form @submit.prevent="sendData">
                            @csrf
                            <div class="flex">
                                <button type="submit"><img src="{{ asset('images/Circle-Add.png') }}"
                                        class="h-5" alt=""></button>
                                <input class="border-hidden ml-3" placeholder="Add Tags" type="text"
                                    x-model="tag" required>
                            </div>
                        </form>
                        <div x-text="message"></div>
                    </div>
                @endif
                
                <!-- Comment Form -->
                @if (Auth::check())
                <div x-data="addComment({{ $post->id }})">
                    <form @submit.prevent="sendComment">
                        @csrf
                        <div class="flex justify-between items-center my-2">
                            <div class="w-8 h-8 rounded-full overflow-hidden">
                                <img class="w-full h-full object-cover" src="{{ Auth::user()->user_profile ? asset('storage/' . Auth::user()->user_profile) : asset('/images/user.png') }}" alt="">
                            </div>
                            <input x-model="comment" class="border p-1 w-4/5 rounded" type="text" placeholder="Leave a comment" required>
                            <button type="submit" class="bg-ardicture-orange text-white font-extrabold px-4 py-1 rounded-2xl">Send</button>
                        </div>
                    </form>
                    <div x-text="message" class="mt-2 text-green-500"></div>
                </div>
                @else
                <div class="mt-4">
                    <p class="font-medium">Comments</p>
                </div>
                @endif
                <!-- Comments Section -->
                <div x-data="commentList({{ json_encode($comments) }}, {{ Auth::check() ? Auth::id() : 'null' }}, {{ Auth::check() ? '\'' . Auth::user()->role . '\'' : '' }})" id="comment-list">
                    <template x-for="comment in comments" :key="comment.id">
                        <div class="flex my-2 mb-20">
                            <a :href="'/users/' + comment.user.id">
                                <div class="w-8 h-8 mt-1 mr-4 rounded-full overflow-hidden">
                                    <img class="w-full h-full object-cover" :src="comment.user.user_profile ? `/storage/${comment.user.user_profile}` : '/images/user.png'" :alt="comment.user.username">
                                </div>
                            </a>
                            <div>
                                <a :href="'/users/' + comment.user.id">
                                    <p class="font-medium" x-text="comment.user.username"></p>
                                </a>
                                <p x-show="!comment.editing" x-text="comment.comment"></p>
                                <input x-show="comment.editing" x-model="comment.editText" class="border p-1 rounded" type="text">
                                <p class="text-sm text-gray-500" x-text="new Date(comment.created_at).toLocaleDateString('en-US', { month: 'long', day: 'numeric' })"></p>
                            </div>
                            <div x-show="comment.editing" class="mt-7 ml-5">
                                <button @click="updateComment(comment)" class="text-sm px-2 py-1 text-green-500 hover:bg-green-500 hover:text-white rounded">Save</button>
                                <button @click="cancelEdit(comment)" class="text-sm px-2 py-1 text-red-500 hover:bg-red-500 hover:text-white rounded">Cancel</button>
                            </div>
                            @if (Auth::check())
                            <template x-if="comment.user.id === authUserId || authUserRole === 'admin'">
                                <div x-show="!comment.editing" x-data="{ open: false }" class="ml-auto mr-24 mt-4 relative">
                                    <button @click="open = !open" class="focus:outline-none">
                                        <img class="w-6" src="{{asset('images/TripleDotAction.png')}}" alt="">
                                    </button>
                                    <ul
                                        x-show="open"
                                        @click.away="open = false"
                                        class="absolute right-0 w-20 py-2 bg-white rounded-lg shadow-xl z-10"
                                    >
                                        <template x-if="comment.user.id === authUserId">
                                            <li>
                                                <button @click="editComment(comment); open = false"  class="block px-4 py-2 text-gray-800 hover:bg-indigo-500 hover:text-white">Edit</button>
                                            </li>
                                        </template>
                                        <template x-if="comment.user.id === authUserId || authUserRole === 'admin'">
                                            <li>
                                                <button @click="deleteComment(comment)" class="block px-4 py-2 text-gray-800 hover:bg-indigo-500 hover:text-white">Delete</button>
                                            </li>
                                        </template>
                                    </ul>
                                </div>
                            </template>
                            @endif
                        </div>
                    </template>
                </div>         

            </div>
            <div class="w-2/5">
            </div>
        </div>

        <x-footer />

        <script>
            function tagList(initialTags) {
                return {
                    tags: initialTags,
                    init() {
                        this.$el.addEventListener('tag-added', event => {
                            this.addTag(event.detail);
                        });
                    },
                    formatTag(tag) {
                        return tag.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
                    },
                    addTag(tag) {
                        this.tags.push(tag.tag);
                    }
                }
            }

            function addTag(postId) {
                return {
                    tag: '',
                    postId: postId,
                    message: '',
                    sendData() {
                        console.log('Sending data:', this.tag, this.postId);
                        fetch('/tags/store', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.head.querySelector('meta[name=csrf-token]').content
                                },
                                body: JSON.stringify({
                                    tag: this.tag,
                                    post_id: this.postId
                                })
                            })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error(`HTTP error! status: ${response.status}`);
                                }
                                return response.json();
                            })
                            .then(data => {
                                if (data.success) {
                                    this.tag = '';
                                    document.querySelector('#tag-list').dispatchEvent(new CustomEvent('tag-added', {
                                        detail: data
                                    }));
                                    this.message = data.message;
                                } else {
                                    this.message = data.message;
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                this.message = 'An error occurred.';
                            });
                    }
                }
            }

            function likes(like_id, post_id, user_id) {
                return {
                    like_id: like_id,
                    post_id: post_id,
                    user_id: user_id,
                    toggle() {
                        console.log('Sending data:', this.like_id, this.post_id, this.user_id);
                        fetch('/likes/toggle', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.head.querySelector('meta[name=csrf-token]').content
                                },
                                body: JSON.stringify({
                                    like_id: this.like_id,
                                    post_id: this.post_id,
                                    user_id: this.user_id,
                                })
                            })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error(`HTTP error! status: ${response.status}`)
                                }
                                return response.json()
                            })
                            .then(data => {
                                this.like_id = data.like_id
                            })
                            .catch(error => {
                                console.error('Error:', error)
                                this.message = 'An error occurred.'
                            });
                    }
                }
            }

            /*
            document.addEventListener('alpine:init', () => {

                Alpine.data('reports', (report_id, post_id, user_id) => ({
                    report_id,
                    post_id,
                    user_id,
                    message: '',
                    toggle() {
                        console.log('Sending data:', this.report_id, this.post_id, this.user_id);
                        fetch('/reports/toggle', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.head.querySelector('meta[name=csrf-token]')
                                        .content
                                },
                                body: JSON.stringify({
                                    report_id: this.report_id,
                                    post_id: this.post_id,
                                    user_id: this.user_id
                                })
                            })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error(`HTTP error! status: ${response.status}`);
                                }
                                return response.text(); // Get raw response text
                            })
                            .then(text => {
                                console.log(text); // Log raw response
                                return JSON.parse(text); // Parse the text as JSON
                            })
                            .then(data => {
                                this.report_id = data.report_id;
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                this.message = 'An error occurred.';
                            });
                    }
                }));
            });
            */


            function reports(report_id, post_id, user_id) {
                return {
                    report_id: report_id,
                    post_id: post_id,
                    user_id: user_id,
                    report_description: this.report_description,
                    toggle() {
                        console.log('Sending data:', this.report_id, this.post_id, this.user_id, this.report_description);
                        fetch('/reports/toggle', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.head.querySelector('meta[name=csrf-token]').content
                                },
                                body: JSON.stringify({
                                    report_id: this.report_id,
                                    post_id: this.post_id,
                                    user_id: this.user_id,
                                    report_description: this.report_description
                                })
                            })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error(`HTTP error! status: ${response.status}`);
                                }
                                return response.json();
                            })
                            .then(data => {
                                this.report_id = data.report_id;
                            })
                            .catch(error => {
                                console.error('Error:', error)
                                this.message = 'An error occurred.'
                            });
                    }
                }
            }

            function commentList(initialComments, authUserId, authUserRole, postId) {
                return {
                    comments: initialComments.map(comment => ({ ...comment, editing: false, editText: comment.comment, showReplyForm: false, replyText: '', replies: comment.replies || [] })),
                    authUserId: authUserId,
                    authUserRole: authUserRole,
                    postId: postId,
                    init() {
                        this.$el.addEventListener('comment-added', event => {
                            this.addComment(event.detail);
                        });
                        this.$el.addEventListener('reply-added', event => {
                            this.addReply(event.detail);
                        });
                    },
                    addComment(comment) {
                        this.comments.push({ ...comment.comment, editing: false, editText: comment.comment, showReplyForm: false, replyText: '', replies: [] });
                    },
                    // addReply(reply) {
                    //     const parentComment = this.comments.find(comment => comment.id === reply.comment.parent_id);
                    //     if (parentComment) {
                    //         parentComment.replies.push(reply);
                    //     }
                    // },
                    editComment(comment) {
                        comment.editing = true;
                        comment.editText = comment.comment;
                    },
                    cancelEdit(comment) {
                        comment.editing = false;
                        comment.editText = comment.comment;
                    },
                    updateComment(comment) {
                        fetch(`/comments/${comment.id}/update`, {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.head.querySelector('meta[name=csrf-token]').content
                            },
                            body: JSON.stringify({ comment: comment.editText })
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(`HTTP error! status: ${response.status}`);
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                comment.comment = comment.editText;
                                comment.editing = false;
                            } else {
                                console.error('Update failed:', data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                    },
                    deleteComment(comment) {
                        fetch(`/comments/${comment.id}/delete`, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.head.querySelector('meta[name=csrf-token]').content
                            },
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(`HTTP error! status: ${response.status}`);
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                this.comments = this.comments.filter(c => c.id !== comment.id);
                            } else {
                                console.error('Delete failed:', data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                    },
                    // sendReply(comment) {
                    //     console.log(comment.replyText, this.postId, comment.id);
                    //     fetch('/comments/store', {
                    //         method: 'POST',
                    //         headers: {
                    //             'Content-Type': 'application/json',
                    //             'X-CSRF-TOKEN': document.head.querySelector('meta[name=csrf-token]').content
                    //         },
                    //         body: JSON.stringify({ comment: comment.replyText, post_id: this.postId, parent_id: comment.id })
                    //     })
                    //     .then(response => {
                    //         // Log the raw response
                    //         console.log('Raw response:', response);
                    //         if (!response.ok) {
                    //             throw new Error(`HTTP error! status: ${response.status}`);
                    //         }
                    //         return response.json();
                    //     })
                    //     .then(data => {
                    //         if (data.success) {
                    //             comment.replyText = '';
                    //             this.$el.dispatchEvent(new CustomEvent('reply-added', { detail: data.reply }));
                    //         } else {
                    //             console.error('Reply failed:', data.message);
                    //         }
                    //     })
                    //     .catch(error => {
                    //         console.error('Error:', error);
                    //     });
                    // }
                }
            }

            function addComment(postId) {
                return {
                    comment: '',
                    postId: postId,
                    message: '',
                    sendComment() {
                        fetch('/comments/store', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.head.querySelector('meta[name=csrf-token]').content
                            },
                            body: JSON.stringify({ comment: this.comment, post_id: this.postId })
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(`HTTP error! status: ${response.status}`);
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                this.comment = '';
                                document.querySelector('#comment-list').dispatchEvent(new CustomEvent('comment-added', { detail: data }));
                                this.message = data.message;
                            } else {
                                this.message = data.message;
                            }
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
