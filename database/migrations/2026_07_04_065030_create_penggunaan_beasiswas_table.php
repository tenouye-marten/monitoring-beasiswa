<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penggunaan_beasiswas', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Mahasiswa
            |--------------------------------------------------------------------------
            */

            $table->foreignId('mahasiswa_id')
                ->constrained('penerima_beasiswas')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Kategori Penggunaan
            |--------------------------------------------------------------------------
            */

            $table->foreignId('kategori_penggunaan_id')
                ->constrained('kategori_penggunaans')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Data Penggunaan Dana
            |--------------------------------------------------------------------------
            */

            // Judul penggunaan dana
            $table->string('judul');

            // Tanggal penggunaan
            $table->date('tanggal');

            // Nominal
            $table->decimal('nominal', 15, 2);

            // Deskripsi
            $table->text('deskripsi');

            /*
            |--------------------------------------------------------------------------
            | Lampiran
            |--------------------------------------------------------------------------
            */

            // Bukti transaksi (wajib)
            $table->string('bukti_transaksi');

            // Dokumentasi (opsional)
            $table->string('dokumentasi')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Monitoring
            |--------------------------------------------------------------------------
            */

            // Catatan dari Admin / Keuangan
            $table->text('catatan_monitoring')->nullable();

            // Peringatan kepada mahasiswa
            $table->text('peringatan')->nullable();

            // Petugas monitoring
            $table->foreignId('dimonitor_oleh')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Tanggal monitoring
            $table->timestamp('tanggal_monitoring')
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penggunaan_beasiswas');
    }
};