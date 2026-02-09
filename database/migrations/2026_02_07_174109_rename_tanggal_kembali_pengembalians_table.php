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
        Schema::table('pengembalians', function (Blueprint $table) {
            $table->renameColumn('tanggal_kembali', 'tanggal_kembali_aktual');
        });
    }

    public function down()
    {
        Schema::table('pengembalians', function (Blueprint $table) {
            $table->renameColumn('tanggal_kembali_aktual', 'tanggal_kembali');
        });
    }
};
