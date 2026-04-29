<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('plan_pagos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hermano_id')->constrained('hermanos')->onDelete('cascade');
            $table->decimal('importe_total', 8, 2);
            $table->decimal('importe_pagado', 8, 2)->default(0);
            $table->integer('cuotas_totales');
            $table->integer('cuotas_pagadas')->default(0);
            $table->enum('periodicidad', ['mensual', 'trimestral', 'anual', 'unica'])->default('anual');
            $table->date('fecha_inicio');
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_pagos');
    }
};
