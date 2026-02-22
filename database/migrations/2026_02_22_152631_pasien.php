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
        Schema::create('pasien', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_lahir');
            $table->integer('usia');
            $table->string('nik')->unique();
            $table->string('no_hp');
            $table->string('nama_pasien');
            $table->text('alamat')->nullable();
            $table->text('keterangan')->nullable();

            $table->foreignId('desa_id')
                ->constrained('desa') // use constrained to specify the foreign key relationship
                ->onDelete('cascade');

            $table->foreignId('jenis_kelamin_id')
                ->constrained('jenis_kelamin')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasien');
    }
};
