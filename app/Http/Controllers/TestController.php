<?php

namespace App\Http\Controllers;

use App\Models\Appointment; 
use App\Models\Test; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TestController extends Controller
{
    // Método para mostrar el formulario del test
    public function show()
    {
        return view('test');
    }

    // Método para manejar la sumisión del test
    public function submit(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'full_name' => 'required|string|max:255',
            'age' => 'required|integer|min:20|max:70',
            'previous_treatment' => 'required|in:Sí,No',
            'stress_level' => 'required|in:Bajo,Moderado,Alto',
            'stress_factors' => 'required|in:Laborales,Financieros,Relacionales,Sociales',
            'symptom_intensity' => 'required|in:Leve,Moderado,Grave',
            'symptom_frequency' => 'required|in:Diario,Semanal,Mensual',
            'support_network' => 'required|in:Amigos,Familia,Colegas,Terapia',
            'traumatic_events' => 'required|in:Ninguno,Divorcio,Pérdida de empleo,Problemas familiares,Enfermedad propia',
            'self_harm' => 'required|in:Sí,No',
            'suicidal_thoughts' => 'required|in:Sí,No',
            'medications' => 'required|in:Ninguno,Antidepresivo,Ansiedad',
            'relaxation_methods' => 'required|in:Yoga,Ejercicio,Meditación,Terapia',
        ]);
    
        // Guardar las respuestas del test
        $testResponse = $this->saveTestResponse($request);
    
        // Verificar que se haya guardado el test correctamente
        if ($testResponse) {
            // Crear la cita automáticamente
            $this->createAppointment();
    
            // Redirigir al usuario con un mensaje de éxito
            return redirect()->route('home')->with('test_registered', 'Test realizado con éxito, se le agendó una cita.');
        } else {
            // Redirigir con un mensaje de error si falla el guardado
            return redirect()->back()->with('error', 'Error al registrar el test. Intente nuevamente.');
        }
    }
    
    // Función para guardar las respuestas del test
    private function saveTestResponse(Request $request)
    {
        // Obtener el usuario autenticado
        $user = Auth::user();
    
        // Guardar las respuestas del test
        return Test::create([
            'user_id' => $user->id, // Asociar el test al usuario autenticado
            'full_name' => $request->full_name,
            'age' => $request->age,
            'previous_treatment' => $request->previous_treatment,
            'stress_level' => $request->stress_level,
            'stress_factors' => $request->stress_factors,
            'symptom_intensity' => $request->symptom_intensity,
            'symptom_frequency' => $request->symptom_frequency,
            'support_network' => $request->support_network,
            'traumatic_events' => $request->traumatic_events,
            'self_harm' => $request->self_harm,
            'suicidal_thoughts' => $request->suicidal_thoughts,
            'medications' => $request->medications,
            'relaxation_methods' => $request->relaxation_methods,
        ]);
    }

    // Función para crear una cita automáticamente
    private function createAppointment()
    {
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Verificar que el usuario esté autenticado
        if (!$user) {
            return; 
        }

        // Establecer la fecha de la cita para el día siguiente (ejemplo)
        $appointmentDate = Carbon::now()->addDay();

        // Crear la cita
        Appointment::create([
            'user_id' => $user->id,
            'appointment_date' => $appointmentDate, 
            'description' => 'Cita programada después de registrar el test',
        ]);
    }
}
