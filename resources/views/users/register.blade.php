<x-layout>
    <div class="flex flex-col justify-center px-6 py-12 my-16 lg:px-8 mx-auto w-72 lg:w-96 bg-white rounded-lg">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <header>
                <img class="mx-auto h-16 w-auto " src="{{ asset('images/Ardicture-icon.png') }}" alt="">
            </header>
        </div>
        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form method="POST" action="/users" class="space-y-6">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium leading-6 text-gray-900 mb-2">
                        Name
                    </label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />

                    @error('name')
                        <p>{{ $message }}</p>
                    @enderror
                </div>

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

                <fieldset>
                    <div class="space-y-6">
                        <div class="relative flex gap-x-3">
                            <div class="flex h-6 items-center">
                                <input id="comments" name="comments" type="checkbox"
                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                            </div>
                            <div class="text-sm leading-6">
                                <label for="comments" class="font-medium text-gray-900">I agree to all Term and Privacy
                                    Policy</label>
                            </div>
                        </div>
                    </div>
                </fieldset>

                <div class="mt-6 p-3" style="background-color:darkorange;">
                    <button type="submit" class="text-white text-center w-full">
                        Sign Up
                    </button>
                </div>

                <div class="flex justify-center">
                    <p class="text-gray-500">
                        Already have an account?
                        <a href="/login" class="text-blue-500">Login</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</x-layout>
