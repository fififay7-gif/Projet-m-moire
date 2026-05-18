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
        Schema::create('fiche_i_a_s', function (Blueprint $table) {

            $table->id();

            // Produit lié
            $table->foreignId('produit_id')
                  ->constrained()
                  ->onDelete('cascade');

            // Contenu IA
            $table->longText('contenu_ia');

            // Type contenu
            $table->string('type_generation')->nullable();

            // Auteur génération
            $table->string('genere_par')->nullable();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fiche_i_a_s');
    }
};
