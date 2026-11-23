@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <h2>Register</h2>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <label>Nama
            <input type="text" name="name" value="{{ old('name') }}" required>
        </label>
        <label>Email
            <input type="email" name="email" value="{{ old('email') }}" required>
        </label>
        <label>Password
            <input type="password" name="password" required>
        </label>
        <label>Konfirmasi Password
            <input type="password" name="password_confirmation" required>
        </label>
        <button type="submit" class="primary">Daftar</button>
    </form>
@endsection
