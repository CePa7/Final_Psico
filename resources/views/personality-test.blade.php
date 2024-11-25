@extends('adminlte::page')

@section('title', 'Test de Personalidad OCEAN')

@section('content')
    <div class="container">
        <h2>Test de Personalidad OCEAN</h2>

        {{-- Mensajes de sesión --}}
        @if (session('test_registered'))
            <div class="alert alert-success">
                {{ session('test_registered') }}
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('personality-test.submit') }}" method="POST">
            @csrf

            <!-- Sección AP -->
            <h4>1. Apertura (AP)</h4>
            @php
                $ap_questions = [
                    'Disfruto aprendiendo sobre temas nuevos e inusuales.',
                    'Me gustan las actividades creativas, como la pintura, la escritura o la música.',
                    'Prefiero la variedad a la rutina.',
                    'Me gusta explorar diferentes formas de ver el mundo.',
                    'Me siento atraído/a por las experiencias nuevas y diferentes.'
                ];
            @endphp
            @foreach($ap_questions as $index => $question)
                <div class="form-group">
                    <label for="ap_{{ $index + 1 }}">Pregunta {{ $index + 1 }}: {{ $question }}</label>
                    <select name="ap_{{ $index + 1 }}" id="ap_{{ $index + 1 }}" class="form-control" required>
                        <option value="" disabled selected>Seleccione una opción</option>
                        <option value="1">Totalmente en desacuerdo</option>
                        <option value="2">En desacuerdo</option>
                        <option value="3">Neutral</option>
                        <option value="4">De acuerdo</option>
                        <option value="5">Totalmente de acuerdo</option>
                    </select>
                </div>
            @endforeach

            <!-- Sección RE -->
            <h4>2. Responsabilidad (RE)</h4>
            @php
                $re_questions = [
                    'Soy una persona organizada y mantengo mis cosas en orden.',
                    'Planifico mis actividades y cumplo mis compromisos.',
                    'Trabajo de manera metódica y detallada.',
                    'Prefiero terminar las tareas antes de descansar o relajarme.',
                    'Soy cuidadoso/a y detallista en mi trabajo.'
                ];
            @endphp
            @foreach($re_questions as $index => $question)
                <div class="form-group">
                    <label for="re_{{ $index + 1 }}">Pregunta {{ $index + 1 }}: {{ $question }}</label>
                    <select name="re_{{ $index + 1 }}" id="re_{{ $index + 1 }}" class="form-control" required>
                        <option value="" disabled selected>Seleccione una opción</option>
                        <option value="1">Totalmente en desacuerdo</option>
                        <option value="2">En desacuerdo</option>
                        <option value="3">Neutral</option>
                        <option value="4">De acuerdo</option>
                        <option value="5">Totalmente de acuerdo</option>
                    </select>
                </div>
            @endforeach

            <!-- Sección EX -->
            <h4>3. Extraversión (EX)</h4>
            @php
                $ex_questions = [
                    'Me siento cómodo/a al interactuar con muchas personas.',
                    'Disfruto estar rodeado/a de gente y socializar.',
                    'Me considero una persona enérgica y activa.',
                    'Disfruto siendo el centro de atención en las reuniones.',
                    'Me gusta participar en actividades grupales.'
                ];
            @endphp
            @foreach($ex_questions as $index => $question)
                <div class="form-group">
                    <label for="ex_{{ $index + 1 }}">Pregunta {{ $index + 1 }}: {{ $question }}</label>
                    <select name="ex_{{ $index + 1 }}" id="ex_{{ $index + 1 }}" class="form-control" required>
                        <option value="" disabled selected>Seleccione una opción</option>
                        <option value="1">Totalmente en desacuerdo</option>
                        <option value="2">En desacuerdo</option>
                        <option value="3">Neutral</option>
                        <option value="4">De acuerdo</option>
                        <option value="5">Totalmente de acuerdo</option>
                    </select>
                </div>
            @endforeach

            <!-- Sección AM -->
            <h4>4. Afabilidad (AM)</h4>
            @php
                $am_questions = [
                    'Trato de ser amable y comprensivo/a con todos.',
                    'Me gusta ayudar a los demás sin esperar nada a cambio.',
                    'Evito los conflictos y trato de llevarme bien con todos.',
                    'Me considero una persona generosa y de buen corazón.',
                    'Confío en que las personas son, en su mayoría, buenas.'
                ];
            @endphp
            @foreach($am_questions as $index => $question)
                <div class="form-group">
                    <label for="am_{{ $index + 1 }}">Pregunta {{ $index + 1 }}: {{ $question }}</label>
                    <select name="am_{{ $index + 1 }}" id="am_{{ $index + 1 }}" class="form-control" required>
                        <option value="" disabled selected>Seleccione una opción</option>
                        <option value="1">Totalmente en desacuerdo</option>
                        <option value="2">En desacuerdo</option>
                        <option value="3">Neutral</option>
                        <option value="4">De acuerdo</option>
                        <option value="5">Totalmente de acuerdo</option>
                    </select>
                </div>
            @endforeach

            <!-- Sección NE -->
            <h4>5. Neuroticismo (NE)</h4>
            @php
                $ne_questions = [
                    'Frecuentemente me siento ansioso/a o preocupado/a.',
                    'Suelo reaccionar intensamente a situaciones de estrés.',
                    'A menudo me siento inseguro/a o con baja autoestima.',
                    'Tiendo a sentirme triste o desanimado/a sin motivo aparente.',
                    'Me resulta difícil recuperarme rápidamente de situaciones difíciles.'
                ];
            @endphp
            @foreach($ne_questions as $index => $question)
                <div class="form-group">
                    <label for="ne_{{ $index + 1 }}">Pregunta {{ $index + 1 }}: {{ $question }}</label>
                    <select name="ne_{{ $index + 1 }}" id="ne_{{ $index + 1 }}" class="form-control" required>
                        <option value="" disabled selected>Seleccione una opción</option>
                        <option value="1">Totalmente en desacuerdo</option>
                        <option value="2">En desacuerdo</option>
                        <option value="3">Neutral</option>
                        <option value="4">De acuerdo</option>
                        <option value="5">Totalmente de acuerdo</option>
                    </select>
                </div>
            @endforeach

            <button type="submit" class="btn btn-primary">Enviar Test</button>
        </form>
    </div>
@endsection
