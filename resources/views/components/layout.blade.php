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

    <nav class="bg-white h-16 flex items-center py-4 fixed">
        <button onclick="toggle()" class="w-16 place-self-center">
            <img src="{{ asset('images/SideBarAction.png') }}" alt="Sidebar Action" class="h-6 mx-auto my-5">
        </button>
        <a href="/" class="flex items-center ml-6">
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
    <main id="content" class="flex h-screen">
        <div id="sidebar" class="bg-slate-400 duration-300 w-16 h-screen mt-16 overflow-hidden fixed">
            <div class="w-72 bg-red-100 flex py-6">
                <div class="w-16">
                    <img src="{{ asset('images/SideBarAction.png') }}" alt="Sidebar Action" class="h-6 mx-auto">
                </div>
                <div class="w-48">
                    <img src="{{ asset('images/Ardicture-icon.png') }}" alt="Sidebar Action" class="h-6 mx-auto">
                </div>
            </div>
            <div class="w-72 bg-red-100 flex py-6">
                <div class="w-16">
                    <img src="{{ asset('images/SideBarAction.png') }}" alt="Sidebar Action" class="h-6 mx-auto">
                </div>
                <div class="w-48">
                    <img src="{{ asset('images/Ardicture-icon.png') }}" alt="Sidebar Action" class="h-6 mx-auto">
                </div>
            </div>
            <div class="w-72 bg-red-100 flex py-6">
                <div class="w-16">
                    <img src="{{ asset('images/SideBarAction.png') }}" alt="Sidebar Action" class="h-6 mx-auto">
                </div>
                <div class="w-48">
                    <img src="{{ asset('images/Ardicture-icon.png') }}" alt="Sidebar Action" class="h-6 mx-auto">
                </div>
            </div>
        </div>
        <div class="ml-16">{{ $slot }}</div>
    </main>


    <footer>

    </footer>
</body>
<script>
    function toggle() {
        var sidebar = document.getElementById('sidebar');
        if (sidebar.classList.contains('w-16')) {
            sidebar.classList.toggle('w-16');
            sidebar.classList.toggle('w-72');
        } else {
            sidebar.classList.toggle('w-72');
            sidebar.classList.toggle('w-16');
        }
    }
</script>

</html>
