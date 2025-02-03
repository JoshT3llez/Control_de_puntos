<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('choferes', function (Blueprint $table) {
            $table->id(); // Esto equivale a INT AUTO_INCREMENT (ID de la tabla)
            $table->string('nombre', 50); // Nombre de chofer, VARCHAR(50)
            $table->timestamps(); // Timestamps, para created_at y updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('choferes');
    }
};
