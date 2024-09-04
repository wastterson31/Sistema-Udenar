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
        Schema::create('programas', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_snies')->unique();
            $table->string('nombre');
            $table->text('descripcion');
            $table->string('logo');
            $table->string('correo')->unique();
            $table->text('lineas_trabajo');
            $table->string('numero_resolucion');
            $table->date('fecha_resolucion');
            $table->string('archivo_resolucion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programas');
    }
};
