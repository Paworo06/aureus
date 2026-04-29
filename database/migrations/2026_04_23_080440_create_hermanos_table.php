<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hermanos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50);
            $table->string('apellido1', 50);
            $table->string('apellido2', 50)->nullable();
            $table->string('dni', 9)->unique();
            $table->string('direccion', 150)->nullable();
            $table->string('telefono', 15)->nullable();
            $table->date('fecha_ingreso')->nullable();
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hermanos');
    }
};
