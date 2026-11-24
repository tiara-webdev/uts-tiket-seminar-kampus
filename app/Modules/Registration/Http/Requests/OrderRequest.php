<?php

namespace App\Modules\Registration\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Tanpa aturan exists:ticket_types: itu mengakses tabel modul lain secara langsung.
        // Id tiket yang tidak ada ditangani di service (hasilnya 404).
        return [
            'ticket_type_id' => ['required', 'integer'],
            'quantity' => ['required', 'integer', 'min:1', 'max:5'],
        ];
    }

    public function messages(): array
    {
        return [
            'ticket_type_id.required' => 'Jenis tiket wajib dipilih.',
            'quantity.required' => 'Jumlah tiket wajib diisi.',
            'quantity.integer' => 'Jumlah tiket harus berupa angka.',
            'quantity.min' => 'Jumlah tiket minimal 1.',
            'quantity.max' => 'Jumlah tiket maksimal 5 per pesanan.',
        ];
    }
}
