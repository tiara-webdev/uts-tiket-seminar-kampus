@extends('layouts.app')

@section('title', 'Tiket Saya')
@section('wide', 'wide')

@section('content')
    <h2>Tiket Saya</h2>

    @forelse ($registrations as $r)
        <div style="border:1px solid #ddd;border-radius:6px;padding:12px;margin-bottom:10px">
            <strong>{{ $r->event_title }}</strong><br>
            {{ $r->ticket_type_name }} x {{ $r->quantity }} - Rp {{ number_format($r->total_price, 0, ',', '.') }}<br>
            Status: <strong>{{ $r->status }}</strong>

            @if ($r->ticket_code)
                <br>Kode tiket: <strong>{{ $r->ticket_code }}</strong>
            @endif

            @if ($r->status === 'pending')
                <form method="POST" action="{{ route('registrations.cancel', $r) }}">
                    @csrf
                    <button type="submit" class="primary" style="background:#b71c1c">Batalkan Pesanan</button>
                </form>
            @endif
        </div>
    @empty
        <p>Belum ada pesanan.</p>
    @endforelse
@endsection
