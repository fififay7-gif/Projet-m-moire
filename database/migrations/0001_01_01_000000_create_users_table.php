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
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // Informations d'identité
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();

            // Sécurité & Authentification
            $table->string('password');

            /**
             * Rôles utilisateurs pour EMS Voyage
             * Aligné avec le formulaire d'ajout (sans le '_de_') pour éviter l'erreur 1265 Data truncated
             */
            $table->enum('role', [
                'chef_agence',
                'agent_comptoir',
                'comptable'
            ])->default('agent_comptoir');

            // Option de sécurité : Forcer le changement de mot de passe à la première connexion
            $table->boolean('must_change_password')->default(true);

            // Jetons de session et Horodatages Laravel
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
