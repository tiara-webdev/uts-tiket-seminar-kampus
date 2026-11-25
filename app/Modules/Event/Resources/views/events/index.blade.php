@extends('layouts.app')

@section('title', 'Daftar Event')
@section('wide', 'wide')

@section('content')
    <h2>Daftar Event</h2>

    @forelse ($events as $event)
        <div style="border-bottom:1px solid #eee;padding:12px 0">
            <h3 style="margin:0"><a href="{{ route('events.show', $event) }}">{{ $event->title }}</a></h3>
            <small>{{ $event->category->name }} &middot; {{ $event->event_date->format('d M Y, H:i') }} &middot;
                {{ $event->location }}</small>
        </div>
    @empty
        <p>Belum ada event yang dipublikasikan.</p>
    @endforelse
@endsection
