<?php



namespace App\Http\Controllers\Monitoring;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateMonitoringRequest;
use App\Models\KategoriPenggunaan;
use App\Models\Mahasiswa;
use App\Models\PenggunaanBeasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PenggunaanBeasiswaController extends Controller
{
    

   public function index(Request $request)
{
    /*
    |--------------------------------------------------------------------------
    | Daftar Tahun
    |--------------------------------------------------------------------------
    */

    $tahuns = Mahasiswa::select('tahun')
        ->distinct()
        ->orderByDesc('tahun')
        ->pluck('tahun');

    /*
    |--------------------------------------------------------------------------
    | Tahun Dipilih
    |--------------------------------------------------------------------------
    */

    $tahun = $request->tahun;

    /*
    |--------------------------------------------------------------------------
    | Jika belum memilih tahun
    |--------------------------------------------------------------------------
    */

    if (!$tahun) {

        return view(
            'monitoring.penggunaan-beasiswa.index',
            [

                'tahun' => null,

                'tahuns' => $tahuns,

                'penggunaans' => collect(),

                'kategoriPenggunaans' => collect(),

                'totalPenggunaan' => 0,

                'sudahDimonitor' => 0,

                'belumDimonitor' => 0,

                'totalNominal' => 0,

            ]
        );

    }

    /*
    |--------------------------------------------------------------------------
    | Query
    |--------------------------------------------------------------------------
    */

    $query = PenggunaanBeasiswa::with([
            'mahasiswa',
            'kategori',
            'petugas',
        ])
        ->whereHas('mahasiswa', function ($q) use ($tahun) {

            $q->where('tahun', $tahun);

        });

    /*
    |--------------------------------------------------------------------------
    | Search
    |--------------------------------------------------------------------------
    */

    if ($request->filled('search')) {

        $query->whereHas('mahasiswa', function ($q) use ($request) {

            $q->where('nama', 'like', '%' . $request->search . '%')
              ->orWhere('nim', 'like', '%' . $request->search . '%');

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
    | Statistik
    |--------------------------------------------------------------------------
    */

    $totalPenggunaan = (clone $query)->count();

    $totalNominal = (clone $query)->sum('nominal');

    $sudahDimonitor = (clone $query)
        ->whereNotNull('tanggal_monitoring')
        ->count();

    $belumDimonitor = (clone $query)
        ->whereNull('tanggal_monitoring')
        ->count();

    /*
    |--------------------------------------------------------------------------
    | Data
    |--------------------------------------------------------------------------
    */

    $penggunaans = $query
        ->latest()
        ->paginate(10)
        ->withQueryString();

    /*
    |--------------------------------------------------------------------------
    | Kategori
    |--------------------------------------------------------------------------
    */

    $kategoriPenggunaans = KategoriPenggunaan::orderBy('nama')->get();

    return view(
        'monitoring.penggunaan-beasiswa.index',
        compact(
            'tahun',
            'tahuns',
            'penggunaans',
            'kategoriPenggunaans',
            'totalPenggunaan',
            'sudahDimonitor',
            'belumDimonitor',
            'totalNominal'
        )
    );
}


        /**
     * ==========================================================================
     * Detail Penggunaan Dana
     * ==========================================================================
     */
    public function show(PenggunaanBeasiswa $penggunaanBeasiswa)
    {
        /*
        |--------------------------------------------------------------------------
        | Load Relasi
        |--------------------------------------------------------------------------
        */

        $penggunaanBeasiswa->load([

            'mahasiswa',

            'kategori',

            'petugas',

        ]);

        return view(
            'monitoring.penggunaan-beasiswa.show',
            compact('penggunaanBeasiswa')
        );
    }

        /**
     * ==========================================================================
     * Form Monitoring Penggunaan Dana
     * ==========================================================================
     */
    public function edit(PenggunaanBeasiswa $penggunaanBeasiswa)
    {
        /*
        |--------------------------------------------------------------------------
        | Load Relasi
        |--------------------------------------------------------------------------
        */

        $penggunaanBeasiswa->load([

            'mahasiswa',

            'kategori',

            'petugas',

        ]);

        return view(
            'monitoring.penggunaan-beasiswa.edit',
            compact('penggunaanBeasiswa')
        );
    }


        /**
     * ==========================================================================
     * Simpan Hasil Monitoring
     * ==========================================================================
     */
    public function update(
        UpdateMonitoringRequest $request,
        PenggunaanBeasiswa $penggunaanBeasiswa
    ) {
        DB::beginTransaction();

        try {

            /*
            |--------------------------------------------------------------------------
            | Update Monitoring
            |--------------------------------------------------------------------------
            */

            $penggunaanBeasiswa->update([

                'catatan_monitoring' => $request->catatan_monitoring,

                'peringatan' => $request->peringatan,

                'dimonitor_oleh' => Auth::id(),

                'tanggal_monitoring' => now(),

            ]);

            DB::commit();

            return redirect()
                ->route('monitoring.penggunaan-beasiswa.show', $penggunaanBeasiswa)
                ->with(
                    'success',
                    'Monitoring penggunaan dana berhasil disimpan.'
                );

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->withErrors([

                    'error' => $e->getMessage()

                ]);

        }
    }

}


