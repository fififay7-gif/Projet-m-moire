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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();

            // 🔑 Code unique de la réservation (ex: RES-2026-XF83)
            $table->string('code')->unique();

            // 👥 Relation avec le client
            $table->foreignId('client_id')->constrained()->onDelete('cascade');

            // ✈️ Nouvelles colonnes requises
            $table->string('destination');
            $table->string('classe');

            // 📝 Optionnels / Anciens champs conservés pour la compatibilité
            $table->string('type_service')->nullable();
            $table->text('description')->nullable();
            $table->string('motif_rejet')->nullable(); // Requis pour le rejet du Chef d'agence

            // 📊 Cycles de vie du statut
            $table->enum('statut', [
                'en_attente',
                'validee',
                'rejetee',
                'terminee'
            ])->default('en_attente');

            // 📅 Date et Heure de la réservation
            $table->dateTime('date_reservation')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
