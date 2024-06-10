<x-layout>
    <div class="ml-5 mt-5">
        <form method="POST" action="/profile/update" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div x-data="user_profile_handler({{ auth()->user()->id }}, {{ $user_profile }})">
                <label for="user_profile">
                    <template x-if="user_profile">

                        <img :src="user_profile" alt="Preview Image" class="h-full mx-auto">

                    </template>
                    <img class="h-10"
                        src="{{ $user->user_profile ? asset('storage/' . $user->user_profile) : asset('/images/user.png') }}"
                        alt="" />
                </label>
                <input type="file" name="user_profile" hidden id="user_profile" />



                @error('user_profile')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="name">
                    Name:
                </label>
                <input type="text" name="name" value="{{ $user->name }}" />

                @error('name')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <div class="flex">
                <label for="user_description">
                    Description :
                </label>
                <textarea name="user_description" rows="10">{{ $user->user_description }}</textarea>

                @error('user_description')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <div>
                <button class="bg-slate-500">
                    Update Profile
                </button>

                <a href="/profile"> Back </a>
            </div>
        </form>
    </div>

    <x-footer />

    <script>
        document.addEventListener('alpine:init', () => {
            console.log('Alpine.js initialized');

            Alpine.data('user_profile_handler', (user_id, user_profile) => ({
                user_id: user_id,
                user_profile: '',
                init() {
                    console.log('preview_handler initialized');
                },
                user_profile_preview(event) {
                    this.user_profile = '';
                    const files = event.target.files;
                    if (files) {

                        let reader = new FileReader();
                        reader.onload = (e) => {
                            this.user_profile.push(e.target.result);
                        }
                        reader.readAsDataURL(files);

                        document.getElementById('preview_placeholder').style.display = 'none';
                        document.getElementById('image_container').classList.add('flex');
                        document.getElementById('preview_image').classList.add('h-full');
                        this.image.style.display = 'flex'
                    }
                }
            }));

        });
    </script>
</x-layout>
