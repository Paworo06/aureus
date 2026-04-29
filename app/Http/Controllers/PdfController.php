<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\Hermano;
use App\Services\PdfService;

class PdfController extends Controller
{
    public function recibo(Pago $pago)
    {
        return PdfService::reciboPago($pago);
    }

    public function certificado(Hermano $hermano)
    {
        return PdfService::certificadoHermano($hermano);
    }
}