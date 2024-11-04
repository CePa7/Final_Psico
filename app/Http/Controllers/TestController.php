<?php

namespace App\Http\Controllers;

use App\Models\Appointment; 
use App\Models\Test; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use GuzzleHttp\Client;

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

        if ($testResponse) {
            // Enviar datos a la API para obtener predicción
            $prediction = $this->getPrediction($request->all());

            if ($prediction == 'ALTA') {
                // Crear la cita automáticamente si se necesita
                $this->createAppointment();
                return redirect()->route('home')->with('test_result', 'Test registrado, se ha programado una cita.');
            } else {
                return redirect()->route('home')->with('test_result', 'Test registrado, gracias por realizarlo.');
            }
        } else {
            return redirect()->back()->with('error', 'Error al registrar el test. Intente nuevamente.');
        }
    }

    // Función para guardar las respuestas del test
    private function saveTestResponse(Request $request)
    {
        $user = Auth::user();

        return Test::create([
            'user_id' => $user->id,
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
        $user = Auth::user();

        if (!$user) {
            return;
        }

        $appointmentDate = Carbon::now()->addDay();

        Appointment::create([
            'user_id' => $user->id,
            'appointment_date' => $appointmentDate,
            'description' => 'Cita programada después de registrar el test',
        ]);
    }

    // Función para enviar los datos a la API y obtener la predicción
    private function getPrediction($data)
    {
        $client = new Client();
        $response = $client->post('http://localhost:5000/predict', [
            'json' => $data
        ]);

        $result = json_decode($response->getBody(), true);
        return $result['prioridad'] ?? 'BAJA';
    }
}
