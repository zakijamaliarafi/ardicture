<x-layout>
    <div>
        <header>
            <img src="" alt="">
        </header>
        <form method="POST" action="/users">
            @csrf
            <div>
                <label 
                    for="name"
                >
                    Name
                </label>
                <input 
                    type="text"
                    id="name" 
                    name="name" 
                    value="{{old('name')}}"
                />
                
                @error('name')
                    <p>{{$message}}</p>    
                @enderror
            </div>

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
                    Sign Up
                </button>
            </div>

            <div>
                <p>
                    Already have an account?
                    <a href="/login"
                        >Login</a
                    >
                </p>
            </div>
        </form>
    </div>
</x-layout>