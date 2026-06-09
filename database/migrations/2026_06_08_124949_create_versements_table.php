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
    Schema::create('versements', function (Blueprint $table) {
        $table->id();
        $table->string('reference_versement')->unique(); // Numéro de reçu bancaire
        $table->decimal('montant', 15, 2); // Pour gérer proprement les montants FCFA
        $table->string('banque'); // Exemple: CBAO, SGBS, Ecobank...
        $table->date('date_versement');
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // L'agent qui fait l'action
        $table->foreignId('bordereau_id')->nullable()->constrained('bordereaux')->onDelete('set null'); // Optionnel au début
        $table->string('preuve_achat')->nullable(); // Pour stocker le scan du reçu (PDF/Image)
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('versements');
    }
};
