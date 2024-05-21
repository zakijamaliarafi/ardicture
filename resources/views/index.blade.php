<x-layout>
    <div class="flex min-h-full flex-col justify-center px-6 pt-12 pb-6 mt-16 lg:px-8 mx-auto w-1/4 bg-white rounded-lg">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <header>
                <img class="mx-auto h-16 w-auto " src="{{ asset('images/Ardicture-icon.png') }}" alt="">
            </header>
        </div>
        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <div class="mt-6 p-3 rounded-lg" style="background-color:darkorange;">
                <a href="/login">
                    <button class="text-white text-center w-full">
                        Login
                    </button>
                </a>
            </div>

            <div class="flex justify-around items-center mt-2">
                <div class="bg-black h-px w-1/2"></div>
                <div class="flex justify-center items-center">
                    <p>OR</p>
                </div>
                <div class="bg-black h-px w-1/2"></div>
            </div>

            <div class="mt-3 p-3 rounded-lg" style="background-color:black;">
                <a href="/register">
                    <button class="text-white text-center w-full">
                        Register
                    </button>
                </a>
            </div>

            <p class="mt-6 text-center text-gray-400">Terms and Privacy Policy Applies</p>

        </div>
    </div>
</x-layout>
