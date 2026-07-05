<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerifikasiPenggunaanBeasiswaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation Rules
     */
    public function rules(): array
    {
        return [

            'status' => [
                'required',
                'in:Disetujui,Ditolak'
            ],

            'catatan_verifikasi' => [
                'nullable',
                'string',
                'max:1000'
            ],

        ];
    }

    public function messages(): array
    {
        return [

            'status.required' => 'Status verifikasi wajib dipilih.',

            'status.in' => 'Status verifikasi tidak valid.',

        ];
    }
}