<?php

namespace App\Exports;

use App\Models\Hermano;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class HermanosExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Hermano::with(['planPago', 'user'])
            ->where('activo', true)
            ->orderBy('apellido1')
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID', 'Nombre', 'Primer Apellido', 'Segundo Apellido',
            'DNI', 'Email', 'Dirección', 'Teléfono',
            'Importe Total', 'Pagado', 'Pendiente', 'Estado', 'Fecha Ingreso'
        ];
    }

    public function map($hermano): array
    {
        return [
            $hermano->id,
            $hermano->nombre,
            $hermano->apellido1,
            $hermano->apellido2,
            $hermano->dni,
            $hermano->user?->email ?? '—',
            $hermano->direccion ?? '—',
            " " . $hermano->telefono,
            $hermano->planPago?->importe_total ?? 0,
            $hermano->planPago?->importe_pagado ?? 0,
            $hermano->planPago?->importe_pendiente ?? 0,
            $hermano->planPago?->estado ?? 'sin plan',
            $hermano->fecha_ingreso?->format('d/m/Y') ?? '—',
        ];
    }
}