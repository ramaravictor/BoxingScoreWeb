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
        Schema::create('round_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('room_id')->constrained()->onDelete('cascade');
            $table->integer('round_number');
            $table->integer('red_point')->default(0);
            $table->integer('red_kd')->default(0);
            $table->integer('red_damage')->default(0);
            $table->integer('red_foul')->default(0);
            $table->decimal('red_score', 5, 2)->default(0);
            $table->integer('blue_point')->default(0);
            $table->integer('blue_kd')->default(0);
            $table->integer('blue_damage')->default(0);
            $table->integer('blue_foul')->default(0);
            $table->decimal('blue_score', 5, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('round_scores');
    }
};
