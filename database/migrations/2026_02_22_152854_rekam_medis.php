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
        Schema::create('rekam_medis', function (Blueprint $table) {
            $table->id();
            $table->integer('diastolik');
            $table->integer('sistolik');
            $table->date('tanggal_kunjungan');

            $table->foreignId('pasien_id')
                ->constrained('pasien')
                ->onDelete('cascade');

            $table->foreignId('petugas_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->text('kepatuhan')->nullable();
            $table->text('obat_diberikan')->nullable();
            $table->text('keterangan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekam_medis');
    }
};
