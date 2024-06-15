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
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body
    @if (request()->is('login') || request()->is('register')) style="background-image: url({{ asset('images/Background.jpg') }});" class="bg-center bg-cover bg-fixed" @endif>
    <!------------------------------ Navbar---------------------- -->
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
            <a href="/" class="mx-2">Search</a>
            <a href="/about" class="mx-2">About</a>
        </div>
        <div class="flex w-full justify-end">
            @if (Auth::check())
                <a href="/profile" class="flex mx-2">
                    <div class="w-8 h-8 mr-2 rounded-full overflow-hidden">
                        <img class="w-full h-full object-cover"
                            src="{{ Auth::user()->user_profile ? asset('storage/' . Auth::user()->user_profile) : asset('/images/user.png') }}"
                            alt="">
                    </div>
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
    <main id="content" class="flex h-screen" x-data="{ activeTab: 'posts' }" x-cloak>
        <!------------------------------ Sidebar ------------------------------------>
        <div id="sidebar"
            class="z-50 @if (request()->is('login') || request()->is('register')) ml-[-4rem] @endif bg-white duration-150 w-16 h-screen mt-16 overflow-hidden fixed">
            <!------------Container Semua Konten Sidebar--------------------->
            <div class="w-72 bg-white flex pt-6 h-16">
                <!------------Container Satu Row Sidebar--------------------->
                <!------------------------- HOME ------------------------->
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
            <!------------------------- BOOKMARK------------------------->
            <div class="w-72 bg-white flex pt-6 h-16" @click="activeTab = 'liked'">
                <div class="w-16 flex justify-center items-center">
                    <div class="w-14 content-center">
                        <a class="" href="/profile/1">
                            <img src="{{ asset('images/Bookmark.png') }}" alt="Sidebar Action" class="h-6 mx-auto">
                        </a>
                    </div>

                    @if ((url()->current() == url('/profile/1')) | (url()->current() == '/profile'))
                        <div id="closed_indicator" class="ml-1 w-1 bg-orange-500 h-10">
                        </div>
                    @endif
                </div>
                <div class="w-48">
                    <p class="font-sans text-xl text-left ml-4">Favorites</p>
                </div>
                @if ((url()->current() == '/profile/1') | (url()->current() == '/profile'))
                    <div x-show="activeTab === 'posts'">
                        <div class="bg-orange-500 ml-6 h-100 w-1 mb-2">
                        </div>
                        <div class="w-6">
                        </div>
                    </div>
                @endif
            </div>
            <!------------------------- CREATE POST ------------------------->
            <div class="w-72 bg-white flex pt-6 h-16">
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
            <!------------------------- PROFILE ------------------------->
            <div class="w-72 bg-white flex pt-6 h-16">
                <div class="w-16 flex justify-center items-center">
                    <div class="w-14 content-center">
                        <a class="" href="/profile">
                            <img src="{{ asset('images/Profile.png') }}" alt="Sidebar Action" class="h-6 mx-auto">
                        </a>
                    </div>

                    @if ((url()->current() == url('/profile')) | (url()->current() == '/profile/1'))
                        <div x-show="activeTab === 'posts'" id="profile_closed_indicator"
                            class="ml-1 w-1 bg-orange-500 h-10">
                        </div>
                    @endif
                </div>
                <div class="w-48">
                    <a href="/profile/">
                        <p class="font-sans text-xl text-left ml-4">Profile</p>
                    </a>
                </div>
                @if ((url()->current() == url('/profile')) | (url()->current() == '/profile/1'))
                    <div x-show="activeTab === 'posts'" id="profile_open_indicator">
                        <div class="bg-orange-500 ml-6 h-100 w-1 mb-2">
                        </div>
                        <div class="w-6">
                        </div>
                    </div>
                @endif
            </div>
            <!------------------------- Reports ------------------------->
            @if (Auth::check() && Auth::user()->role == 'admin')
                <div class="w-72 bg-white flex pt-6 h-16">
                    <div class="w-16 flex justify-center items-center">
                        <div class="w-14 content-center">
                            <a class="" href="/reports">
                                <img src="{{ asset('images/Reports.png') }}" alt="Sidebar Action"
                                    class="h-6 mx-auto">
                            </a>
                        </div>

                        @if (url()->current() == url('/reports'))
                            <div id="closed_indicator" class="ml-1 w-1 bg-orange-500 h-10">
                            </div>
                        @endif
                    </div>
                    <div class="w-48">
                        <a href="/profile">
                            <p class="font-sans text-xl text-left ml-4">Reports</p>
                        </a>
                    </div>
                    @if (url()->current() == url('/reports'))
                        <div class="bg-orange-500 ml-6 h-100 w-1 mb-2">
                        </div>
                        <div class="w-6">
                        </div>
                    @endif
                </div>
            @endif
        </div>
        <div class="mt-16 @if (!request()->is('login') && !request()->is('register') && !request()->is('/')) ml-16 @endif w-full">
            {{ $slot }}
        </div>
    </main>
    <x-flash-message />
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
