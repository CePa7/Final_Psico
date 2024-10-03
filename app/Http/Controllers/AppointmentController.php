<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\CitaDisponible;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Método para almacenar una nueva cita
    public function store(Request $request)
    {
        // Determina si la cita se está creando desde un test o desde la lista de citas disponibles
        if ($request->has('cita_id')) {
            // Lógica para agendar desde las citas disponibles
            $citaDisponible = CitaDisponible::findOrFail($request->cita_id);

            // Crear una nueva cita basada en la cita disponible
            Appointment::create([
                'user_id' => Auth::id(),
                'appointment_date' => Carbon::parse($citaDisponible->fecha . ' ' . $citaDisponible->hora),
                'description' => 'Cita para ' . $citaDisponible->especialidad,
            ]);

            // Eliminar la cita disponible
            $citaDisponible->delete();

            // Redirigir con un mensaje de éxito
            return redirect()->route('citas.index')->with('success', 'Cita agendada correctamente.');
        } else {
            // Lógica para agendar directamente desde el test o desde una solicitud genérica
            $request->validate([
                'appointment_date' => 'required|date',
                'description' => 'required|string|max:255',
            ]);

            // Crear una nueva cita
            Appointment::create([
                'user_id' => Auth::id(),
                'appointment_date' => Carbon::parse($request->appointment_date),
                'description' => $request->description,
            ]);

            // Redirigir con un mensaje de éxito al completar el test
            return redirect()->route('home')->with('success', 'Test realizado con éxito, se le agendó una cita.');
        }
    }

    // Método para mostrar las citas del usuario autenticado
    public function index()
    {
        $appointments = Appointment::where('user_id', auth()->id())->get();
    
        return view('appointments', compact('appointments'));
    }
}
