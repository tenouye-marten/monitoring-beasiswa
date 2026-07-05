<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePenggunaanBeasiswaRequest extends FormRequest
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

        'judul' => ['required', 'string', 'max:255'],

            'kategori_penggunaan_id' => [
                'required',
                'exists:kategori_penggunaans,id',
            ],

            'tanggal' => [
                'required',
                'date',
            ],

            'nominal' => [
                'required',
                'numeric',
                'min:1',
            ],

            'deskripsi' => [
                'required',
                'string',
                'max:2000',
            ],

            /*
            |--------------------------------------------------------------------------
            | Upload
            |--------------------------------------------------------------------------
            */

            'bukti_transaksi' => [
                'nullable',
                'file',
                'mimes:jpg,jpeg,png,pdf',
                'max:2048',
            ],

            'dokumentasi' => [
                'nullable',
                'file',
                'mimes:jpg,jpeg,png,pdf',
                'max:2048',
            ],

        ];
    }

    /**
     * Validation Messages
     */
    public function messages(): array
    {
        return [


            'kategori_penggunaan_id.required' => 'Kategori penggunaan wajib dipilih.',

            'tanggal.required' => 'Tanggal penggunaan wajib diisi.',

            'nominal.required' => 'Nominal wajib diisi.',

            'nominal.numeric' => 'Nominal harus berupa angka.',

            'nominal.min' => 'Nominal minimal Rp1.',

            'deskripsi.required' => 'Deskripsi penggunaan wajib diisi.',

            'bukti_transaksi.mimes' => 'Bukti transaksi harus berupa JPG, PNG atau PDF.',

            'bukti_transaksi.max' => 'Ukuran bukti transaksi maksimal 2 MB.',

            'dokumentasi.mimes' => 'Dokumentasi harus berupa JPG, PNG atau PDF.',

            'dokumentasi.max' => 'Ukuran dokumentasi maksimal 2 MB.',

        ];
    }
}