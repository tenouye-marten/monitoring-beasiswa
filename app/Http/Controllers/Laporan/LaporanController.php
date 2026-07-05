<?php

namespace App\Http\Controllers\Laporan;

use App\Exports\LaporanPenggunaanExport;
use App\Http\Controllers\Controller;
use App\Models\KategoriPenggunaan;
use App\Models\Mahasiswa;
use App\Models\PenggunaanBeasiswa;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $tahun = $request->tahun ?? Mahasiswa::max('tahun');

        $tahuns = Mahasiswa::select('tahun')
            ->distinct()
            ->orderByDesc('tahun')
            ->pluck('tahun');

        $perguruanTinggis = Mahasiswa::select('perguruan_tinggi')
            ->distinct()
            ->orderBy('perguruan_tinggi')
            ->pluck('perguruan_tinggi');

        $jenisBeasiswas = Mahasiswa::select('jenis_beasiswa')
            ->distinct()
            ->orderBy('jenis_beasiswa')
            ->pluck('jenis_beasiswa');

        $kategoriPenggunaans = KategoriPenggunaan::orderBy('nama')->get();

        $laporans = PenggunaanBeasiswa::with([
                'mahasiswa',
                'kategori',
                'petugas'
            ])
            ->whereHas('mahasiswa', function ($q) use ($request, $tahun) {

                $q->where('tahun', $tahun);

                if ($request->perguruan_tinggi) {

                    $q->where('perguruan_tinggi', $request->perguruan_tinggi);

                }

                if ($request->jenis_beasiswa) {

                    $q->where('jenis_beasiswa', $request->jenis_beasiswa);

                }

                if ($request->search) {

                    $q->where(function ($query) use ($request) {

                        $query->where('nama', 'like', "%{$request->search}%")
                              ->orWhere('nim', 'like', "%{$request->search}%");

                    });

                }

            });

        if ($request->kategori) {

            $laporans->where(
                'kategori_penggunaan_id',
                $request->kategori
            );

        }

        $totalPenggunaan = (clone $laporans)->count();

        $totalNominal = (clone $laporans)->sum('nominal');

        $laporans = $laporans
            ->latest('tanggal')
            ->paginate(10)
            ->withQueryString();

        return view('laporan.index', [

            'laporans' => $laporans,

            'tahuns' => $tahuns,

            'tahun' => $tahun,

            'perguruanTinggis' => $perguruanTinggis,

            'jenisBeasiswas' => $jenisBeasiswas,

            'kategoriPenggunaans' => $kategoriPenggunaans,

            'totalPenggunaan' => $totalPenggunaan,

            'totalNominal' => $totalNominal,

            'perguruanTinggi' => $request->perguruan_tinggi,

            'jenisBeasiswa' => $request->jenis_beasiswa,

            'kategori' => $request->kategori,

            'search' => $request->search,

        ]);
    }

    /**
     * Export Excel
     */
    public function excel(Request $request)
    {
        return Excel::download(

            new LaporanPenggunaanExport($request),

            'laporan-penggunaan-dana.xlsx'

        );
    }


    public function pdf(Request $request)
{
    $tahun = $request->tahun ?? Mahasiswa::max('tahun');

    $laporans = PenggunaanBeasiswa::with([
            'mahasiswa',
            'kategori',
            'petugas'
        ])
        ->whereHas('mahasiswa', function ($q) use ($request, $tahun) {

            $q->where('tahun', $tahun);

            if ($request->perguruan_tinggi) {

                $q->where(
                    'perguruan_tinggi',
                    $request->perguruan_tinggi
                );

            }

            if ($request->jenis_beasiswa) {

                $q->where(
                    'jenis_beasiswa',
                    $request->jenis_beasiswa
                );

            }

            if ($request->search) {

                $q->where(function ($query) use ($request) {

                    $query->where(
                        'nama',
                        'like',
                        "%{$request->search}%"
                    )->orWhere(
                        'nim',
                        'like',
                        "%{$request->search}%"
                    );

                });

            }

        });

    if ($request->kategori) {

        $laporans->where(
            'kategori_penggunaan_id',
            $request->kategori
        );

    }

    $laporans = $laporans
        ->latest('tanggal')
        ->get();

    $pdf = Pdf::loadView(
        'laporan.pdf',
        compact(
            'laporans',
            'tahun'
        )
    );

    $pdf->setPaper('A4','landscape');

    return $pdf->stream(
        'laporan-penggunaan-dana.pdf'
    );
}
}