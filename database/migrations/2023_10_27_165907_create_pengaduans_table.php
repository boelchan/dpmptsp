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
        Schema::create('pengaduan', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignId('instansi_id')->references('id')->on('instansi')->onDelete('cascade');
            $table->string('nama_pemohon', 100);
            $table->string('no_identitas', 100);
            $table->string('telepon', 20)->nullable();
            $table->string('email', 50)->nullable();
            $table->text('pengaduan');
            $table->text('tanggapan')->nullable();
            $table->enum('status', ['baru', 'valid', 'selesai'])->default('baru');
            $table->dateTime('validasi_at')->nullable();
            $table->dateTime('tanggapan_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduan');
    }
};
