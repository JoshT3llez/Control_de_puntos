work_orders<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up() {
        Schema::create('work_orders', function (Blueprint $table) {
            $table->string('orden_trabajo')->primary();
            $table->foreignId('chofer_id')->constrained('choferes')->onDelete('cascade'); // Relación con choferes
            $table->foreignId('colonia_id')->constrained('colonias')->onDelete('cascade'); // Relación con colonias
            $table->string('direccion_destino');
            $table->string('destinatario')->nullable();
            $table->date('fecha_programada');
            $table->date('fecha_entrega');
            $table->time('hora')->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamps();

        });
    }
    public function down()
    {
        Schema::table('work_orders', function (Blueprint $table) {
            $table->dropForeign(['chofer_id']);
            $table->dropForeign(['colonia_id']);
        });
    }
};