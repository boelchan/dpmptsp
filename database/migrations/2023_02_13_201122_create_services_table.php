<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->string('nama');
            $table->string('slug');
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
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
};
