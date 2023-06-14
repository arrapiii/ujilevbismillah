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
        Schema::create('konseling_bks', function (Blueprint $table) {
            $table->id();
            $table->dateTime('waktu');
            $table->string('tempat');
            $table->string('status');
            $table->text('hasil_konseling')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('layanan_id');
            $table->foreign('layanan_id')->references('id')->on('layanan_bks')->onDelete('cascade');
            $table->unsignedBigInteger('guru_id');
            $table->foreign('guru_id')->references('id')->on('gurus')->onDelete('cascade');
            $table->unsignedBigInteger('walas_id');
            $table->foreign('walas_id')->references('id')->on('wali_kelas')->onDelete('cascade');
            $table->unsignedBigInteger('siswa_id');
            $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konselings');
    }
};
