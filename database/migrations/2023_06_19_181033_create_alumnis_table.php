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
        Schema::create('alumnis', function (Blueprint $table) {
            $table->id();
            $table->string('foto', 250);
            $table->string('nama', 50);
            $table->string('domisili', 100);
            $table->string('email', 100)->nullable();
            $table->string('no_hp', 12)->nullable();
            $table->year('tahun_lulus');
            $table->enum('jurusan', ['ipa', 'ips', 'bahasa']);
            $table->string('pekerjaan')->nullable();
            $table->enum('approved', ['yes', 'no'])->default('no');
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
        Schema::dropIfExists('alumnis');
    }
};
