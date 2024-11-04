@extends('adminlte::page')

@section('title', 'Tus Citas')

@section('content')
    <h2>Tus Citas</h2>

    @if ($appointments->isEmpty())
        <p>No tienes citas registradas.</p>
    @else
        <div class="row">
            @foreach ($appointments as $appointment)
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-header">
                            Cita para: {{ $appointment->appointment_date->format('d/m/Y H:i') }}
                        </div>
                        <div class="card-body">
                            <p>{{ $appointment->description }}</p> <!-- Esto debe mostrar "Cita agendada con test" -->
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@stop
