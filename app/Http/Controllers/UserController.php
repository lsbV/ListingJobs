<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Show registration form
    public function create()
    {
        return view('users.register');
    }

    // Create a new user
    public function store()
    {
        // Validate the form
        $attributes = request()->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:6', 'confirmed', 'max:255'],
        ]);

        // Create and save the user
        $user = User::create($attributes);

        // Sign the user in
        auth()->login($user);

        // Redirect to the home page
        return redirect('/')->with('success', 'Your account has been created.');
    }

    public function logout()
    {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/')->with('success', 'Goodbye!');
    }

    public function login()
    {
        return view('users.login');
    }

    public function signin()
    {
        $attributes = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!auth()->attempt($attributes)) {
            return back()->withErrors(['error'=> 'Your email or password is incorrect.']);
        }
        request()->session()->regenerate();
        return redirect('/')->with('success', 'Welcome back!');
    }
}
