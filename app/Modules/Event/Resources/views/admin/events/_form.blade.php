<label>Kategori
    <select name="category_id" required>
        <option value="">Pilih kategori</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" @selected(old('category_id', $event->category_id) == $category->id)>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</label>

<label>Judul
    <input type="text" name="title" value="{{ old('title', $event->title) }}" required>
</label>

<label>Deskripsi
    <textarea name="description" rows="4">{{ old('description', $event->description) }}</textarea>
</label>

<label>Lokasi
    <input type="text" name="location" value="{{ old('location', $event->location) }}" required>
</label>

<label>Tanggal dan Waktu
    <input type="datetime-local" name="event_date"
        value="{{ old('event_date', $event->event_date?->format('Y-m-d\TH:i')) }}" required>
</label>

<label>Status
    <select name="status" required>
        @foreach (['draft' => 'Draft', 'published' => 'Published'] as $value => $label)
            <option value="{{ $value }}" @selected(old('status', $event->status ?? 'draft') === $value)>{{ $label }}</option>
        @endforeach
    </select>
</label>

@php
    $selectedSpeakers = old('speaker_ids', $event->exists ? $event->speakers->pluck('id')->all() : []);
@endphp

<p style="margin-top:12px;font-size:14px">Pembicara</p>
@foreach ($speakers as $speaker)
    <label style="display:inline-block;margin-right:12px">
        <input type="checkbox" name="speaker_ids[]" value="{{ $speaker->id }}" style="width:auto"
            @checked(in_array($speaker->id, $selectedSpeakers))>
        {{ $speaker->name }}
    </label>
@endforeach
