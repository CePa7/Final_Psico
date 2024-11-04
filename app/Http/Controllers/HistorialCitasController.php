<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistorialCitasController extends Controller
{
    public function index()
    {
        // Obtiene la fecha de ayer
        $yesterday = now()->subDay();

        // Recupera las citas pasadas del usuario
        $historialCitas = Appointment::where('user_id', Auth::id())
            ->where('appointment_date', '<', $yesterday)
            ->get();

        // Verifica si es una solicitud AJAX
        if (request()->ajax()) {
            return response()->json($historialCitas);
        }

        return view('historial', compact('historialCitas'));
    }
}
