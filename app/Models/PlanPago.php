<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanPago extends Model
{
    protected $table = 'plan_pagos';

    protected $fillable = [
        'hermano_id', 
        'importe_total', 
        'importe_pagado',
        'cuotas_totales', 
        'cuotas_pagadas',
        'periodicidad', 
        'fecha_inicio', 
        'activo',
    ];

    protected $casts = [
        'activo' => 'boolean',
        'fecha_inicio' => 'date',
        'importe_total' => 'decimal:2',
        'importe_pagado' => 'decimal:2',
    ];

    public function hermano()
    {
        return $this->belongsTo(Hermano::class);
    }

    public function getImportePendienteAttribute()
    {
        return $this->importe_total - $this->importe_pagado;
    }

    public function getCuotasPendientesAttribute()
    {
        return $this->cuotas_totales - $this->cuotas_pagadas;
    }

    public function getEstadoAttribute()
    {
        if ($this->importe_pendiente <= 0) return 'al_dia';
        if ($this->cuotas_pendientes > 0) return 'pendiente';
        return 'mora';
    }
}