<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validate the user's input
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Attempt to log in the user
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Redirect the authenticated user to their dashboard or homepage
            return redirect()->route('posts.index');
        }

        // If login fails, redirect back with an error message
        return redirect()->back()->withInput()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function showRegistrationForm()
    {
        $roles = Role::all();
        return view('auth.register', compact('roles'));
    }

    public function register(Request $request)
    {
        // Validate the user's input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|exists:roles,id', // Ensure selected role exists in the roles table
        ]);

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Assign the selected role to the user
        $user->roles()->attach($request->role);

        // Log in the user
        Auth::login($user);

        // Redirect the user to their dashboard or homepage
        return redirect()->route('posts.index');
    }
}
