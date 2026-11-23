@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h2>Dashboard</h2>
    <p>Halo, {{ auth()->user()->name }}. Anda login sebagai <strong>{{ auth()->user()->role }}</strong>.</p>

    @if (auth()->user()->isAdmin())
        <p><a href="{{ route('admin.home') }}">Buka halaman Admin</a></p>
    @endif
@endsection
