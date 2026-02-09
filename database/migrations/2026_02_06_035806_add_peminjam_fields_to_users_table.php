<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('no_telpon')->nullable()->after('email');
            $table->text('alamat')->nullable()->after('no_telpon');
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan'])->nullable()->after('alamat');
            $table->string('foto')->nullable()->after(column: 'jenis_kelamin');
        });
    } 

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['no_telpon', 'alamat', 'jenis_kelamin', 'foto']);
        });
    }
};
