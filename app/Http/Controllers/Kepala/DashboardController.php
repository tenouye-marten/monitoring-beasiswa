<?php

namespace App\Http\Controllers\Kepala;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\PenggunaanBeasiswa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $tahuns = Mahasiswa::select('tahun')
            ->distinct()
            ->orderByDesc('tahun')
            ->pluck('tahun');

        $tahun = $request->tahun ?? Mahasiswa::max('tahun');

        $mahasiswa = Mahasiswa::where('tahun', $tahun);

        $totalMahasiswa = $mahasiswa->count();

        $totalDana = $mahasiswa->sum('nominal_beasiswa');

        $penggunaan = PenggunaanBeasiswa::with([
                'mahasiswa',
                'kategori',
                'petugas'
            ])
            ->whereHas('mahasiswa', function ($q) use ($tahun) {
                $q->where('tahun', $tahun);
            });

        $totalPenggunaan = (clone $penggunaan)->count();

        $totalDigunakan = (clone $penggunaan)->sum('nominal');

        $sisaDana = $totalDana - $totalDigunakan;

        $sudahDimonitor = (clone $penggunaan)
            ->whereNotNull('tanggal_monitoring')
            ->count();

        $belumDimonitor = (clone $penggunaan)
            ->whereNull('tanggal_monitoring')
            ->count();

        $penggunaanTerbaru = (clone $penggunaan)
            ->latest('tanggal')
            ->take(5)
            ->get();

        return view('kepala.dashboard', compact(
            'tahun',
            'tahuns',
            'totalMahasiswa',
            'totalDana',
            'totalPenggunaan',
            'totalDigunakan',
            'sisaDana',
            'sudahDimonitor',
            'belumDimonitor',
            'penggunaanTerbaru'
        ));
    }
}