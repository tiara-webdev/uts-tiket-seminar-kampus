@extends('layouts.app')

@section('title', 'Pesanan Masuk')
@section('wide', 'wide')

@section('content')
    <h2>Pesanan Masuk</h2>

    <p>
        Filter:
        <a href="{{ route('admin.registrations') }}">Semua</a>
        @foreach (['pending', 'confirmed', 'cancelled', 'checked_in'] as $s)
            | <a href="{{ route('admin.registrations', ['status' => $s]) }}">{{ $s }}</a>
        @endforeach
    </p>

    <table>
        <thead>
            <tr>
                <th>Peserta</th>
                <th>Event</th>
                <th>Tiket</th>
                <th>Total</th>
                <th>Status</th>
                <th>Kode</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($registrations as $r)
                <tr>
                    <td>{{ $r->user->name }}</td>
                    <td>{{ $r->event_title }}</td>
                    <td>{{ $r->ticket_type_name }} x {{ $r->quantity }}</td>
                    <td>Rp {{ number_format($r->total_price, 0, ',', '.') }}</td>
                    <td>{{ $r->status }}</td>
                    <td>{{ $r->ticket_code ?? '-' }}</td>
                    <td>
                        @if ($r->status === 'pending')
                            <form method="POST" action="{{ route('admin.registrations.confirm', $r) }}" class="inline">
                                @csrf
                                <button type="submit" class="btn-sm">Konfirmasi</button>
                            </form>
                            <form method="POST" action="{{ route('admin.registrations.reject', $r) }}" class="inline">
                                @csrf
                                <button type="submit" class="btn-sm btn-danger">Tolak</button>
                            </form>
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Belum ada pesanan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
