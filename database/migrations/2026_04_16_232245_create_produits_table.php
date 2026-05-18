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
        Schema::create('produits', function (Blueprint $table) {

            $table->id();

            // Informations produit
            $table->string('nom');
            $table->text('description')->nullable();
            $table->string('categorie');
            $table->string('code_produit')->nullable();

            // Gestion stock
            $table->integer('quantite')->default(0);
            $table->integer('stock_minimum')->default(5);
            $table->integer('stock_maximum')->nullable();

            // Prix
            $table->decimal('prix', 10, 2)->default(0);

            // Localisation
            $table->string('agence')->nullable();
            $table->string('emplacement')->nullable();

            // IA
            $table->longText('fiche_ia')->nullable();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produits');
    }
};
