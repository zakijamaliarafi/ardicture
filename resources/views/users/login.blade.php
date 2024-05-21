<x-layout>
    <div>
        <header>
            <img src="" alt="">
        </header>
        <form method="POST" action="/users/authenticate">
            @csrf
            <div>
                <label 
                    for="username"
                >
                    Username
                </label>
                <input 
                    type="text"
                    id="username" 
                    name="username" 
                    value="{{old('username')}}"
                />
                
                @error('username')
                    <p>{{$message}}</p>    
                @enderror
            </div>

            <div>
                <label 
                    for="password"
                >
                    Password
                </label>
                <input 
                    type="password"
                    id="password" 
                    name="password" 
                    value="{{old('password')}}"
                />
                
                @error('password')
                    <p>{{$message}}</p>    
                @enderror
            </div>

            <div>
                <button
                    type="submit"
                >
                    Login
                </button>
            </div>

            <div>
                <p>
                    Don't have an account?
                    <a href="/register"
                        >Sign Up</a
                    >
                </p>
            </div>
        </form>
    </div>
</x-layout>