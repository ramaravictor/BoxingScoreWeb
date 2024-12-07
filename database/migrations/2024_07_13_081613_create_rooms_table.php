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
            // ID Room terdiri dari 5 angka unik
            $table->id()->startingValue(10000); // Memastikan ID dimulai dari 5 digit
            $table->string('image')->nullable();
            $table->string('name'); // Nama room
            $table->string('class'); // Kelas atau kategori room
            $table->dateTime('schedule'); // Jadwal pertandingan (format: tanggal, bulan, tahun, jam)
            $table->string('location'); // Lokasi pertandingan
            $table->boolean('availability')->default(true); // Ketersediaan room
            $table->timestamps(); // Waktu dibuat dan diperbarui
            $table->softDeletes();

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
