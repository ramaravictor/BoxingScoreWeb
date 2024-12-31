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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('name'); // Nama Room
            $table->string('weight_class'); // Kategori/Kelas
            $table->dateTime('schedule'); // Jadwal
            $table->boolean('availability')->default(true); // Ketersediaan
            $table->string('image')->nullable(); // Gambar Room

            // Foreign Key ke Tabel Fighters
            $table->foreignId('red_corner_id')
                ->nullable()
                ->constrained('fighters') // Relasi ke tabel fighters
                ->nullOnDelete(); // Jika data fighter dihapus, set null

            $table->foreignId('blue_corner_id')
                ->nullable()
                ->constrained('fighters') // Relasi ke tabel fighters
                ->nullOnDelete(); // Jika data fighter dihapus, set null

            $table->timestamps(); // Waktu dibuat dan diperbarui
            $table->softDeletes(); // Soft delete
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
