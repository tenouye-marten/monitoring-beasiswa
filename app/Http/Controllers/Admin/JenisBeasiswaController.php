<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisBeasiswa;
use Illuminate\Http\Request;

class JenisBeasiswaController extends Controller
{
    public function index()
    {
        $jenisBeasiswas = JenisBeasiswa::latest()->get();

        return view('admin.jenis-beasiswa.index', compact('jenisBeasiswas'));
    }

    public function create()
    {
        return view('admin.jenis-beasiswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'keterangan' => 'nullable',
        ]);

        JenisBeasiswa::create($request->only('nama', 'keterangan'));

        return redirect()
            ->route('admin.jenis-beasiswa.index')
            ->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit(JenisBeasiswa $jenis_beasiswa)
    {
        return view('admin.jenis-beasiswa.edit', compact('jenis_beasiswa'));
    }

    public function update(Request $request, JenisBeasiswa $jenis_beasiswa)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'keterangan' => 'nullable',
        ]);

        $jenis_beasiswa->update($request->only('nama', 'keterangan'));

        return redirect()
            ->route('admin.jenis-beasiswa.index')
            ->with('success', 'Data berhasil diubah.');
    }

    public function destroy(JenisBeasiswa $jenis_beasiswa)
    {
        $jenis_beasiswa->delete();

        return redirect()
            ->route('admin.jenis-beasiswa.index')
            ->with('success', 'Data berhasil dihapus.');
    }
}