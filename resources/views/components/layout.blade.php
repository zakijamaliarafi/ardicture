<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Ardicture</title>

</head>

<body @if (request()->is('login') || request()->is('register') || request()->is('/')) style="background-image: url({{ asset('images/Background.jpg') }});" @endif
    class="bg-center bg-cover">
    <div class="">
        <div
            class="bg-white  fixed w-16 h-12 justify-between items-center text-center transition-width duration-300 flex-col">
            <div class="h-16">
                <button onclick="toggle()" class="">
                    <img class="h-6 mx-auto my-5" src="{{ asset('images/SideBarAction.png') }}" alt="Sidebar Action">
                </button>
            </div>
            <div id="sidebar" class="transition-all duration-300">
                <img class="h-6 mx-auto mt-5 mb-8" src="{{ asset('images/SideBarAction.png') }}" alt="Sidebar Action">
                <img class="h-6 mx-auto mt-5 mb-8" src="{{ asset('images/SideBarAction.png') }}" alt="Sidebar Action">
                <img class="h-6 mx-auto mt-5 mb-8" src="{{ asset('images/SideBarAction.png') }}" alt="Sidebar Action">
            </div>

        </div>
        <div class=""> <!-- Adjusted margin-left -->
            <nav class="bg-white h-16 flex justify-between items-center px-4 ms-16">
                <a href="/" class="flex items-center">
                    <img class="h-10 mr-2" src="{{ asset('images/Ardicture-icon.png') }}" alt="Ardicture Logo">
                    <span class="text-xl font-bold">Ardicture</span>
                </a>
                <div class="flex items-center">
                    <a href="/search" class="mx-2">Search</a>
                    <a href="/about" class="mx-2">About</a>
                    @if (Auth::check())
                        <a href="/profile" class="flex mx-2">
                            <img class="h-8 mr-1"
                                src="{{ Auth::user()->user_profile ? asset('storage/' . Auth::user()->user_profile) : asset('/images/user.png') }}"
                                alt="User Profile">
                            <span>{{ Auth::user()->username }}</span>
                        </a>
                        <form method="POST" action="/logout" class="mx-2">
                            @csrf
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">Logout</button>
                        </form>
                    @else
                        <a href="/login" class="mx-2">Login</a>
                        <a href="/register" class="mx-2">Sign Up</a>
                    @endif
                </div>
            </nav>
            <main id="content" class="ms-14">
                {{ $slot }}
            </main>
        </div>
    </div>

    <footer>

    </footer>
</body>
<script>
    function toggle() {
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');
        if (sidebar.classList.contains('hidden')) {
            sidebar.classList.remove('hidden');
            sidebar.classList.add('block');
            content.classList.add('ms-14');
        } else {
            sidebar.classList.remove('block');
            sidebar.classList.add('hidden');
            content.classList.remove('ms-14');
        }
    }
</script>

</html>
