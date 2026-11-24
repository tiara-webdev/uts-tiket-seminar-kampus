<?php

namespace App\Modules\Registration\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckInRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'ticket_code' => strtoupper(trim((string) $this->input('ticket_code'))),
        ]);
    }

    public function rules(): array
    {
        return [
            'ticket_code' => ['required', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'ticket_code.required' => 'Kode tiket wajib diisi.',
        ];
    }
}
