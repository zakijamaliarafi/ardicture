<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ardicture</title>
</head>
<body>
    <nav>
        <a href="/"></a>
    <ul>
        <li>
            <a href="/">Home</a>
        </li>
        @if(Auth::check() && Auth::user()->role === 'admin')
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
        @endif
    </ul>
    </nav>

    <main>
        {{$slot}}
    </main>

    <footer>
        
    </footer>
</body>
</html>