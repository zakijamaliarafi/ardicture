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
<body>
    <nav class="bg-white h-16 flex justify-between items-center">
        <div class="flex">
            <div class="flex">
                <img class="h-6 my-auto mx-8" src="{{asset('images/SideBarAction.png')}}" alt="">
            </div>
            <a href="/">
                <img class="h-10" src="{{asset('images/Ardicture-icon.png')}}" alt="">
                <img src="" alt="">
            </a>
            <a class="my-auto mx-2" href="/search">Search</a>
            <a class="my-auto mx-2" href="/about">About</a>
        </div>
        <div class="flex">
            @if(Auth::check())
            <a class="flex" href="/profile">
                <div class="w-6 h-6 rounded-full overflow-hidden">
                    <img class="w-full h-full object-cover" src="{{Auth::user()->user_profile ? asset('storage/' . Auth::user()->user_profile) : asset('/images/user.png')}}" alt="">
                </div>
                <p class="my-auto mx-2">{{Auth::user()->username}}</p>
            </a>
            <div class="my-auto mx-2">
                <form method="POST" action="/logout">
                    @csrf
                    <button type="submit">
                        <i></i>Logout
                    </button>
                </form>
            </div>
            @else
            <a class="my-auto mx-2" href="/login">Login</a>
            <a class="my-auto mx-2" href="/register">Sign Up</a>
            @endif
            {{-- @if(Auth::check() && Auth::user()->role === 'admin')
            <li>
                <a href="/dashboard">Dashboard</a>
            </li>
            <li>
                <a href="/profile">Profile</a>
            </li>
            <li>
                <form method="POST" action="/logout">
                    @csrf
                    <button type="submit">
                        <i></i>Logout
                    </button>
                </form>
            </li>
            @elseif(Auth::check() && Auth::user()->role === 'user')
            <li>
                <a href="/profile">Profile</a>
            </li>
            <li>
                <form method="POST" action="/logout">
                    @csrf
                    <button type="submit">
                        <i></i>Logout
                    </button>
                </form>
            </li>
            @else
            <li>
                <a href="/login">Login</a>
            </li>
            <li>
                <a href="/register">Sign Up</a>
            </li>
            @endif --}}
        </div>
    </nav>

    <main>
        {{$slot}}
    </main>

    <footer>
        
    </footer>
</body>
</html>