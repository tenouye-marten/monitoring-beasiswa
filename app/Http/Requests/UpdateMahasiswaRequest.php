<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMahasiswaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'email' => [
                'required',
                'email',
            ],

            'no_hp' => [
                'nullable',
                'string',
                'max:20',
            ],

            'status' => [
                'required',
                'in:Aktif,Nonaktif',
            ],

        ];
    }
}