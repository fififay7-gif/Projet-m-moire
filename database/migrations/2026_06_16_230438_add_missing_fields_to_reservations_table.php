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
    Schema::table('reservations', function (Blueprint $table) {
        if (!Schema::hasColumn('reservations', 'code')) {
            // On l'ajoute SANS le unique() pour l'instant
            $table->string('code')->nullable()->after('id');
        }
        if (!Schema::hasColumn('reservations', 'destination')) {
            $table->string('destination')->after('client_id');
        }
        if (!Schema::hasColumn('reservations', 'classe')) {
            $table->string('classe')->after('destination');
        }
        if (!Schema::hasColumn('reservations', 'motif_rejet')) {
            $table->string('motif_rejet')->nullable()->after('statut');
        }
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn(['code', 'destination', 'classe', 'motif_rejet']);
        });
    }
};
