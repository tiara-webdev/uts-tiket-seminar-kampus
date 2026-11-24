@extends('layouts.app')

@section('title', 'Admin')

@section('content')
    <h2>Halaman Admin</h2>
    <ul>
        <li><a href="{{ route('admin.registrations') }}">Pesanan Masuk</a></li>
        <li><a href="{{ route('admin.check-in') }}">Check-in Peserta</a></li>
    </ul>
@endsection
