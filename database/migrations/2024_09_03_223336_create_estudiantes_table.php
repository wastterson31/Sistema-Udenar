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
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('identificacion')->unique();
            $table->string('codigo_estudiantil')->unique();
            $table->string('fotografia')->nullable();
            $table->string('direccion');
            $table->string('telefono');
            $table->string('correo')->unique();
            $table->enum('genero', ['Masculino', 'Femenino', 'Otro']);
            $table->date('fecha_nacimiento');
            $table->string('semestre');
            $table->string('estado_civil');
            $table->date('fecha_ingreso');
            $table->date('fecha_egreso')->nullable();
            $table->unsignedBigInteger('cohorte_id');
            $table->foreign('cohorte_id')->references('id')->on('cohortes');
            $table->unsignedBigInteger('programa_id');
            $table->foreign('programa_id')->references('id')->on('programas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudiantes');
    }
};
