<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auditoria extends Model
{
    protected $fillable = [
        'user_id', 
        'operacion', 
        'modelo',
        'modelo_id', 
        'detalle',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}