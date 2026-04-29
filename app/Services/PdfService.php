<?php

namespace App\Services;

use App\Models\Pago;
use App\Models\Hermano;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfService
{
    public static function reciboPago(Pago $pago): \Illuminate\Http\Response
    {
        $pago->load('hermano', 'user');

        $pdf = Pdf::loadView('pdfs.recibo', compact('pago'));
        $pdf->setPaper('a4', 'portrait');

        return $pdf->download("recibo_pago_{$pago->id}.pdf");
    }

    public static function certificadoHermano(Hermano $hermano): \Illuminate\Http\Response
    {
        $hermano->load('planPago', 'pagos');

        $pdf = Pdf::loadView('pdfs.certificado', compact('hermano'));
        $pdf->setPaper('a4', 'portrait');

        return $pdf->download("certificado_{$hermano->dni}.pdf");
    }
}