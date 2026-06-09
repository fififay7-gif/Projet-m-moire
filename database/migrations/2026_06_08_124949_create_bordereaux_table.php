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
    Schema::create('bordereaux', function (Blueprint $table) {
        $table->id();
        $table->string('code_bordereau')->unique(); // Exemple: BORD-2026-001
        $table->date('date_creation');
        $table->string('statut')->default('en_attente'); // en_attente, valide, rejete
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Qui a créé le bordereau
        $table->text('observations')->nullable();
        $table->timestamps();
    });
} /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bordereaux');
    }
};
