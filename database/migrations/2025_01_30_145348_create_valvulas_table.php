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
        Schema::create('valvulas', function (Blueprint $table) {
            $table->id();
            $table->string('numero_valvula')->index();
            $table->string('estado');
            $table->decimal('altitud', 11, 8);
            $table->decimal('longitud', 11, 8);
            $table->string('colonia_fraccionamiento')->nullable();
            $table->string('ubicacion')->nullable();
            $table->string('tipo');
            $table->foreignId('sector_comercial_id')->default(1)->constrained('sector_comercials');
            $table->foreignId('sector_valvulero_id')->default(1)->constrained('sector_valvuleros');            
            $table->string('diametro_valvula');
            $table->string('condicion');
            $table->text('observacion')->nullable();
            $table->timestamps();
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('valvulas');
    }
};
