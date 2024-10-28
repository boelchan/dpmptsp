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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignId('kategori_id')->references('id')->on('categories');
            $table->string('judul');
            $table->string('slug');
            $table->string('meta_keywords')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('gambar')->nullable();
            $table->text('konten')->nullable();
            $table->string('tampil_banner', 5)->default('tidak');
            $table->string('publish', 5)->default('ya');
            $table->dateTime('publish_at')->nullable();
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
        Schema::dropIfExists('posts');
    }
};
