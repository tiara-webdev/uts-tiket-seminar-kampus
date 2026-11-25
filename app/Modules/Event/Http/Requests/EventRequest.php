<?php

namespace App\Modules\Event\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'location' => ['required', 'string', 'max:255'],
            'event_date' => ['required', 'date'],
            'status' => ['required', 'in:draft,published'],
            'speaker_ids' => ['nullable', 'array'],
            'speaker_ids.*' => ['integer', 'exists:speakers,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.required' => 'Kategori wajib dipilih.',
            'category_id.exists' => 'Kategori tidak valid.',
            'title.required' => 'Judul event wajib diisi.',
            'location.required' => 'Lokasi wajib diisi.',
            'event_date.required' => 'Tanggal dan waktu wajib diisi.',
            'event_date.date' => 'Format tanggal tidak valid.',
            'status.in' => 'Status harus draft atau published.',
        ];
    }
}
