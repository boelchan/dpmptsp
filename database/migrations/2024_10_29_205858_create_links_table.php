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
        Schema::create('links', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->string('nama');
            $table->string('slug');
            $table->string('url');
            $table->string('meta_keywords')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('icon')->nullable();
            $table->text('konten')->nullable();
            $table->string('publish', 5)->default('ya');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('links');
    }
};
