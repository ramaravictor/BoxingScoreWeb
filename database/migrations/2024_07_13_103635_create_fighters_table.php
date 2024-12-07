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
            $table->text('description')->nullable();
            //$table->boolean('available')->default(true); // Apakah petarung tersedia untuk bertarung
            $table->string('image')->nullable(); // URL atau path ke gambar petarung
            $table->string('weight_class')->nullable(); // Kelas berat petarung (opsional)
            $table->date('birthdate')->nullable(); // Tanggal lahir petarung (opsional)
            $table->integer('wins')->default(0); // Jumlah kemenangan
            $table->integer('losses')->default(0); // Jumlah kekalahan
            $table->integer('draws')->default(0); // Jumlah seri
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
