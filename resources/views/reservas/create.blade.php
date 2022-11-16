@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Crear Reservas') }}</div>
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
                        <input type="text" name="nombre" class="form-control mb-2" id="nombre" placeholder="Nombre" value="{{ old('nombre') }}" required autofocus>
                        <label for="nombre">Nombre</label> 
                        <!-- Directiva de blade que muestra los errores al no cumplir la validaciones -->
                        @error('nombre')
                            {{ $message }}
                        @enderror
                        <div class="form-floating mb-2">
                            <textarea class="form-control" name="descripcion" placeholder="Descripción" id="descripcion" required>{{ old('descripcion') }}</textarea>
                            <label for="descripcion">Descripción</label>
                        </div>
                        @error('descripcion')
                            {{ $message }}
                        @enderror
                        <div class="row g-2">
                            <div class="col-md-6">
                                <div class="form-floating mb-2">
                                    <input type="date" name="fecha_inicio" class="form-control mb-2" min="{{ $fecha }}" id="fecha_inicio" placeholder="Fecha de Inicio" value="{{ old('fecha_inicio') }}" onblur="pasarFecha()" required">
                                    <label for="fecha_inicio">Fecha de Inicio</label> 
                                </div>
                                @error('fecha_inicio')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-2">
                                    <input type="time" name="tiempo_inicio" class="form-control mb-2" min="{{ $tiempo }}" id="tiempo_inicio" placeholder="Hora de Inicio" value="{{ old('tiempo_inicio') }}" onblur="pasarTiempo()" required">
                                    <label for="tiempo_inicio">Hora de Inicio</label> 
                                </div>
                                @error('tiempo_inicio')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="col-md">
                                <div class="form-floating mb-2">
                                    <input type="date" name="fecha_termino" class="form-control mb-2" id="fecha_termino" placeholder="Fecha de Termino" value="{{ old('fecha_termino') }}" required>
                                    <label for="fecha_termino">Fecha de Termino</label> 
                                </div>
                                @error('fecha_termino')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="col-md">
                                <div class="form-floating mb-2">
                                    <input type="time" name="tiempo_termino" class="form-control mb-2" id="tiempo_termino" placeholder="Hora de Termino" value="{{ old('tiempo_termino') }}" required>
                                    <label for="tiempo_termino">Hora de Termino</label> 
                                </div>
                                @error('tiempo_termino')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-floating mb-2">
                            <select class="form-select" name="sala_id" id="sala_id" required>
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
                            <label for="sala_id">Selecciona una sala</label>
                        </div>
                        @error('sala_id')
                            {{ $message }}
                        @enderror
                        <div class="form-floating">
                            <select class="form-select" name="estatu_id" id="estatu_id" required>
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
                            <label for="estatu_id">Selecciona un estatus</label>
                        </div>
                        @error('estatu_id')
                            {{ $message }}
                        @enderror
                </div>
                <div class="card-footer text-end">
                    <!-- Redireccionamos a la vista index -->
                    <a href="{{ route('reservas.index') }}" class="btn btn-primary">Regresar</a>    
                    <button class="btn btn-success" type="submit">Crear</button>   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection