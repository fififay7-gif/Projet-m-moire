<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('versements', function (Blueprint $table) {
        
        $table->renameColumn('bordereau_id', 'paiement_id');

        // On crée la nouvelle clé étrangère propre vers la table paiements
        $table->foreign('paiement_id')->references('id')->on('paiements')->onDelete('cascade');
    });
}

    public function down(): void
    {
        Schema::table('versements', function (Blueprint $table) {
            $table->dropForeign(['paiement_id']);
            $table->renameColumn('paiement_id', 'bordereau_id');
        });
    }
};
