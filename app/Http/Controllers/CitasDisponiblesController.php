<?php

namespace App\Http\Controllers;

use App\Models\CitaDisponible;
use Illuminate\Http\Request;

class CitasDisponiblesController extends Controller
{
    public function index()
    {
        $citas = CitaDisponible::all();
        return view('citas_disponibles.index', compact('citas'));
    }
}
