<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('alats', function (Blueprint $table) {
            $table->dropColumn('kode_alat');
        });
    }

    public function down()
    {
        Schema::table('alats', function (Blueprint $table) {
            $table->integer('kode_alat')->unique();
        });
    }
};
