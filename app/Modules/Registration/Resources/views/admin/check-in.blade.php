@extends('layouts.app')

@section('title', 'Check-in Peserta')

@section('content')
    <h2>Check-in Peserta</h2>
    <form method="POST" action="{{ route('admin.check-in.store') }}">
        @csrf
        <label>Kode Tiket
            <input type="text" name="ticket_code" value="{{ old('ticket_code') }}" placeholder="SEM-XXXXXXXX" required>
        </label>
        <button type="submit" class="primary">Check-in</button>
    </form>
@endsection
