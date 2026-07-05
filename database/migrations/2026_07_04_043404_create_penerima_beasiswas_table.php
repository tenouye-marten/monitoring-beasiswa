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
        Schema::create('penerima_beasiswas', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('nama');

            $table->string('nim')->unique();

            $table->string('email')->unique();

            $table->string('no_hp')->nullable();

            $table->string('perguruan_tinggi');

            $table->string('program_studi');

            $table->string('jenis_beasiswa');

            $table->year('tahun');

            $table->string('semester');

            $table->decimal('nominal_beasiswa', 15, 2);

            $table->enum('status', [
                'Aktif',
                'Nonaktif'
            ])->default('Aktif');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penerima_beasiswas');
    }
};