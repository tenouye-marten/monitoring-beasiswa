<?php

namespace App\Http\Controllers\Keuangan;

use App\Http\Controllers\Controller;
use App\Models\KategoriPenggunaan;
use App\Models\PenggunaanBeasiswa;
use Illuminate\Http\Request;

class PenggunaanBeasiswaController extends Controller
{
    /**
     * Menampilkan seluruh penggunaan dana mahasiswa.
     */
    public function index(Request $request)
    {
        $query = PenggunaanBeasiswa::with([
            'mahasiswa',
            'kategori',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = $request->search;

            $query->whereHas('mahasiswa', function ($q) use ($search) {

                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nim', 'like', "%{$search}%");

            });

        }

        /*
        |--------------------------------------------------------------------------
        | Filter Kategori
        |--------------------------------------------------------------------------
        */

        if ($request->filled('kategori')) {

            $query->where(
                'kategori_penggunaan_id',
                $request->kategori
            );

        }

        /*
        |--------------------------------------------------------------------------
        | Filter Status
        |--------------------------------------------------------------------------
        */

        if ($request->filled('status')) {

            $query->where(
                'status',
                $request->status
            );

        }

        /*
        |--------------------------------------------------------------------------
        | Filter Tahun
        |--------------------------------------------------------------------------
        */

        if ($request->filled('tahun')) {

            $query->whereYear(
                'tanggal',
                $request->tahun
            );

        }

        $penggunaans = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | Statistik
        |--------------------------------------------------------------------------
        */

        $totalPengajuan = PenggunaanBeasiswa::count();

        $menunggu = PenggunaanBeasiswa::where(
            'status',
            'Menunggu'
        )->count();

        $disetujui = PenggunaanBeasiswa::where(
            'status',
            'Disetujui'
        )->count();

        $ditolak = PenggunaanBeasiswa::where(
            'status',
            'Ditolak'
        )->count();

        /*
        |--------------------------------------------------------------------------
        | Dropdown
        |--------------------------------------------------------------------------
        */

        $kategoriPenggunaans = KategoriPenggunaan::where(
            'status',
            true
        )
        ->orderBy('nama')
        ->get();

        $tahuns = PenggunaanBeasiswa::selectRaw('YEAR(tanggal) as tahun')
            ->distinct()
            ->orderByDesc('tahun')
            ->pluck('tahun');

        return view(
            'keuangan.penggunaan-beasiswa.index',
            compact(
                'penggunaans',
                'kategoriPenggunaans',
                'tahuns',
                'totalPengajuan',
                'menunggu',
                'disetujui',
                'ditolak'
            )
        );
    }

    /**
     * Detail penggunaan dana.
     */
    public function show(PenggunaanBeasiswa $penggunaanBeasiswa)
    {
        //
    }

    /**
     * Form verifikasi.
     */
  /**
 * Form verifikasi penggunaan dana.
 */
public function verifikasi(
    PenggunaanBeasiswa $penggunaanBeasiswa
)
{
    return view(
        'keuangan.penggunaan-beasiswa.verifikasi',
        compact('penggunaanBeasiswa')
    );
}

    /**
     * Simpan hasil verifikasi.
     */
   /**
 * Simpan hasil verifikasi.
 */
public function updateVerifikasi(
    VerifikasiPenggunaanBeasiswaRequest $request,
    PenggunaanBeasiswa $penggunaanBeasiswa
)
{
    $penggunaanBeasiswa->update([

        'status' => $request->status,

        'catatan_verifikasi' => $request->catatan_verifikasi,

        'diverifikasi_oleh' => Auth::id(),

        'tanggal_verifikasi' => now(),

    ]);

    return redirect()
        ->route('keuangan.penggunaan-beasiswa.index')
        ->with(
            'success',
            'Verifikasi berhasil disimpan.'
        );
}
}