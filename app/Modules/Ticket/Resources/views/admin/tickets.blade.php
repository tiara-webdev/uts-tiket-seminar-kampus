@extends('layouts.app')

@section('title', 'Kelola Tiket')
@section('wide', 'wide')

@section('content')
    <h2>Tiket: {{ $event['title'] }}</h2>
    <p><a href="{{ route('admin.events.index') }}">&laquo; Kembali ke daftar event</a></p>

    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Harga</th>
                <th>Kuota</th>
                <th>Terpesan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($ticketTypes as $t)
                <tr>
                    <td>{{ $t->name }}</td>
                    <td>Rp {{ number_format($t->price, 0, ',', '.') }}</td>
                    <td>{{ $t->quota }}</td>
                    <td>{{ $t->reserved }}</td>
                    <td>
                        <form method="POST" action="{{ route('admin.tickets.destroy', $t) }}" class="inline"
                            onsubmit="return confirm('Hapus jenis tiket ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Belum ada jenis tiket.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <h3>Tambah Jenis Tiket</h3>
    <form method="POST" action="{{ route('admin.events.tickets.store', $event['id']) }}">
        @csrf
        <label>Nama
            <input type="text" name="name" value="{{ old('name') }}" required>
        </label>
        <label>Harga (Rp)
            <input type="number" name="price" value="{{ old('price', 0) }}" min="0" required>
        </label>
        <label>Kuota
            <input type="number" name="quota" value="{{ old('quota', 50) }}" min="1" required>
        </label>
        <button type="submit" class="primary">Tambah</button>
    </form>
@endsection
