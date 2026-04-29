<?php

namespace App\Http\Controllers;

use App\Models\Hermano;

class MosaicoController extends Controller
{
    public function index()
    {
        $hermanos = Hermano::with('planPago')->where('activo', true)->get();
        return view('mosaico', compact('hermanos'));
    }
}