<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFightersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fighters', function (Blueprint $table) {
            $table->id(); // ID petarung
            $table->string('name'); // Nama petarung
            $table->date('birthdate')->nullable(); // Tanggal lahir petarung (opsional)
            $table->string('weight_class')->nullable(); // Kelas berat petarung (opsional)
            $table->string('champions')->nullable(); // tittle kejuaraan
            $table->string('image')->nullable(); // URL atau path ke gambar petarung
            $table->timestamps(); // Timestamps created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fighters');
    }
}
