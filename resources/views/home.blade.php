@extends('adminlte::page')

@section('title', 'PsicoSISTEMA')

@section('content_header')
    <h1>Panel inicial</h1>
@stop

@section('content')
    <p>Bienvenido a PsicoSISTEMA</p>

    <div id="dynamic-content">
        <!-- Aquí se cargará el contenido dinámico a través de AJAX -->
    </div>

    {{-- Mostrar el mensaje de éxito o error --}}
    @if(session('test_result'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('test_result') }}</strong>
            @if(str_contains(session('test_result'), 'prioridad ALTA'))
                <button type="button" class="btn btn-primary mt-2" onclick="window.location='{{ route('appointments.index') }}'">
                    Ver Citas
                </button>
            @endif
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    {{-- Los botones "Ver Datos" y "Predecir" no deberían estar en el home, así que los comentamos --}}
    {{-- 
    <div class="mt-3">
        <button id="load-graphics" class="btn btn-info">Ver Datos</button>
    </div>

    <div class="mt-3">
        <button id="load-prediction" class="btn btn-primary">Predecir</button>
    </div>
    --}}
@stop

@section('css')
    <style>
        .alert-success, .alert-danger {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1050;
        }
    </style>
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Aquí puedes agregar cualquier script específico para la vista principal si es necesario
        });
    </script>
@stop
