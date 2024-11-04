@extends('adminlte::page')

@section('title', 'Historial de Citas')

@section('content_header')
    <h1>Historial de Citas</h1>
@stop

@section('content')
    <p>A continuación se muestra el historial de citas anteriores:</p>

    @if ($historialCitas->isEmpty())
        <div class="alert alert-warning" role="alert">
            No tienes citas en el historial.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Descripción</th>
                        <th>Fecha y Hora</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($historialCitas as $cita)
                        <tr>
                            <td>{{ $cita->description }}</td>
                            <td>{{ $cita->appointment_date->format('d/m/Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@stop

@section('css')
    <style>
        .table {
            width: 100%;
            margin: 20px 0;
        }
        .table th, .table td {
            text-align: left;
            padding: 12px;
        }
        .table th {
            background-color: #f8f9fa;
        }
        .alert-warning {
            margin-top: 20px;
        }
    </style>
@stop
