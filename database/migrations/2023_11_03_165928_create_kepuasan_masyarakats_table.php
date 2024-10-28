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
        Schema::create('survei_kepuasan_masyarakat', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignId('instansi_id')->references('id')->on('instansi');
            $table->foreignId('layanan_id')->references('id')->on('instansi_layanan');
            $table->text('ulasan')->nullable();
            $table->float('bobot')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('survei_kepuasan_masyarakat');
    }
};
