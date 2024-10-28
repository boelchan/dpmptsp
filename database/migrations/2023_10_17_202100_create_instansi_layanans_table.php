<?php

use App\Enum\JenisPerizinanEnum;
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
        Schema::create('instansi_layanan', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignId('instansi_id')->references('id')->on('instansi')->cascadeOnDelete();
            $table->string('nama');
            $table->string('slug');
            $table->string('meta_keywords')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('jenis')->default(JenisPerizinanEnum::PERIZINAN->value);
            $table->string('link')->nullable();
            $table->text('konten')->nullable();
            $table->text('alur')->nullable();
            $table->text('syarat')->nullable();
            $table->string('publish', 5)->default('ya');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instansi_layanan');
    }
};
