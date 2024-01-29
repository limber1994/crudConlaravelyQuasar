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
        Schema::create('instituciones', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('direccion',45);
            $table->integer('telefono');
            $table->string('tipo', 10);
            $table->string('turno', 20);
            $table->integer('vacante');
            $table->string('informacion', 255);
            $table->string('foto')->nullable();
            $table->integer('mensualidad');
            $table->string('tipo_ins',45);
            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instituciones');
    }
};
