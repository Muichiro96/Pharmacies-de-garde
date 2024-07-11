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
        Schema::create('garde_pharmacie', function (Blueprint $table) {
            
            $table->foreignId('pharmacie_id')->constrained(table:'pharmacies',column:'idPharmacie')->cascadeOnDelete();
            $table->foreignId('garde_id')->constrained(table:'gardes',column:'idGarde')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('garde_pharmacie');
    }
};
