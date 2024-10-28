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
        Schema::create('antrian_detail', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->integer('antrian_id');
            $table->integer('no_antrian');
            $table->integer('layanan_id')->nullable();
            $table->integer('kepuasan')->nullable();
            $table->text('masukan')->nullable();
            $table->dateTime('skm_created_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('antrian_detail');
    }
};
