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
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('activity_type'); // create, update, delete, view, login, logout
            $table->text('description');
            $table->string('module'); // Kategori, Alat, Peminjaman, Pengembalian, Petugas, Peminjam
            $table->string('model_type')->nullable(); // nama model
            $table->unsignedBigInteger('model_id')->nullable(); // id dari model
            $table->json('old_value')->nullable(); // nilai lama
            $table->json('new_value')->nullable(); // nilai baru
            $table->ipAddress('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamps();
            
            // Indexes untuk performa query
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->index('activity_type');
            $table->index('module');
            $table->index('model_type');
            $table->index('created_at');
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
