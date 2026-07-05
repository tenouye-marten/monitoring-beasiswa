<?php

namespace App\Exports;

use App\Models\Mahasiswa;
use App\Models\PenggunaanBeasiswa;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporanPenggunaanExport implements
    FromCollection,
    WithHeadings
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $tahun = $this->request->tahun ?? Mahasiswa::max('tahun');

        $laporans = PenggunaanBeasiswa::with([
                'mahasiswa',
                'kategori',
                'petugas'
            ])
            ->whereHas('mahasiswa', function ($q) use ($tahun) {

                $q->where('tahun', $tahun);

                if ($this->request->perguruan_tinggi) {

                    $q->where(
                        'perguruan_tinggi',
                        $this->request->perguruan_tinggi
                    );

                }

                if ($this->request->jenis_beasiswa) {

                    $q->where(
                        'jenis_beasiswa',
                        $this->request->jenis_beasiswa
                    );

                }

                if ($this->request->search) {

                    $q->where(function ($query) {

                        $query->where(
                            'nama',
                            'like',
                            "%{$this->request->search}%"
                        )
                        ->orWhere(
                            'nim',
                            'like',
                            "%{$this->request->search}%"
                        );

                    });

                }

            });

        if ($this->request->kategori) {

            $laporans->where(
                'kategori_penggunaan_id',
                $this->request->kategori
            );

        }

        return $laporans
            ->latest('tanggal')
            ->get()
            ->map(function ($item, $index) {

                return [

                    'No' => $index + 1,

                    'Nama Mahasiswa' => $item->mahasiswa->nama,

                    'NIM' => $item->mahasiswa->nim,

                    'Perguruan Tinggi' => $item->mahasiswa->perguruan_tinggi,

                    'Program Studi' => $item->mahasiswa->program_studi,

                    'Jenis Beasiswa' => $item->mahasiswa->jenis_beasiswa,

                    'Kategori' => $item->kategori->nama,

                    'Tanggal' => $item->tanggal->format('d-m-Y'),

                    'Nominal' => $item->nominal,

                    'Catatan Monitoring' => $item->catatan_monitoring,

                    'Peringatan' => $item->peringatan,

                    'Dimonitor Oleh' => optional($item->petugas)->name,

                ];

            });
    }

    public function headings(): array
    {
        return [

            'No',

            'Nama Mahasiswa',

            'NIM',

            'Perguruan Tinggi',

            'Program Studi',

            'Jenis Beasiswa',

            'Kategori',

            'Tanggal',

            'Nominal',

            'Catatan Monitoring',

            'Peringatan',

            'Dimonitor Oleh',

        ];
    }
}