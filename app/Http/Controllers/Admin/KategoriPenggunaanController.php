<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriPenggunaan;
use Illuminate\Http\Request;

class KategoriPenggunaanController extends Controller
{
   /**
 * Menampilkan daftar kategori penggunaan.
 */
public function index(Request $request)
{
    $query = KategoriPenggunaan::query();

    /*
    |--------------------------------------------------------------------------
    | Pencarian
    |--------------------------------------------------------------------------
    */

    if ($request->filled('search')) {

        $search = $request->search;

        $query->where(function ($q) use ($search) {

            $q->where('nama', 'like', "%{$search}%")
              ->orWhere('keterangan', 'like', "%{$search}%");

        });

    }

    /*
    |--------------------------------------------------------------------------
    | Filter Status
    |--------------------------------------------------------------------------
    */

    if ($request->filled('status')) {

        $query->where('status', $request->status);

    }

    $kategoriPenggunaans = $query
        ->latest()
        ->paginate(10)
        ->withQueryString();

    /*
    |--------------------------------------------------------------------------
    | Statistik
    |--------------------------------------------------------------------------
    */

    $totalKategori = KategoriPenggunaan::count();

    $kategoriAktif = KategoriPenggunaan::where('status', true)->count();

    $kategoriNonaktif = KategoriPenggunaan::where('status', false)->count();

    return view(
        'admin.kategori-penggunaan.index',
        compact(
            'kategoriPenggunaans',
            'totalKategori',
            'kategoriAktif',
            'kategoriNonaktif'
        )
    );
}

    /**
     * Show the form for creating a new resource.
     */
   /**
 * Form tambah kategori.
 */
public function create()
{
    return view('admin.kategori-penggunaan.create');
}

    /**
     * Store a newly created resource in storage.
     */
   /**
 * Simpan kategori baru.
 */
public function store(Request $request)
{
    $validated = $request->validate([

        'nama' => 'required|string|max:100|unique:kategori_penggunaans,nama',

        'keterangan' => 'nullable|string',

        'status' => 'required|boolean',

    ]);

    KategoriPenggunaan::create($validated);

    return redirect()
        ->route('admin.kategori-penggunaan.index')
        ->with('success', 'Kategori penggunaan berhasil ditambahkan.');
}

    /**
     * Display the specified resource.
     */
  /**
 * Detail kategori penggunaan.
 */
public function show(KategoriPenggunaan $kategoriPenggunaan)
{
    return view(
        'admin.kategori-penggunaan.show',
        compact('kategoriPenggunaan')
    );
}

    /**
     * Show the form for editing the specified resource.
     */
   /**
 * Form edit kategori.
 */
public function edit(KategoriPenggunaan $kategoriPenggunaan)
{
    return view(
        'admin.kategori-penggunaan.edit',
        compact('kategoriPenggunaan')
    );
}

    /**
     * Update the specified resource in storage.
     */
   /**
 * Update kategori.
 */
public function update(Request $request, KategoriPenggunaan $kategoriPenggunaan)
{
    $validated = $request->validate([

        'nama' => 'required|string|max:100|unique:kategori_penggunaans,nama,' . $kategoriPenggunaan->id,

        'keterangan' => 'nullable|string',

        'status' => 'required|boolean',

    ]);

    $kategoriPenggunaan->update($validated);

    return redirect()
        ->route('admin.kategori-penggunaan.index')
        ->with('success', 'Kategori penggunaan berhasil diperbarui.');
}

    /**
     * Remove the specified resource from storage.
     */
  /**
 * Hapus kategori penggunaan.
 */
public function destroy(KategoriPenggunaan $kategoriPenggunaan)
{
    $kategoriPenggunaan->delete();

    return redirect()
        ->route('admin.kategori-penggunaan.index')
        ->with(
            'success',
            'Kategori penggunaan berhasil dihapus.'
        );
}
}
