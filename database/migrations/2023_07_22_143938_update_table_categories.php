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
        Schema::table('categories', function (Blueprint $table) {
            $table->enum('add_to_header_menu', ['ya', 'tidak'])->default('tidak')->after('is_primary');
            $table->enum('add_to_footer_menu', ['ya', 'tidak'])->default('tidak')->after('add_to_header_menu');
            $table->enum('add_to_sidebar_menu', ['ya', 'tidak'])->default('tidak')->after('add_to_footer_menu');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn(['add_to_header_menu', 'add_to_sidebar_menu', 'add_to_footer_menu']);
        });
    }
};
