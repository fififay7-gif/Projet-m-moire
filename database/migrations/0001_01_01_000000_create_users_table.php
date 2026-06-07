<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // identité
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();

            // sécurité
            $table->string('password');

            // rôle utilisateur (gestion des acteurs du système)
            $table->enum('role', [
                'agent_de_comptoir',
                'comptable',
                'chef_agence'
            ])->default('agent_de_comptoir');

            // option sécurité (forcer changement mot de passe à la 1ère connexion)
            $table->boolean('must_change_password')->default(true);

            // Laravel auth
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
