<?php

namespace App\Services;

use App\Models\Auditoria;

class AuditoriaService
{
    public static function registrar(
        string $operacion,
        string $modelo,
        ?int $modeloId = null,
        ?string $detalle = null
    ): void {
        Auditoria::create([
            'user_id'   => auth()->id(),
            'operacion' => $operacion,
            'modelo'    => $modelo,
            'modelo_id' => $modeloId,
            'detalle'   => $detalle,
        ]);
    }
}