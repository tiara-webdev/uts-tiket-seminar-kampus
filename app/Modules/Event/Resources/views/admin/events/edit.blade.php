@extends('layouts.app')

@section('title', 'Edit Event')
@section('wide', 'wide')

@section('content')
    <h2>Edit Event</h2>
    <form method="POST" action="{{ route('admin.events.update', $event) }}">
        @csrf
        @method('PUT')
        @include('event::admin.events._form')
        <button type="submit" class="primary">Perbarui</button>
    </form>
@endsection
