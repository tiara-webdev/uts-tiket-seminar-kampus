@extends('layouts.app')

@section('title', $event->title)
@section('wide', 'wide')

@section('content')
    <h2>{{ $event->title }}</h2>
    <p><small>{{ $event->category->name }} &middot; {{ $event->event_date->format('d M Y, H:i') }} &middot;
            {{ $event->location }}</small></p>
    <p>{{ $event->description }}</p>

    <h3>Pembicara</h3>
    <ul>
        @foreach ($event->speakers as $speaker)
            <li>{{ $speaker->name }} ({{ $speaker->pivot->role }})</li>
        @endforeach
    </ul>

    <h3>Tiket</h3>
    @forelse ($ticketTypes as $ticket)
        <div style="border:1px solid #ddd;border-radius:6px;padding:12px;margin-bottom:10px">
            <strong>{{ $ticket['name'] }}</strong> - Rp {{ number_format($ticket['price'], 0, ',', '.') }}
            <br><small>Sisa kuota: {{ $ticket['remaining'] }}</small>

            @auth
                @if (auth()->user()->role === 'participant')
                    @if ($ticket['remaining'] > 0)
                        <form method="POST" action="{{ route('orders.store') }}">
                            @csrf
                            <input type="hidden" name="ticket_type_id" value="{{ $ticket['id'] }}">
                            <label>Jumlah
                                <input type="number" name="quantity" value="1" min="1" max="5" required>
                            </label>
                            <button type="submit" class="primary">Pesan Tiket</button>
                        </form>
                    @else
                        <p style="color:#b71c1c">Kuota habis.</p>
                    @endif
                @endif
            @else
                <p><a href="{{ route('login') }}">Login</a> untuk memesan tiket.</p>
            @endauth
        </div>
    @empty
        <p>Belum ada tiket untuk event ini.</p>
    @endforelse
@endsection
