@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Editar Reservas') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <!-- Formulario que permite enviar la información para crear un nuevo registro -->
                    <form class="form-floating" action="{{ route('reservas.store') }}" method="POST">
                        <!-- Token de seguridad que verifica al usuario autentificado 
                        evitando la falsificación de solicitudes -->
                        @csrf
                        <!-- Directiva de blade para utilizar el metodo put -->
                        @method('PUT')
                        <input type="text" name="nombre" class="form-control mb-2" id="floatingInputValue" placeholder="Nombre" value="{{ old('nombre',$reserva->nombre) }}" required autofocus>
                        <label for="floatingInputValue">Nombre</label> 
                        <!-- Directiva de blade que muestra los errores al no cumplir la validaciones -->
                        @error('nombre')
                            {{ $message }}
                        @enderror
                        <div class="form-floating mb-2">
                            <textarea class="form-control" name="descripcion" placeholder="Descripción" id="floatingTextarea" required>{{ old('descripcion',$reserva->descripcion) }}</textarea>
                            <label for="floatingTextarea">Descripción</label>
                        </div>
                        @error('descripcion')
                            {{ $message }}
                        @enderror
                        <div class="form-floating mb-2">
                            <input type="datetime-local" name="fecha_inicio" class="form-control mb-2" id="floatingInputValue" placeholder="Fecha y Hora de Inicio" min="" value="{{ old('fecha_inicio',$reserva->fecha_inicio) }}" required>
                            <label for="floatingInputValue">Fecha y Hora de Inicio</label> 
                        </div>
                        @error('fecha_inicio')
                            {{ $message }}
                        @enderror
                        <div class="form-floating mb-2">
                            <input type="datetime-local" name="fecha_termino" class="form-control mb-2" id="floatingInputValue" placeholder="Fecha y Hora de Termino" max="" value="{{ old('fecha_termino',$reserva->fecha_termino) }}" required>
                            <label for="floatingInputValue">Fecha y Hora de Termino</label> 
                        </div>
                        @error('fecha_termino')
                            {{ $message }}
                        @enderror
                        <div class="form-floating mb-2">
                            <select class="form-select" name="sala_id" id="floatingSelect" required>
                                <option disabled>Selecciona una opción</option>
                                <!-- El bucle foreach almacena los registros de 
                                nuestra colección en una variable -->
                                @foreach ($salas as $sala)
                                    @if ($sala->estatu->nombre == 'Disponible')
                                        <!-- Imprimimos nuestros registro -->
                                        <option value="{{ $sala->id }}">{{ $sala->nombre }}, {{ $sala->descripcion }}</option> 
                                    @endif
                                @endforeach
                            </select>
                            <label for="floatingSelect">Selecciona una sala</label>
                        </div>
                        @error('sala_id')
                            {{ $message }}
                        @enderror
                        <div class="form-floating">
                            <select class="form-select" name="estatu_id" id="floatingSelect" required>
                                <option disabled>Selecciona una opción</option>
                                <!-- El bucle foreach almacena los registros de 
                                nuestra colección en una variable -->
                                @foreach ($estatus as $estatu)
                                    <!-- Obtenemos la primer interacción con la directiva de blade if
                                    haciendo uso de la variable de bucle -->
                                    @if ($estatu->nombre == 'Disponible')
                                    <!-- Imprimimos nuestros registro -->
                                        <option value="{{ $estatu->id }}" selected>{{ $estatu->nombre }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <label for="floatingSelect">Selecciona un estatus</label>
                        </div>
                        @error('estatu_id')
                            {{ $message }}
                        @enderror
                </div>
                <div class="card-footer text-end">
                    <!-- Redireccionamos a la vista index -->
                    <a href="{{ route('reservas.index') }}" class="btn btn-primary">Regresar</a>    
                    <button class="btn btn-success" type="submit">Actualizar</button>   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection