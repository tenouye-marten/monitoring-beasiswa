<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KategoriPenggunaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'keterangan',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    /*
|--------------------------------------------------------------------------
| Penggunaan Dana
|--------------------------------------------------------------------------
*/

public function penggunaanBeasiswas()
{
    return $this->hasMany(
        PenggunaanBeasiswa::class,
        'kategori_penggunaan_id'
    );
}
}