@extends('layouts.app')

@section('content')

    <div class="login-container">
        <h2>Login</h2>

        <form class="login-form" method="POST" action="{{ route('login') }}">
            @csrf
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
            <label for="password">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password">
            <button type="submit">Login</button>
        </form>

        <p>Don't have an account? <a href="{{ route('register') }}">Register here</a></p>
    </div>
@endsection
