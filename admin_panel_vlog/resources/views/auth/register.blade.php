@extends('layouts.app')

@section('content')
    <h2>Register</h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <label for="name">Name</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
        </div>

        <div>
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required>
        </div>

        <div>
            <label for="password">Password</label>
            <input id="password" type="password" name="password" required autocomplete="new-password">
        </div>

        <div>
            <label for="password-confirm">Confirm Password</label>
            <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password">
        </div>

        <div>
            <label for="role">Role</label>
            <select id="role" name="role" required>
                <option value="" disabled selected>Select Role</option>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <button type="submit">Register</button>
        </div>
    </form>
@endsection
