<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $fillable = [
        'hermano_id', 
        'user_id', 
        'importe',
        'fecha_pago', 
        'concepto', 
        'recibo_pdf',
    ];

    protected $casts = [
        'fecha_pago' => 'date',
        'importe' => 'decimal:2',
    ];

    public function hermano()
    {
        return $this->belongsTo(Hermano::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}