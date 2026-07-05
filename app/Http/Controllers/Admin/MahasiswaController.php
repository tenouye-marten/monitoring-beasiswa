<?php

namespace App\Http\Controllers\Admin;

use App\Exports\MahasiswaTemplateExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateMahasiswaRequest;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ImportLog;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MahasiswaImport;

class MahasiswaController extends Controller
{
    /**
     * Menampilkan daftar mahasiswa.
     */
   public function index(Request $request)
{
    $query = Mahasiswa::with('user');

    /*
    |--------------------------------------------------------------------------
    | Pencarian
    |--------------------------------------------------------------------------
    */
    if ($request->filled('search')) {

        $search = $request->search;

        $query->where(function ($q) use ($search) {

            $q->where('nama', 'like', "%{$search}%")
                ->orWhere('nim', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('perguruan_tinggi', 'like', "%{$search}%")
                ->orWhere('program_studi', 'like', "%{$search}%")
                ->orWhere('jenis_beasiswa', 'like', "%{$search}%");

        });
    }

    /*
    |--------------------------------------------------------------------------
    | Filter Tahun
    |--------------------------------------------------------------------------
    */
    if ($request->filled('tahun')) {

        $query->where('tahun', $request->tahun);

    }

    /*
    |--------------------------------------------------------------------------
    | Filter Jenis Beasiswa
    |--------------------------------------------------------------------------
    */
    if ($request->filled('jenis_beasiswa')) {

        $query->where('jenis_beasiswa', $request->jenis_beasiswa);

    }

    /*
    |--------------------------------------------------------------------------
    | Filter Status
    |--------------------------------------------------------------------------
    */
    if ($request->filled('status')) {

        $query->where('status', $request->status);

    }

    /*
    |--------------------------------------------------------------------------
    | Data Mahasiswa
    |--------------------------------------------------------------------------
    */
    $mahasiswas = $query
        ->latest()
        ->paginate(10)
        ->withQueryString();

    /*
    |--------------------------------------------------------------------------
    | Dropdown Tahun
    |--------------------------------------------------------------------------
    */
    $tahuns = Mahasiswa::select('tahun')
        ->distinct()
        ->orderByDesc('tahun')
        ->pluck('tahun');

    /*
    |--------------------------------------------------------------------------
    | Statistik Dashboard
    |--------------------------------------------------------------------------
    */
    $totalMahasiswa = Mahasiswa::count();

    $totalAktif = Mahasiswa::where('status', 'Aktif')->count();

    $totalNonaktif = Mahasiswa::where('status', 'Nonaktif')->count();

    $totalDana = Mahasiswa::sum('nominal_beasiswa');

    return view('admin.mahasiswa.index', compact(
        'mahasiswas',
        'tahuns',
        'totalMahasiswa',
        'totalAktif',
        'totalNonaktif',
        'totalDana'
    ));
}

    /**
     * Halaman import Excel.
     */
    public function import()
    {
        return view('admin.mahasiswa.import');
    }

    /**
     * Proses import Excel.
     */
  public function storeImport(Request $request)
{
    $request->validate([

        'file'=>'required|mimes:xlsx,xls'

    ]);

    $import = new MahasiswaImport();

    DB::beginTransaction();

    try{

        Excel::import(
            $import,
            $request->file('file')
        );

        ImportLog::create([

            'user_id'=>auth()->id(),

            'nama_file'=>$request->file('file')->getClientOriginalName(),

            'total_data'=>$import->berhasil+$import->duplikat,

            'berhasil'=>$import->berhasil,

            'duplikat'=>$import->duplikat,

            'gagal'=>count($import->failures()),

            'tanggal_import'=>now()

        ]);

        DB::commit();

        return redirect()
            ->route('admin.mahasiswa.index')
            ->with(
                'success',
                "Import selesai.
                Berhasil : {$import->berhasil},
                Duplikat : {$import->duplikat},
                Gagal : ".count($import->failures())
            );

    }catch(\Exception $e){

        DB::rollBack();

        return back()->withErrors([

            'file'=>$e->getMessage()

        ]);

    }

}

    /**
     * Detail mahasiswa.
     */
    public function show(Mahasiswa $mahasiswa)
    {
        return view('admin.mahasiswa.show', compact('mahasiswa'));
    }

    /**
     * Form edit.
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        return view('admin.mahasiswa.edit', compact('mahasiswa'));
    }

    /**
     * Update data.
     */
  public function update(
    UpdateMahasiswaRequest $request,
    Mahasiswa $mahasiswa
)
{
    $mahasiswa->update([

        'email' => $request->email,

        'no_hp' => $request->no_hp,

        'status' => $request->status,

    ]);

    if ($mahasiswa->user) {

        $mahasiswa->user->update([

            'email' => $request->email,

        ]);

    }

    return redirect()
        ->route('admin.mahasiswa.index')
        ->with(
            'success',
            'Data mahasiswa berhasil diperbarui.'
        );
}

    /**
     * Hapus data.
     */
   public function destroy(Mahasiswa $mahasiswa)
{
    // Hapus akun user jika ada
    if ($mahasiswa->user) {
        $mahasiswa->user->delete();
    }

    // Hapus data mahasiswa
    $mahasiswa->delete();

    return redirect()
        ->route('admin.mahasiswa.index')
        ->with('success', 'Data mahasiswa berhasil dihapus.');
}


public function downloadTemplate()
{
    return Excel::download(
        new MahasiswaTemplateExport(),
        'Template-Import-Mahasiswa.xlsx'
    );
}


public function riwayatImport()
{
    $logs = ImportLog::latest()->paginate(10);

    return view(
        'admin.mahasiswa.riwayat-import',
        compact('logs')
    );
}

}