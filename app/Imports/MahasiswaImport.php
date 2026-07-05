<?php

namespace App\Imports;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class MahasiswaImport implements
    ToModel,
    WithHeadingRow,
    WithValidation,
    SkipsOnFailure,
    SkipsEmptyRows
{
    use Importable, SkipsFailures;

    public int $berhasil = 0;

    public int $duplikat = 0;

    public function model(array $row)
    {
        /*
        |--------------------------------------------------------------------------
        | Cek Data Mahasiswa
        |--------------------------------------------------------------------------
        */

        if (Mahasiswa::where('nim', $row['nim'])->exists()) {

            $this->duplikat++;

            return null;

        }

        /*
        |--------------------------------------------------------------------------
        | Membuat Akun User
        |--------------------------------------------------------------------------
        */

        $user = User::firstOrCreate(

            [
                'email' => $row['email'],
            ],

            [
                'name' => $row['nama'],

                'password' => Hash::make('password'),
            ]

        );

        /*
        |--------------------------------------------------------------------------
        | Assign Role Mahasiswa
        |--------------------------------------------------------------------------
        */

        if (!$user->hasRole('mahasiswa')) {

            $user->assignRole('mahasiswa');

        }

        /*
        |--------------------------------------------------------------------------
        | Simpan Mahasiswa
        |--------------------------------------------------------------------------
        */

        $this->berhasil++;

        return new Mahasiswa([

            'user_id' => $user->id,

            'nama' => $row['nama'],

            'nim' => $row['nim'],

            'email' => $row['email'],

            'no_hp' => $row['no_hp'] ?? null,

            'perguruan_tinggi' => $row['perguruan_tinggi'],

            'program_studi' => $row['program_studi'],

            'jenis_beasiswa' => $row['jenis_beasiswa'],

            'tahun' => $row['tahun'],

            'semester' => $row['semester'],

            'nominal_beasiswa' => $row['nominal_beasiswa'],

            'status' => 'Aktif',

        ]);
    }

    public function rules(): array
    {
        return [

            '*.nama' => ['required'],

            '*.nim' => ['required'],

            '*.email' => ['required', 'email'],

            '*.perguruan_tinggi' => ['required'],

            '*.program_studi' => ['required'],

            '*.jenis_beasiswa' => ['required'],

            '*.tahun' => ['required'],

            '*.semester' => ['required'],

            '*.nominal_beasiswa' => ['required', 'numeric'],

        ];
    }
}