<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;

class MahasiswaTemplateExport implements WithHeadings
{
    public function headings(): array
    {
        return [

            'nama',
            'nim',
            'email',
            'no_hp',
            'perguruan_tinggi',
            'program_studi',
            'jenis_beasiswa',
            'tahun',
            'semester',
            'nominal_beasiswa',

        ];
    }
}