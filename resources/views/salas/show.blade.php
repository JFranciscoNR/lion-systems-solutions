@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('Mostrar Salas') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <!-- Imprimimos el nombre del registro -->
                    <h5 class="card-title">Salas: {{ $sala->nombre }}</h5>
                    <p class="card-text mb-0">Descripción: {{ $sala->descripcion }}</p>
                    <p class="card-text">Estatus: {{ $sala->estatu->nombre }}</p>
                </div>
                <div class="card-footer text-end">
                    <!-- Redireccionamos a la vista index -->
                    <a href="{{ route('salas.index') }}" class="btn btn-primary">Regresar</a>
                    <!-- Redireccionamos a la vista para actualizar los registros registrados anteriormente -->
                    <a href="{{ route('salas.edit', $sala) }}" class="btn btn-warning text-white" type="button">Actualizar</a>
                    <!-- Formulario que nos permite eliminar un registro existente -->
                    <form class="d-inline" action="{{ route('salas.destroy', $sala) }}" method="POST">
                        <!-- Token de seguridad que verifica al usuario autentificado 
                        evitando la falsificación de solicitudes -->
                        @csrf
                        <!-- Directiva de blade para utilizar el metodo delete -->
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection