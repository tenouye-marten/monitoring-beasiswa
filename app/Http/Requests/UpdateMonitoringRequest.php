<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMonitoringRequest extends FormRequest
{
    /**
     * Determine if the user is authorized.
     */
    public function authorize(): bool
    {
        return auth()->check()
            && auth()->user()->hasAnyRole([
                'admin',
                'keuangan',
            ]);
    }

    /**
     * Validation Rules
     */
    public function rules(): array
    {
        return [

            /*
            |--------------------------------------------------------------------------
            | Monitoring
            |--------------------------------------------------------------------------
            */

            'catatan_monitoring' => [
                'nullable',
                'string',
                'max:5000',
            ],

            'peringatan' => [
                'nullable',
                'string',
                'max:5000',
            ],

        ];
    }

    /**
     * Validation Messages
     */
    public function messages(): array
    {
        return [

            'catatan_monitoring.string' =>
                'Catatan monitoring harus berupa teks.',

            'catatan_monitoring.max' =>
                'Catatan monitoring maksimal 5000 karakter.',

            'peringatan.string' =>
                'Peringatan harus berupa teks.',

            'peringatan.max' =>
                'Peringatan maksimal 5000 karakter.',

        ];
    }

    /**
     * Attribute
     */
    public function attributes(): array
    {
        return [

            'catatan_monitoring' => 'Catatan Monitoring',

            'peringatan' => 'Peringatan',

        ];
    }
}