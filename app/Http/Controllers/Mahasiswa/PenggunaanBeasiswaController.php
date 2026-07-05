<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePenggunaanBeasiswaRequest;
use App\Http\Requests\UpdatePenggunaanBeasiswaRequest;
use App\Models\KategoriPenggunaan;
use App\Models\PenggunaanBeasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PenggunaanBeasiswaController extends Controller
{
    /**
     * ==========================================================================
     * Menampilkan daftar penggunaan dana mahasiswa.
     * ==========================================================================
     */
    public function index(Request $request)
    {
        $mahasiswa = Auth::user()->mahasiswa;

        $query = PenggunaanBeasiswa::with([
                'kategori',
                'petugas',
            ])
            ->where('mahasiswa_id', $mahasiswa->id);

        /*
        |--------------------------------------------------------------------------
        | Pencarian
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $query->where(function ($q) use ($request) {

                $q->where('deskripsi', 'like', '%' . $request->search . '%')
                  ->orWhere('nominal', 'like', '%' . $request->search . '%');

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
        | Data
        |--------------------------------------------------------------------------
        */

        $penggunaans = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | Statistik
        |--------------------------------------------------------------------------
        */

        $totalBeasiswa = $mahasiswa->nominal_beasiswa;

        $totalDigunakan = PenggunaanBeasiswa::where(
                'mahasiswa_id',
                $mahasiswa->id
            )->sum('nominal');

        $sisaDana = $totalBeasiswa - $totalDigunakan;

        /*
        |--------------------------------------------------------------------------
        | Kategori
        |--------------------------------------------------------------------------
        */

        $kategoriPenggunaans = KategoriPenggunaan::where(
                'status',
                true
            )
            ->orderBy('nama')
            ->get();

        return view(
            'mahasiswa.penggunaan-beasiswa.index',
            compact(
                'penggunaans',
                'kategoriPenggunaans',
                'totalBeasiswa',
                'totalDigunakan',
                'sisaDana'
            )
        );
    }

    /**
     * ==========================================================================
     * Form tambah penggunaan dana.
     * ==========================================================================
     */
    public function create()
    {
        $kategoriPenggunaans = KategoriPenggunaan::where(
                'status',
                true
            )
            ->orderBy('nama')
            ->get();

        return view(
            'mahasiswa.penggunaan-beasiswa.create',
            compact('kategoriPenggunaans')
        );
    }

        /**
     * ==========================================================================
     * Simpan penggunaan dana.
     * ==========================================================================
     */
    public function store(StorePenggunaanBeasiswaRequest $request)
    {
        $mahasiswa = Auth::user()->mahasiswa;

        /*
        |--------------------------------------------------------------------------
        | Hitung Total Penggunaan Dana
        |--------------------------------------------------------------------------
        */

        $totalDigunakan = PenggunaanBeasiswa::where(
            'mahasiswa_id',
            $mahasiswa->id
        )->sum('nominal');

        /*
        |--------------------------------------------------------------------------
        | Validasi Nominal
        |--------------------------------------------------------------------------
        */

        if (($totalDigunakan + $request->nominal) > $mahasiswa->nominal_beasiswa) {

            return back()
                ->withInput()
                ->withErrors([

                    'nominal' => 'Nominal penggunaan dana melebihi total beasiswa yang diterima.'

                ]);

        }

        DB::beginTransaction();

        try {

            /*
            |--------------------------------------------------------------------------
            | Upload Bukti Transaksi
            |--------------------------------------------------------------------------
            */

            $buktiTransaksi = $request
                ->file('bukti_transaksi')
                ->store(
                    'penggunaan-dana/bukti-transaksi',
                    'public'
                );

            /*
            |--------------------------------------------------------------------------
            | Upload Dokumentasi
            |--------------------------------------------------------------------------
            */

            $dokumentasi = null;

            if ($request->hasFile('dokumentasi')) {

                $dokumentasi = $request
                    ->file('dokumentasi')
                    ->store(
                        'penggunaan-dana/dokumentasi',
                        'public'
                    );

            }

            /*
            |--------------------------------------------------------------------------
            | Simpan Data
            |--------------------------------------------------------------------------
            */

            PenggunaanBeasiswa::create([

                'mahasiswa_id' => $mahasiswa->id,
                'judul' => $request->judul,

                'kategori_penggunaan_id' => $request->kategori_penggunaan_id,

                'tanggal' => $request->tanggal,

                'nominal' => $request->nominal,

                'deskripsi' => $request->deskripsi,

                'bukti_transaksi' => $buktiTransaksi,

                'dokumentasi' => $dokumentasi,

                /*
                |--------------------------------------------------------------------------
                | Monitoring
                |--------------------------------------------------------------------------
                | Dibiarkan NULL sampai Admin / Keuangan melakukan monitoring.
                */

                'catatan_monitoring' => null,

                'peringatan' => null,

                'dimonitor_oleh' => null,

                'tanggal_monitoring' => null,

            ]);

            DB::commit();

            return redirect()
                ->route('mahasiswa.penggunaan-beasiswa.index')
                ->with(
                    'success',
                    'Penggunaan dana berhasil disimpan.'
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


        /**
     * ==========================================================================
     * Detail Penggunaan Dana
     * ==========================================================================
     */
    public function show(PenggunaanBeasiswa $penggunaanBeasiswa)
    {
        /*
        |--------------------------------------------------------------------------
        | Validasi Kepemilikan Data
        |--------------------------------------------------------------------------
        */

        abort_if(
            $penggunaanBeasiswa->mahasiswa_id != Auth::user()->mahasiswa->id,
            403
        );

        /*
        |--------------------------------------------------------------------------
        | Load Relasi
        |--------------------------------------------------------------------------
        */

        $penggunaanBeasiswa->load([
            'kategori',
            'petugas',
        ]);

        return view(
            'mahasiswa.penggunaan-beasiswa.show',
            compact('penggunaanBeasiswa')
        );
    }

    /**
     * ==========================================================================
     * Form Edit Penggunaan Dana
     * ==========================================================================
     */
    public function edit(PenggunaanBeasiswa $penggunaanBeasiswa)
    {
        /*
        |--------------------------------------------------------------------------
        | Validasi Kepemilikan Data
        |--------------------------------------------------------------------------
        */

        abort_if(
            $penggunaanBeasiswa->mahasiswa_id != Auth::user()->mahasiswa->id,
            403
        );

        /*
        |--------------------------------------------------------------------------
        | Data Kategori
        |--------------------------------------------------------------------------
        */

        $kategoriPenggunaans = KategoriPenggunaan::where(
                'status',
                true
            )
            ->orderBy('nama')
            ->get();

        return view(
            'mahasiswa.penggunaan-beasiswa.edit',
            compact(
                'penggunaanBeasiswa',
                'kategoriPenggunaans'
            )
        );
    }


        /**
     * ==========================================================================
     * Update Penggunaan Dana
     * ==========================================================================
     */
    public function update(
        UpdatePenggunaanBeasiswaRequest $request,
        PenggunaanBeasiswa $penggunaanBeasiswa
    ) {
        /*
        |--------------------------------------------------------------------------
        | Validasi Kepemilikan Data
        |--------------------------------------------------------------------------
        */

        abort_if(
            $penggunaanBeasiswa->mahasiswa_id != Auth::user()->mahasiswa->id,
            403
        );

        $mahasiswa = Auth::user()->mahasiswa;

        /*
        |--------------------------------------------------------------------------
        | Hitung Total Penggunaan Dana
        |--------------------------------------------------------------------------
        */

        $totalDigunakan = PenggunaanBeasiswa::where(
                'mahasiswa_id',
                $mahasiswa->id
            )
            ->where('id', '!=', $penggunaanBeasiswa->id)
            ->sum('nominal');

        if (($totalDigunakan + $request->nominal) > $mahasiswa->nominal_beasiswa) {

            return back()
                ->withInput()
                ->withErrors([

                    'nominal' => 'Nominal penggunaan dana melebihi total beasiswa.'

                ]);

        }

        DB::beginTransaction();

        try {

            /*
            |--------------------------------------------------------------------------
            | Upload Bukti Transaksi
            |--------------------------------------------------------------------------
            */

            $buktiTransaksi = $penggunaanBeasiswa->bukti_transaksi;

            if ($request->hasFile('bukti_transaksi')) {

                if ($buktiTransaksi && Storage::disk('public')->exists($buktiTransaksi)) {

                    Storage::disk('public')->delete($buktiTransaksi);

                }

                $buktiTransaksi = $request
                    ->file('bukti_transaksi')
                    ->store(
                        'penggunaan-dana/bukti-transaksi',
                        'public'
                    );
            }

            /*
            |--------------------------------------------------------------------------
            | Upload Dokumentasi
            |--------------------------------------------------------------------------
            */

            $dokumentasi = $penggunaanBeasiswa->dokumentasi;

            if ($request->hasFile('dokumentasi')) {

                if ($dokumentasi && Storage::disk('public')->exists($dokumentasi)) {

                    Storage::disk('public')->delete($dokumentasi);

                }

                $dokumentasi = $request
                    ->file('dokumentasi')
                    ->store(
                        'penggunaan-dana/dokumentasi',
                        'public'
                    );
            }

            /*
            |--------------------------------------------------------------------------
            | Update Data
            |--------------------------------------------------------------------------
            */

            $penggunaanBeasiswa->update([
                'judul' => $request->judul,

                'kategori_penggunaan_id' => $request->kategori_penggunaan_id,

                'tanggal' => $request->tanggal,

                'nominal' => $request->nominal,

                'deskripsi' => $request->deskripsi,

                'bukti_transaksi' => $buktiTransaksi,

                'dokumentasi' => $dokumentasi,

                /*
                |--------------------------------------------------------------------------
                | Reset Monitoring
                |--------------------------------------------------------------------------
                */

                'catatan_monitoring' => null,

                'peringatan' => null,

                'dimonitor_oleh' => null,

                'tanggal_monitoring' => null,

            ]);

            DB::commit();

            return redirect()
                ->route('mahasiswa.penggunaan-beasiswa.index')
                ->with(
                    'success',
                    'Penggunaan dana berhasil diperbarui.'
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

        /**
     * ==========================================================================
     * Hapus Penggunaan Dana
     * ==========================================================================
     */
    public function destroy(PenggunaanBeasiswa $penggunaanBeasiswa)
    {
        /*
        |--------------------------------------------------------------------------
        | Validasi Kepemilikan Data
        |--------------------------------------------------------------------------
        */

        abort_if(
            $penggunaanBeasiswa->mahasiswa_id != Auth::user()->mahasiswa->id,
            403
        );

        DB::beginTransaction();

        try {

            /*
            |--------------------------------------------------------------------------
            | Hapus Bukti Transaksi
            |--------------------------------------------------------------------------
            */

            if (
                $penggunaanBeasiswa->bukti_transaksi &&
                Storage::disk('public')->exists($penggunaanBeasiswa->bukti_transaksi)
            ) {

                Storage::disk('public')->delete(
                    $penggunaanBeasiswa->bukti_transaksi
                );

            }

            /*
            |--------------------------------------------------------------------------
            | Hapus Dokumentasi
            |--------------------------------------------------------------------------
            */

            if (
                $penggunaanBeasiswa->dokumentasi &&
                Storage::disk('public')->exists($penggunaanBeasiswa->dokumentasi)
            ) {

                Storage::disk('public')->delete(
                    $penggunaanBeasiswa->dokumentasi
                );

            }

            /*
            |--------------------------------------------------------------------------
            | Hapus Data
            |--------------------------------------------------------------------------
            */

            $penggunaanBeasiswa->delete();

            DB::commit();

            return redirect()
                ->route('mahasiswa.penggunaan-beasiswa.index')
                ->with(
                    'success',
                    'Penggunaan dana berhasil dihapus.'
                );

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->withErrors([

                'error' => $e->getMessage()

            ]);

        }
    }
}