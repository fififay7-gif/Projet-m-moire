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
       Schema::create('factures', function (Blueprint $table) {
    $table->id();

    $table->foreignId('client_id')->constrained()->onDelete('cascade');
    $table->foreignId('reservation_id')->nullable()->constrained()->onDelete('set null');

    $table->string('numero_facture')->unique();

    $table->decimal('montant', 10, 2);
    $table->decimal('montant_paye')->default(0);
    $table->decimal('reste_a_payer')->default(0);

    $table->enum('statut', ['impayee', 'partielle', 'payee'])->default('impayee');

    $table->date('date_facture');

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factures');
    }
};
