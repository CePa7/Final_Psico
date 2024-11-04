@extends('adminlte::page')

@section('title', 'Realizar Test')

@section('content')
    <h2>Realizar Test</h2>

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

    <form id="test-form" action="{{ route('tests.submit') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="full-name">Escriba su nombre completo:</label>
            <input type="text" class="form-control" id="full-name" name="full_name" required>
        </div>

        <div class="form-group">
            <label for="age">Ingrese su edad:</label>
            <input type="number" class="form-control" id="age" name="age" required min="20" max="70">
        </div>

        <div class="form-group">
            <label>¿Cuenta con tratamiento previo?</label>
            <select class="form-control" name="previous_treatment" required>
                <option value="" disabled selected>Seleccione una opción</option>
                <option value="Sí">Sí</option>
                <option value="No">No</option>
            </select>
        </div>

        <div class="form-group">
            <label for="stress-level">¿Cuál siente que es su nivel de estrés actual?</label>
            <select class="form-control" id="stress-level" name="stress_level" required>
                <option value="" disabled selected>Seleccione una opción</option>
                <option value="Bajo">Bajo</option>
                <option value="Moderado">Moderado</option>
                <option value="Alto">Alto</option>
            </select>
        </div>

        <div class="form-group">
            <label for="stress-factors">¿Qué factor estresante considera más importante?</label>
            <select class="form-control" id="stress-factors" name="stress_factors" required>
                <option value="" disabled selected>Seleccione una opción</option>
                <option value="Laborales">Laborales</option>
                <option value="Financieros">Financieros</option>
                <option value="Relacionales">Relacionales</option>
                <option value="Sociales">Sociales</option>
            </select>
        </div>

        <div class="form-group">
            <label for="symptom-intensity">¿Cuál es la intensidad de sus síntomas?</label>
            <select class="form-control" id="symptom-intensity" name="symptom_intensity" required>
                <option value="" disabled selected>Seleccione una opción</option>
                <option value="Leve">Leve</option>
                <option value="Moderado">Moderado</option>
                <option value="Grave">Grave</option>
            </select>
        </div>

        <div class="form-group">
            <label for="symptom-frequency">¿Cuál es la frecuencia de sus síntomas?</label>
            <select class="form-control" id="symptom-frequency" name="symptom_frequency" required>
                <option value="" disabled selected>Seleccione una opción</option>
                <option value="Diario">Diario</option>
                <option value="Semanal">Semanal</option>
                <option value="Mensual">Mensual</option>
            </select>
        </div>

        <div class="form-group">
            <label>Red de apoyo:</label>
            <select class="form-control" name="support_network" required>
                <option value="" disabled selected>Seleccione una opción</option>
                <option value="Amigos">Amigos</option>
                <option value="Familia">Familia</option>
                <option value="Colegas">Colegas</option>
                <option value="Terapia">Terapia</option>
            </select>
        </div>

        <div class="form-group">
            <label>¿Ha tenido eventos traumáticos recientes?</label>
            <select class="form-control" name="traumatic_events" required>
                <option value="" disabled selected>Seleccione una opción</option>
                <option value="Ninguno">Ninguno</option>
                <option value="Divorcio">Divorcio</option>
                <option value="Pérdida de empleo">Pérdida de empleo</option>
                <option value="Problemas familiares">Problemas familiares</option>
                <option value="Enfermedad propia">Enfermedad propia</option>
            </select>
        </div>

        <div class="form-group">
            <label>¿Se autolesiona?</label>
            <select class="form-control" name="self_harm" required>
                <option value="" disabled selected>Seleccione una opción</option>
                <option value="Sí">Sí</option>
                <option value="No">No</option>
            </select>
        </div>

        <div class="form-group">
            <label>¿Tiene pensamientos suicidas?</label>
            <select class="form-control" name="suicidal_thoughts" required>
                <option value="" disabled selected>Seleccione una opción</option>
                <option value="Sí">Sí</option>
                <option value="No">No</option>
            </select>
        </div>

        <div class="form-group">
            <label for="medications">¿Toma algún medicamento?</label>
            <select class="form-control" id="medications" name="medications" required>
                <option value="" disabled selected>Seleccione una opción</option>
                <option value="Ninguno">Ninguno</option>
                <option value="Antidepresivo">Antidepresivo</option>
                <option value="Ansiedad">Ansiedad</option>
            </select>
        </div>

        <div class="form-group">
            <label for="relaxation-methods">¿Cuál método de relajación prefiere?</label>
            <select class="form-control" id="relaxation-methods" name="relaxation_methods" required>
                <option value="" disabled selected>Seleccione una opción</option>
                <option value="Yoga">Yoga</option>
                <option value="Ejercicio">Ejercicio</option>
                <option value="Meditación">Meditación</option>
                <option value="Terapia">Terapia</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Enviar Test</button>
    </form>
@stop
