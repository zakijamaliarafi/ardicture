<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @vite('resources/css/app.css')
    @vite(['resources/js/app.js'])
    <title>Ardicture</title>

</head>

<body
    @if (request()->is('login') || request()->is('register')) style="background-image: url({{ asset('images/Background.jpg') }});" class="bg-center bg-cover bg-fixed" @endif>

    <nav class="bg-white h-16 flex items-center py-4 fixed w-full z-50">
        <button onclick="sidebar()" class="w-24">
            <img src="{{ asset('images/SideBarAction.png') }}" alt="Sidebar Action" class="h-6 mx-auto my-5">
        </button>
        <div class="w-72">
            <a href="/" class="flex items-center ml-6">
                <img class="h-10 mr-2" src="{{ asset('images/Ardicture-icon.png') }}" alt="Ardicture Logo">
                <span class="text-xl font-bold">Ardicture</span>
            </a>
        </div>

        <div class="flex">
            <a href="/search" class="mx-2">Search</a>
            <a href="/about" class="mx-2">About</a>
        </div>
        <div class="flex w-full justify-end">
            @if (Auth::check())
                <a href="/profile" class="flex mx-2">
                    <img class="h-8 mr-1"
                        src="{{ Auth::user()->user_profile ? asset('storage/' . Auth::user()->user_profile) : asset('/images/user.png') }}"
                        alt="User Profile">
                    <span class="mt-1">{{ Auth::user()->username }}</span>
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
        <div id="sidebar"
            class="@if (request()->is('login') || request()->is('register')) ml-[-4rem] @endif bg-slate-400 duration-150 w-16 h-screen mt-16 overflow-hidden fixed">
            <div class="w-72 bg-red-100 flex pt-6 h-16">
                <div class="w-16 flex justify-center items-center">
                    <div class="w-14 content-center">
                        <a class="" href="/">
                            <img src="{{ asset('images/House-Icon.png') }}" alt="Sidebar Action" class="h-6 mx-auto">
                        </a>
                    </div>

                    @if (url()->current() == url('/'))
                        <div id="closed_indicator" class="ml-1 w-1 bg-orange-500 h-10">
                        </div>
                    @endif
                </div>
                <div class="w-48">
                    <a href="/">
                        <p class="font-sans text-xl text-left ml-4">Home</p>
                    </a>
                </div>
                @if (url()->current() == url('/'))
                    <div class="bg-orange-500 ml-6 h-100 w-1 mb-2">
                    </div>
                    <div class="w-6">
                    </div>
                @endif

            </div>
            <div class="w-72 bg-red-100 flex pt-6 h-16">
                <div class="w-16 flex justify-center items-center">
                    <div class="w-14 content-center">
                        <a class="" href="/">
                            <img src="{{ asset('images/Bookmark.png') }}" alt="Sidebar Action" class="h-6 mx-auto">
                        </a>
                    </div>

                    @if (url()->current() == url('/favorites'))
                        <div id="closed_indicator" class="ml-1 w-1 bg-orange-500 h-10">
                        </div>
                    @endif
                </div>
                <div class="w-48">
                    <p class="font-sans text-xl text-left ml-4">Favorites</p>
                </div>
                @if (url()->current() == '/favorites')
                    <div class="bg-orange-500 ml-6 h-100 w-1 mb-2">
                    </div>
                    <div class="w-6">
                    </div>
                @endif
            </div>
            <div class="w-72 bg-red-100 flex pt-6 h-16">
                <div class="w-16 flex justify-center items-center">
                    <div class="w-14 content-center">
                        <a class="" href="/posts/create">
                            <img src="{{ asset('images/Circle-Add.png') }}" alt="Sidebar Action" class="h-6 mx-auto">
                        </a>
                    </div>

                    @if (url()->current() == url('/posts/create'))
                        <div id="closed_indicator" class="ml-1 w-1 bg-orange-500 h-10">
                        </div>
                    @endif
                </div>
                <div class="w-48">
                    <a href="/posts/create">
                        <p class="font-sans text-xl text-left ml-4">Upload</p>
                    </a>
                </div>
                @if (url()->current() == url('/posts/create'))
                    <div class="bg-orange-500 ml-6 h-100 w-1 mb-2">
                    </div>
                    <div class="w-6">
                    </div>
                @endif
            </div>
            <div class="w-72 bg-red-100 flex pt-6 h-16">
                <div class="w-16 flex justify-center items-center">
                    <div class="w-14 content-center">
                        <a class="" href="/profile">
                            <img src="{{ asset('images/Profile.png') }}" alt="Sidebar Action" class="h-6 mx-auto">
                        </a>
                    </div>

                    @if (url()->current() == url('/profile'))
                        <div id="closed_indicator" class="ml-1 w-1 bg-orange-500 h-10">
                        </div>
                    @endif
                </div>
                <div class="w-48">
                    <a href="/profile">
                        <p class="font-sans text-xl text-left ml-4">Profile</p>
                    </a>
                </div>
                @if (url()->current() == url('/profile'))
                    <div class="bg-orange-500 ml-6 h-100 w-1 mb-2">
                    </div>
                    <div class="w-6">
                    </div>
                @endif
            </div>
        </div>
        <div class="mt-16 @if (!request()->is('login') && !request()->is('register') && !request()->is('/')) ml-16 @endif w-full">
            {{ $slot }}
        </div>
    </main>


    <footer>

    </footer>
</body>
<script>
    function sidebar() {
        var indicator = document.getElementById('closed_indicator');
        var sidebar = document.getElementById('sidebar');
        if (sidebar.classList.contains('w-16')) {
            sidebar.classList.toggle('w-16');
            sidebar.classList.toggle('w-72');
            indicator.hidden = !indicator.hidden;
        } else {
            sidebar.classList.toggle('w-72');
            sidebar.classList.toggle('w-16');
            indicator.hidden = !indicator.hidden;
        }
    }
</script>

</html>
