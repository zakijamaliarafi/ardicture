<x-layout>
    <div class="ml-6 mt-6 mb-32">
        <h1 class="font-medium text-3xl">Edit Profile</h1>
        <form method="POST" action="/profile/update" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mt-6 w-40 h-40 rounded-full overflow-hidden" x-data="user_profile_handler({{ auth()->user()->id }})">
                <label for="user_profile">
                    <template x-if="user_profile_image">
                        <img :src="user_profile_image" alt="Preview Image" class="mx-auto w-full h-full object-cover">
                    </template>
                    <template x-if="!user_profile_image">
                        <img class="w-full h-full object-cover"
                            src="{{ $user->user_profile ? asset('storage/' . $user->user_profile) : asset('/images/user.png') }}"
                            alt="Current Profile Image" />
                    </template>
                </label>
                <input type="file" name="user_profile" hidden id="user_profile" @change="preview_profile_image" />
                <p class="mt-2 mb-2 text-black/30 text-xs absolute">Click profile to change image. Max size 4MB</p>


                @error('user_profile')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <div class=" mt-8 mb-3 flex flex-col">
                <label for="name" class="form-label font-medium text-3xl">Name</label>
                <input class="form-control w-5/12 mt-2" type="text" name="name" value="{{ $user->name }}" />

                @error('name')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-6 mb-3 flex flex-col">
                <label for="user_description" class="form-label font-medium text-3xl">Description</label>
                <textarea class="form-control w-5/12 mt-2" name="user_description" rows="5">{{ $user->user_description }}</textarea>

                @error('user_description')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary bg-orange-500 text-white p-2 rounded-lg">Update
                Profile</button>
            <button type="button" @click="history.back()"
                class="btn btn-primary bg-white border-2 border-orange-500 p-2 rounded-lg">Cancel</button>
        </form>
    </div>

    <x-footer />

    <script>
        document.addEventListener('alpine:init', () => {
            console.log('Alpine.js initialized');

            Alpine.data('user_profile_handler', (user_id) => ({
                user_id: user_id,
                user_profile_image: '',
                preview_profile_image(event) {
                    const files = event.target.files;
                    if (files && files[0]) {
                        let reader = new FileReader();
                        reader.onload = (e) => {
                            this.user_profile_image = e.target.result;
                        }
                        reader.readAsDataURL(files[0]);
                    }
                }
            }));

        });
    </script>
</x-layout>
