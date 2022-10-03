@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('Mostrar Estatus') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <!-- Imprimimos el nombre del registro -->
                    <h5 class="card-title mb-0">Estatus: {{ $estatu->nombre }}</h5>
                </div>
                <div class="card-footer text-end">
                    <!-- Redireccionamos a la vista index -->
                    <a href="{{ route('estatus.index') }}" class="btn btn-primary">Regresar</a>
                    <!-- Redireccionamos a la vista para actualizar los registros registrados anteriormente -->
                    <a href="{{ route('estatus.edit', $estatu) }}" class="btn btn-warning text-white" type="button">Actualizar</a>
                    <!-- Formulario que nos permite eliminar un registro existente -->
                    <form class="d-inline" action="{{ route('estatus.destroy', $estatu) }}" method="POST">
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