@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('Editar Estatus') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <!-- Formulario que permite actualizar la información de un registro --> 
                    <form class="form-floating" action="{{ route('estatus.update', $estatu) }}" method="POST">
                        <!-- Token de seguridad que verifica al usuario autentificado 
                        evitando la falsificación de solicitudes -->
                        @csrf
                        <!-- Directiva de blade para utilizar el metodo put -->
                        @method('PUT')
                        <input type="text" name="nombre" class="form-control" id="floatingInputValue" placeholder="Nombre" value="{{ old('nombre',$estatu->nombre) }}" required autofocus>
                        <label for="floatingInputValue">Nombre</label>  
                        <!-- Directiva de blade que muestra los errores al no cumplir la validaciones -->
                        @error('nombre')
                            {{ $message }}
                        @enderror
                </div>
                <div class="card-footer text-end">
                    <!-- Redireccionamos a la vista index -->
                    <a href="{{ route('estatus.index') }}" class="btn btn-primary">Regresar</a>    
                    <button class="btn btn-warning text-white" type="submit">Actualizar</button>   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection