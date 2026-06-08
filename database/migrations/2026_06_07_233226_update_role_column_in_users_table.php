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
    Schema::table('users', function (Blueprint $table) {
        // On change le type enum pour accepter les nouveaux rôles
        $table->enum('role', ['chef_agence', 'agent_comptoir', 'comptable'])->default('agent_comptoir')->change();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
