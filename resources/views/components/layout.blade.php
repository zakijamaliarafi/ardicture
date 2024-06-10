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
        </div>
    </nav>

    <main>
        {{$slot}}
    </main>

    <footer>
        <div class="flex mt-24 py-12 border-t-4">
                <div class="ml-12 text-sm font-medium">
                    <img class="h-20 mb-0.5" src="{{asset('images/Ardicture-logo.png')}}" alt="">
                    <p>Show Your Creativity, Preserve Your</p>
                    <p>Moments, One Frame and Canva at</p>
                    <p>a Time.</p>
                    <p class="text-sm font-normal mt-0.5">Ardicture, 2024</p>
                </div>
                <div class="ml-auto mr-12 mt-4 flex gap-5">
                    <div>
                        <p class="text-sm font-medium mb-1">Contact</p>
                        <div class="flex items-center gap-2 mb-0.5">
                            <img class="h-4" src="{{asset('images/Email.png')}}" alt="">
                            <p class="text-sm font-normal">support@ardicture.id</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <img class="h-4" src="{{asset('images/Phone.png')}}" alt="">
                            <p class="text-sm font-normal">+62 851-5543-3460</p>
                        </div>
                    </div>
                    <div>
                        <p class="text-sm font-medium mb-1">Support</p>
                        <p class="text-sm font-normal mb-0.5">Feedback</p>
                        <p class="text-sm font-normal">Help Center (FAQ)</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium mb-1">Legal</p>
                        <p class="text-sm font-normal mb-0.5">Terms of Service</p>
                        <p class="text-sm font-normal">Privacy Policy</p>
                    </div>
                </div>
                
            </div>
        </div>
    </footer>
</body>
</html>