<x-layout>
    <div class="flex h-90 flex-col justify-center my-16 mx-auto w-72 lg:w-96 p-6 bg-white rounded-lg">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <header>
                <img class="mx-auto h-16 w-auto " src="{{ asset('images/Ardicture-icon.png') }}" alt="">
            </header>
        </div>
        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form method="POST" action="/users/authenticate" class="space-y-6">
                @csrf

                <div>
                    <label for="username" class="block text-sm font-medium leading-6 text-gray-900 mb-2">
                        Username
                    </label>
                    <input type="text" id="username" name="username" value="{{ old('username') }}"
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />

                    @error('username')
                        <p>{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium leading-6 text-gray-900 mb-2">
                        Password
                    </label>
                    <input type="password" id="password" name="password" value="{{ old('password') }}"
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />

                    @error('password')
                        <p>{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-6 p-3" style="background-color:darkorange;">
                    <button type="submit" class="text-white text-center w-full">
                        Login
                    </button>
                </div>

                <div class="flex justify-center">
                    <p class="text-gray-500">
                        Don't have an account?
                        <a href="/register" class="text-blue-500">Sign Up</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</x-layout>
