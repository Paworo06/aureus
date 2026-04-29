<?php

namespace App\Exports;

use App\Models\Hermano;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class HermanosExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Hermano::all();
    }

    public function headings(): array
    {
        return ['ID', 'Nombre', 'Primer Apellido', 'Segundo Apellido', 'DNI', 'Dirección', 'Teléfono', 'Fecha Creación'];
    }

    public function map($hermano): array
    {
        return [
            $hermano->id,
            $hermano->nombre,
            $hermano->apellido1,
            $hermano->apellido2,
            $hermano->dni,
            $hermano->direccion,
            " " . $hermano->telefono, // El espacio hace que excel trate el campo como texto
            $hermano->created_at->format('d/m/Y'),
        ];
    }
}
