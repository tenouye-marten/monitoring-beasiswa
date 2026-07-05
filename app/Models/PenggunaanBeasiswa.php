<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PenggunaanBeasiswa extends Model
{
    use HasFactory;

    protected $fillable = [
    'mahasiswa_id',
    'kategori_penggunaan_id',

    'judul',
    'tanggal',
    'nominal',
    'deskripsi',

    'bukti_transaksi',
    'dokumentasi',

    'catatan_monitoring',
    'peringatan',
    'dimonitor_oleh',
    'tanggal_monitoring',
];
    protected $casts = [
        'tanggal'             => 'date',
        'tanggal_monitoring'  => 'datetime',
        'nominal'             => 'decimal:2',
    ];

    /**
     * Relasi Mahasiswa
     */
    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(
            Mahasiswa::class,
            'mahasiswa_id'
        );
    }

    /**
     * Relasi Kategori Penggunaan
     */
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(
            KategoriPenggunaan::class,
            'kategori_penggunaan_id'
        );
    }

    /**
     * Relasi Petugas Monitoring
     */
    public function petugas(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'dimonitor_oleh'
        );
    }
}