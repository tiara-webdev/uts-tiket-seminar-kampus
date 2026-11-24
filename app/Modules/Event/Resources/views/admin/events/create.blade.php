@extends('layouts.app')

@section('title', 'Tambah Event')
@section('wide', 'wide')

@section('content')
    <h2>Tambah Event</h2>
    <form method="POST" action="{{ route('admin.events.store') }}">
        @csrf
        @include('event::admin.events._form')
        <button type="submit" class="primary">Simpan</button>
    </form>
@endsection
