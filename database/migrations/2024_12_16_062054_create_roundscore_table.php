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
        Schema::create('finalscores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->constrained('rooms')->onDelete('cascade'); // Relasi ke tabel rooms
            $table->integer('round');
            $table->string('winner'); // red/blue
            $table->string('method'); // KO/TKO, Decision-Point, Disqualified
            $table->decimal('score_ave_red', 5, 2); // Skor rata-rata Red
            $table->decimal('score_ave_blue', 5, 2); // Skor rata-rata Blue
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roundscore');
    }
};
