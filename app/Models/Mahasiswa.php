<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mahasiswa extends Model
{
    protected $table = 'penerima_beasiswas';

    protected $fillable = [
        'user_id',
        'nama',
        'nim',
        'email',
        'no_hp',
        'perguruan_tinggi',
        'program_studi',
        'jenis_beasiswa',
        'tahun',
        'semester',
        'nominal_beasiswa',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

   /**
 * Relasi penggunaan dana.
 */
/*
|--------------------------------------------------------------------------
| Penggunaan Dana
|--------------------------------------------------------------------------
*/

public function penggunaanBeasiswas()
{
    return $this->hasMany(
        PenggunaanBeasiswa::class,
        'mahasiswa_id'
    );
}

}