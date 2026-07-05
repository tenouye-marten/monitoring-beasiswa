<?php

namespace App\Http\Controllers\Keuangan;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\PenggunaanBeasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $tahun = $request->tahun ?? Mahasiswa::max('tahun');

        $tahuns = Mahasiswa::select('tahun')
            ->distinct()
            ->orderByDesc('tahun')
            ->pluck('tahun');

        $totalMahasiswa = Mahasiswa::where('tahun', $tahun)->count();

        $totalDana = Mahasiswa::where('tahun', $tahun)
            ->sum('nominal_beasiswa');

        $totalDigunakan = PenggunaanBeasiswa::whereHas('mahasiswa', function ($q) use ($tahun) {
                $q->where('tahun', $tahun);
            })
            ->sum('nominal');

        $sisaDana = $totalDana - $totalDigunakan;

        $kategoriChart = PenggunaanBeasiswa::whereHas('mahasiswa', function ($q) use ($tahun) {
                $q->where('tahun', $tahun);
            })
            ->join(
                'kategori_penggunaans',
                'penggunaan_beasiswas.kategori_penggunaan_id',
                '=',
                'kategori_penggunaans.id'
            )
            ->select(
                'kategori_penggunaans.nama',
                DB::raw('SUM(nominal) total')
            )
            ->groupBy('kategori_penggunaans.nama')
            ->get();

        $bulananChart = PenggunaanBeasiswa::whereHas('mahasiswa', function ($q) use ($tahun) {
                $q->where('tahun', $tahun);
            })
            ->selectRaw('MONTH(tanggal) bulan, SUM(nominal) total')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $penggunaanTerbaru = PenggunaanBeasiswa::with([
                'mahasiswa',
                'kategori'
            ])
            ->whereHas('mahasiswa', function ($q) use ($tahun) {
                $q->where('tahun', $tahun);
            })
            ->latest()
            ->take(5)
            ->get();

        return view('keuangan.dashboard', compact(

            'tahun',
            'tahuns',

            'totalMahasiswa',
            'totalDana',
            'totalDigunakan',
            'sisaDana',

            'kategoriChart',
            'bulananChart',

            'penggunaanTerbaru'

        ));
    }
}