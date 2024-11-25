<?php

namespace App\Http\Controllers;

use App\Models\PersonalityTest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;

class PersonalityTestController extends Controller
{
    // Mostrar el formulario del test
    public function show()
    {
        return view('personality-test');
    }

    // Manejar la sumisión del formulario del test
    public function submit(Request $request)
    {
        // Validar las respuestas del test
        $request->validate([
            'ap_1' => 'required|integer|between:1,5',
            'ap_2' => 'required|integer|between:1,5',
            'ap_3' => 'required|integer|between:1,5',
            'ap_4' => 'required|integer|between:1,5',
            'ap_5' => 'required|integer|between:1,5',
            're_1' => 'required|integer|between:1,5',
            're_2' => 'required|integer|between:1,5',
            're_3' => 'required|integer|between:1,5',
            're_4' => 'required|integer|between:1,5',
            're_5' => 'required|integer|between:1,5',
            'ex_1' => 'required|integer|between:1,5',
            'ex_2' => 'required|integer|between:1,5',
            'ex_3' => 'required|integer|between:1,5',
            'ex_4' => 'required|integer|between:1,5',
            'ex_5' => 'required|integer|between:1,5',
            'am_1' => 'required|integer|between:1,5',
            'am_2' => 'required|integer|between:1,5',
            'am_3' => 'required|integer|between:1,5',
            'am_4' => 'required|integer|between:1,5',
            'am_5' => 'required|integer|between:1,5',
            'ne_1' => 'required|integer|between:1,5',
            'ne_2' => 'required|integer|between:1,5',
            'ne_3' => 'required|integer|between:1,5',
            'ne_4' => 'required|integer|between:1,5',
            'ne_5' => 'required|integer|between:1,5',
        ]);

        // Guardar las respuestas del test en la base de datos
        $personalityTest = $this->saveTestResponse($request);

        if ($personalityTest) {
            // Enviar los datos al API de Flask para obtener la recomendación
            $recommendation = $this->getRecommendation($request->all());

            return redirect()->route('home')->with('success', $recommendation);
        }

        // Redirigir con mensaje de error en caso de fallo
        return redirect()->back()->with('error', 'Hubo un error al registrar el test. Intenta nuevamente.');
    }

    // Guardar las respuestas del test en la base de datos
    private function saveTestResponse(Request $request)
    {
        return PersonalityTest::create([
            'user_id' => Auth::id(),
            'ap_1' => $request->input('ap_1'),
            'ap_2' => $request->input('ap_2'),
            'ap_3' => $request->input('ap_3'),
            'ap_4' => $request->input('ap_4'),
            'ap_5' => $request->input('ap_5'),
            're_1' => $request->input('re_1'),
            're_2' => $request->input('re_2'),
            're_3' => $request->input('re_3'),
            're_4' => $request->input('re_4'),
            're_5' => $request->input('re_5'),
            'ex_1' => $request->input('ex_1'),
            'ex_2' => $request->input('ex_2'),
            'ex_3' => $request->input('ex_3'),
            'ex_4' => $request->input('ex_4'),
            'ex_5' => $request->input('ex_5'),
            'am_1' => $request->input('am_1'),
            'am_2' => $request->input('am_2'),
            'am_3' => $request->input('am_3'),
            'am_4' => $request->input('am_4'),
            'am_5' => $request->input('am_5'),
            'ne_1' => $request->input('ne_1'),
            'ne_2' => $request->input('ne_2'),
            'ne_3' => $request->input('ne_3'),
            'ne_4' => $request->input('ne_4'),
            'ne_5' => $request->input('ne_5'),
        ]);
    }

    // Llamar a la API de Flask para obtener la recomendación
    private function getRecommendation(array $responses)
    {
        // Sumar los puntajes para cada rasgo
        $total_ap = array_sum([
            $responses['ap_1'], $responses['ap_2'], $responses['ap_3'],
            $responses['ap_4'], $responses['ap_5']
        ]);
        $total_re = array_sum([
            $responses['re_1'], $responses['re_2'], $responses['re_3'],
            $responses['re_4'], $responses['re_5']
        ]);
        $total_ex = array_sum([
            $responses['ex_1'], $responses['ex_2'], $responses['ex_3'],
            $responses['ex_4'], $responses['ex_5']
        ]);
        $total_am = array_sum([
            $responses['am_1'], $responses['am_2'], $responses['am_3'],
            $responses['am_4'], $responses['am_5']
        ]);
        $total_ne = array_sum([
            $responses['ne_1'], $responses['ne_2'], $responses['ne_3'],
            $responses['ne_4'], $responses['ne_5']
        ]);

        // Preparar los datos para el POST
        $data = [
            'AP' => $total_ap,
            'RE' => $total_re,
            'EX' => $total_ex,
            'AM' => $total_am,
            'NE' => $total_ne,
        ];

        $client = new Client();
        $response = $client->post('http://localhost:5000/predict', [
            'json' => $data
        ]);

        // Obtener la recomendación desde el API
        $result = json_decode($response->getBody(), true);

        // Formatear la respuesta para mostrar
        if (isset($result['recomendaciones'])) {
            $recomendaciones = $result['recomendaciones'];

            // Formateo de la respuesta según el formato deseado
            $recomendationText = "Lamina te recomienda los siguientes libros:\n";
            foreach ($recomendaciones['Libros'] as $libro) {
                $recomendationText .= "- $libro\n";
            }
            $recomendationText .= "\nY la siguiente película:\n";
            $recomendationText .= "- " . $recomendaciones['Película'];

            return $recomendationText;
        }

        return 'Sin recomendaciones disponibles.';
    }
}
