@extends('adminlte::page')

@section('title', 'PsicoSISTEMA')

@section('content_header')
    <h1>Panel inicial</h1>
@stop

@section('content')
    <p>Bienvenido a PsicoSISTEMA</p>

    <div id="dynamic-content">
        @yield('panel-content') <!-- Aquí se cargará el contenido dinámico -->
    </div>

    {{-- Mostrar el mensaje de éxito después de que el test se registre exitosamente --}}
    @if(session('test_registered'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('test_registered') }}</strong>
            <button type="button" class="btn btn-primary mt-2" onclick="window.location='{{ route('appointments.index') }}'">
                Ver Citas
            </button>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div id="citas-container">
        {{-- Este contenido se llenará mediante AJAX --}}
    </div>
@stop

@section('css')
    <style>
        .alert-success {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1050; /* Asegura que esté en la parte superior */
        }
    </style>
@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Interceptar el clic en "Citas Disponibles"
        $('a.load-citas').on('click', function(event) {
            event.preventDefault(); // Evita que la redirección ocurra

            // Cargar las citas usando AJAX
            $.ajax({
                url: '{{ route('citas.index') }}', 
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    let content = '<h2>Citas Disponibles</h2><ul>';
                    if (data.length === 0) {
                        content += '<li>No hay citas disponibles en este momento.</li>';
                    } else {
                        $.each(data, function(index, cita) {
                            content += `<li>${cita.especialidad} - ${cita.fecha} a ${cita.hora}</li>`;
                        });
                    }
                    content += '</ul>'; // Cierra la lista
                    $('#citas-container').html(content); // Actualiza el contenido de citas
                },
                error: function(xhr) {
                    console.error(xhr);
                    alert('Error al cargar las citas.');
                }
            });
        });
    });
</script>
@stop
