<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\PenggunaanBeasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Tahun
        |--------------------------------------------------------------------------
        */

        $tahun = $request->tahun ?? Mahasiswa::max('tahun');

        $tahuns = Mahasiswa::select('tahun')
            ->distinct()
            ->orderByDesc('tahun')
            ->pluck('tahun');

        /*
        |--------------------------------------------------------------------------
        | Statistik
        |--------------------------------------------------------------------------
        */

        $totalMahasiswa = Mahasiswa::where('tahun', $tahun)->count();

        $totalDana = Mahasiswa::where('tahun', $tahun)
            ->sum('nominal_beasiswa');

        $totalDigunakan = PenggunaanBeasiswa::whereHas('mahasiswa', function ($q) use ($tahun) {
                $q->where('tahun', $tahun);
            })
            ->sum('nominal');

        $sisaDana = $totalDana - $totalDigunakan;

        /*
        |--------------------------------------------------------------------------
        | Chart Kategori
        |--------------------------------------------------------------------------
        */

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
                DB::raw('SUM(nominal) as total')
            )
            ->groupBy('kategori_penggunaans.nama')
            ->orderByDesc('total')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Chart Bulanan
        |--------------------------------------------------------------------------
        */

        $bulananChart = PenggunaanBeasiswa::whereHas('mahasiswa', function ($q) use ($tahun) {
                $q->where('tahun', $tahun);
            })
            ->selectRaw('MONTH(tanggal) as bulan, SUM(nominal) as total')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Monitoring
        |--------------------------------------------------------------------------
        */

        $sudahMonitoring = PenggunaanBeasiswa::whereHas('mahasiswa', function ($q) use ($tahun) {
                $q->where('tahun', $tahun);
            })
            ->whereNotNull('tanggal_monitoring')
            ->count();

        $belumMonitoring = PenggunaanBeasiswa::whereHas('mahasiswa', function ($q) use ($tahun) {
                $q->where('tahun', $tahun);
            })
            ->whereNull('tanggal_monitoring')
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Penggunaan Dana Terbaru
        |--------------------------------------------------------------------------
        */

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

        /*
        |--------------------------------------------------------------------------
        | View
        |--------------------------------------------------------------------------
        */

        return view('admin.dashboard', compact(

            'tahun',
            'tahuns',

            'totalMahasiswa',
            'totalDana',
            'totalDigunakan',
            'sisaDana',

            'kategoriChart',
            'bulananChart',

            'sudahMonitoring',
            'belumMonitoring',

            'penggunaanTerbaru'

        ));
    }
}