<x-layout>
    <form method="POST" action="/profile/update" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div>
            <label for="user_profile">
                Profile
            </label>
            <input
                type="file"
                name="user_profile"
            />

            <img
                class="h-10"
                src="{{$user->user_profile ? asset('storage/' . $user->user_profile) : asset('/images/user.png')}}"
                alt=""
            />

            @error('user_profile')
                <p>{{$message}}</p>
            @enderror
        </div>

        <div>
            <label
                for="name">
            Name: 
            </label>
            <input
                type="text"
                name="name"
                value="{{$user->name}}"
            />

            @error('name')
                <p>{{$message}}</p>
            @enderror
        </div>

        <div class="flex">
            <label for="user_description">
                Description :
            </label>
            <textarea
                name="user_description"
                rows="10"
            >{{$user->user_description}}</textarea>

            @error('user_description')
                <p >{{$message}}</p>
            @enderror
        </div>

        <div>
            <button class="bg-slate-500">
                Update Profile
            </button>

            <a href="/profile"> Back </a>
        </div>
    </form>
</x-layout>