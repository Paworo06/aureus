<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hermano extends Model
{
    protected $fillable = [
        'nombre', 
        'apellido1', 
        'apellido2',
        'dni', 
        'direccion', 
        'telefono',
        'fecha_ingreso', 
        'activo',
    ];

    protected $casts = [
        'activo' => 'boolean',
        'fecha_ingreso' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'dni', 'dni');
    }

    public function planPago()
    {
        return $this->hasOne(PlanPago::class);
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }

    public function getNombreCompletoAttribute()
    {
        return "{$this->nombre} {$this->apellido1} {$this->apellido2}";
    }
}