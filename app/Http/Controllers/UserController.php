<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\UserLikedPost;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // Show Register/Create Form
    public function create() {
        return view('users.register');
    }

    // Create New User
    public function store(Request $request) {
        $formFields = $request->validate([
            'name' => ['required', 'min:4'],
            'username' => ['required','alpha_num', Rule::unique('users', 'username')],
            'password' => ['required', 'min:8']
        ]);

        // Hash Password
        $formFields['password'] = bcrypt($formFields['password']);

        // Add Role
        $formFields['role'] = 'user';

        // Create User
        $user = User::create($formFields);

        // Login
        Auth::login($user, $remember = true);

        return redirect('/')->with('message', 'User created and logged in');
    }

    // Logout User
    public function logout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out!');
    }

    // Show Login Form
    public function login() {
        return view('users.login');
    }

    // Authenticate User
    public function authenticate(Request $request) {
        $formFields = $request->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);

        if(auth()->attempt($formFields, $remember = true)) {
            $request->session()->regenerate();

            return redirect('/')->with('message', 'You are now logged in!');
        }

        return back()->withErrors(['username' => 'Invalid Credentials'])->onlyInput('username');
    }

    // Profile User
    public function profile($userId = null) {

        if ($userId === null) {
            $userId = auth()->id();
        }

        $user = User::find($userId);

        if ($user === null) {
            abort(404);
        }

        $postCount = Post::countPostsByUserId($userId);
        $likedPostCount = UserLikedPost::countLikedPostsByUserId($userId);
        $userPosts = Post::getPostsByUserId($userId);
        return view('users.profile', [
            'user' => $user, 
            'postCount' => $postCount,
            'likedPostCount' => $likedPostCount,
            'userPosts' => $userPosts,
    ]);
    }

    // Show Edit Form
    public function edit() {
        $user = Auth::user();
        return view('users.edit', ['user' => $user]);
    }

    // Update User Data
    public function update(Request $request) {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $formFields = $request->validate([
            'name' => 'required',
            'user_profile' => 'mimes:jpeg,png,bmp,tiff |max:4096',
        ],

        $messages = [
            'mimes' => 'Only jpeg, png, bmp,tiff are allowed.'
        ]);

        $formFields['user_description'] = $request->input('user_description');

        if($request->hasFile('user_profile')) {
            if(is_null($user->user_profile)){
                $formFields['user_profile'] = $request->file('user_profile')->store('profiles', 'public');
            } else {
                Storage::disk('public')->delete($user->user_profile);
                $formFields['user_profile'] = $request->file('user_profile')->store('profiles', 'public');
            }
        }

        $user->update($formFields);

        return redirect('/profile')->with('message', 'Profile updated successfully!');
    }
}
