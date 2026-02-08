<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            // rename kolom lama
            $table->renameColumn('tanggal_kembali', 'tanggal_kembali_rencana');

            // tambah kolom aktual (boleh null karena belum dikembalikan)
            $table->date('tanggal_kembali_aktual')->nullable()->after('tanggal_kembali_rencana');
        });
    }

    public function down(): void
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->renameColumn('tanggal_kembali_rencana', 'tanggal_kembali');
            $table->dropColumn('tanggal_kembali_aktual');
        });
    }
};
