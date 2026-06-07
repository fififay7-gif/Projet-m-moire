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

    $table->foreignId('client_id')->constrained()->onDelete('cascade');

    $table->string('type_service')->nullable();
    $table->text('description')->nullable();

    $table->enum('statut', [
        'en_attente',
        'validee',
        'rejetee',
        'terminee'
    ])->default('en_attente');

    $table->date('date_reservation')->nullable();

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
