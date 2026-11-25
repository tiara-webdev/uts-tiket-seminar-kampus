@extends('layouts.app')

@section('title', 'Kelola Event')
@section('wide', 'wide')

@section('content')
    <h2>Kelola Event</h2>
    <p><a href="{{ route('admin.events.create') }}">+ Tambah Event</a></p>

    <table>
        <thead>
            <tr>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($events as $event)
                <tr>
                    <td>{{ $event->title }}</td>
                    <td>{{ $event->category->name }}</td>
                    <td>{{ $event->event_date->format('d M Y, H:i') }}</td>
                    <td>{{ $event->status }}</td>
                    <td>
                        <a href="{{ route('admin.events.edit', $event) }}">Edit</a> |
                        <a href="{{ route('admin.events.tickets', $event->id) }}">Kelola Tiket</a>
                        <form method="POST" action="{{ route('admin.events.destroy', $event) }}" class="inline"
                            onsubmit="return confirm('Hapus event ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Belum ada event.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
