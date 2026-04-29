<?php

namespace App\Http\Controllers;

use App\Models\Auditoria;

class AuditoriaController extends Controller
{
    public function index()
    {
        $registros = Auditoria::with('user')->latest()->paginate(20);
        return view('auditoria.index', compact('registros'));
    }
}