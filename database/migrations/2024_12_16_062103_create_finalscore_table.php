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
            $table->integer('damage_red')->default(0);
            $table->integer('damage_blue')->default(0);
            $table->integer('knock_red')->default(0);
            $table->integer('knock_blue')->default(0);
            $table->integer('penalty_red')->default(0);
            $table->integer('penalty_blue')->default(0);
            $table->decimal('total_red', 5, 2)->default(0);
            $table->decimal('total_blue', 5, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finalscore');
    }
};
