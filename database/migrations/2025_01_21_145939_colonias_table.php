<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('colonias', function (Blueprint $table) {
            $table->id(); // ID de la colonia
            $table->string('nombre', 100); // Nombre de la colonia
            $table->timestamps(); // Timestamps para created_at y updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('colonias');
    }
};
