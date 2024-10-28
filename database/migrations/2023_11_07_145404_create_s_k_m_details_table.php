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
        Schema::create('skm_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('skm_id')->references('id')->on('survei_kepuasan_masyarakat');
            $table->foreignId('ikm_id')->references('id')->on('indeks_kepuasan_masyarakat');
            $table->float('bobot');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skm_detail');
    }
};
