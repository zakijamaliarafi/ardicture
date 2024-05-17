<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

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
            'username' => ['required', Rule::unique('users', 'username')],
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

        return redirect('/');
    }

    // Logout User
    public function logout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
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

            return redirect('/');
        }

        return back()->withErrors(['username' => 'Invalid Credentials'])->onlyInput('username');
    }

    // Profile User
    public function profile() {
        return view('users.profile');
    }
}
