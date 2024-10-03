@extends('adminlte::page')

@section('title', 'Citas Disponibles')

@section('content_header')
    <h1>Citas Disponibles</h1>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($citas->isEmpty())
        <p>No hay citas disponibles en este momento.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Especialidad</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($citas as $cita)
                    <tr>
                        <td>{{ $cita->especialidad }}</td>
                        <td>{{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }}</td>
                        <td>{{ $cita->hora }}</td>
                        <td>
                            <form action="{{ route('appointments.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="cita_id" value="{{ $cita->id }}">
                                <button type="submit" class="btn btn-primary">Agendar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Citas disponibles cargadas!'); </script>
@stop
