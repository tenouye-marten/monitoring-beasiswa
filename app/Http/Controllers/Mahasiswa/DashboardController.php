<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\PenggunaanBeasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $mahasiswa = Auth::user()->mahasiswa;

        $penggunaan = PenggunaanBeasiswa::where(
            'mahasiswa_id',
            $mahasiswa->id
        );

        $totalDana = $mahasiswa->nominal_beasiswa;

        $totalDigunakan = (clone $penggunaan)->sum('nominal');

        $sisaDana = $totalDana - $totalDigunakan;

        $totalPenggunaan = (clone $penggunaan)->count();

        /*
        |--------------------------------------------------------------------------
        | Chart Kategori
        |--------------------------------------------------------------------------
        */

        $kategoriChart = (clone $penggunaan)
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

        /*
        |--------------------------------------------------------------------------
        | Chart Bulanan
        |--------------------------------------------------------------------------
        */

        $bulananChart = (clone $penggunaan)
            ->selectRaw('MONTH(tanggal) bulan,SUM(nominal) total')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Riwayat
        |--------------------------------------------------------------------------
        */

        $penggunaanTerbaru = (clone $penggunaan)
            ->latest()
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Monitoring Terakhir
        |--------------------------------------------------------------------------
        */

        $monitoring = (clone $penggunaan)
            ->latest('tanggal_monitoring')
            ->first();

        return view('mahasiswa.dashboard', compact(

            'mahasiswa',

            'totalDana',
            'totalDigunakan',
            'sisaDana',
            'totalPenggunaan',

            'kategoriChart',
            'bulananChart',

            'penggunaanTerbaru',

            'monitoring'

        ));
    }
}