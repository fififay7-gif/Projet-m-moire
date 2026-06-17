<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('versements', function (Blueprint $table) {
            // 🎯 On détruit la contrainte de clé étrangère qui fait planter MySQL
            $table->dropForeign('versements_bordereau_id_foreign');
        });
    }

    public function down(): void
    {
        Schema::table('versements', function (Blueprint $table) {
            $table->foreign('bordereau_id')->references('id')->on('bordereaux')->onDelete('set null');
        });
    }
};
