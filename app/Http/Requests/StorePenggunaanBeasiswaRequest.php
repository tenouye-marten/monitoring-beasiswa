<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePenggunaanBeasiswaRequest extends FormRequest
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

            /*
            |--------------------------------------------------------------------------
            | Data Penggunaan Dana
            |--------------------------------------------------------------------------
            */

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
                'required',
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

            'kategori_penggunaan_id.exists' => 'Kategori penggunaan tidak valid.',

            'tanggal.required' => 'Tanggal penggunaan wajib diisi.',

            'tanggal.date' => 'Format tanggal tidak valid.',

            'nominal.required' => 'Nominal wajib diisi.',

            'nominal.numeric' => 'Nominal harus berupa angka.',

            'nominal.min' => 'Nominal minimal Rp1.',

            'deskripsi.required' => 'Deskripsi penggunaan wajib diisi.',

            'bukti_transaksi.required' => 'Bukti transaksi wajib diupload.',

            'bukti_transaksi.mimes' => 'Bukti transaksi harus berupa JPG, PNG atau PDF.',

            'bukti_transaksi.max' => 'Ukuran bukti transaksi maksimal 2 MB.',

            'dokumentasi.mimes' => 'Dokumentasi harus berupa JPG, PNG atau PDF.',

            'dokumentasi.max' => 'Ukuran dokumentasi maksimal 2 MB.',

        ];
    }
}