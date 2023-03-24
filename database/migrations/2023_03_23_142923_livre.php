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
        Schema::create('livres', function (Blueprint $table) {
      
        $table->id();
        $table->string('title');
        $table->string('isbn');
        $table->integer('pages_number');
        $table->enum('emplacement', ['placeA', 'palceB', 'placeC'])->default('placeA');
        $table->enum('status', ['disponible', 'indisponible', 'emprunté'])->default('disponible');
        $table->text('contenu');
        $table->timestamps();


        $table->unsignedBigInteger('collectionId');
        $table->foreign('collectionId')->references('id')->on('collections');
        $table->unsignedBigInteger('genreId');
        $table->foreign('genreId')->references('id')->on('genres');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livres');
    }
};
