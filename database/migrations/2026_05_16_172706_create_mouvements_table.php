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
        Schema::create('mouvements', function (Blueprint $table) {

            $table->id();

            // Relation produit
            $table->foreignId('produit_id')
                  ->constrained()
                  ->onDelete('cascade');

            // Entrée ou sortie
            $table->enum('type', ['entree', 'sortie']);

            // Quantité
            $table->integer('quantite');

            // Informations
            $table->text('motif')->nullable();
            $table->string('agent')->nullable();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mouvements');
    }
};
