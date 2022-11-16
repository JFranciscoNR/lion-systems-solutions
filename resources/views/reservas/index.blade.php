@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2 pb-0">
                    <div class="row">
                        <div class="col-md-3 align-middle py-2">
                            <p class="mb-0">Lista de Reservas</p>
                        </div>
                        <div class="col-md-6 pb-sm-2">
                            <!-- Formulario que permite que funcione el buscador -->
                            <!-- Mediante la ruta pasamos labariable $buscar para que en el controlador 
                            se le asigne un valor y sea retornada a la vista -->
                            <form class="d-flex" action="{{ route('reservas.index', $buscar) }}" method="GET">
                                <input name="buscar" class="form-control me-2 mb-0" type="search" placeholder="Buscar" aria-label="buscar" value="{{ $buscar }}">
                                <button class="btn btn-primary" type="submit">&#128270;</button>
                            </form> 
                        </div>
                        <div class="col-md-3 text-md-end pb-sm-2">
                            <!-- Redireccionamos a la vista que nos permitira crear una reserva -->
                            <a class="btn btn-success" href="{{ route('reservas.create') }}" role="button">Crear</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <!-- Valida si hay registros en la tabla -->
                        @if($reservas->count())
                            <table class="table table-hover table-bordered mb-0">
                                <thead>
                                <tr class="text-center">
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Descripción</th>
                                    <th scope="col">Fecha Inicial</th>
                                    <th scope="col">Fecha Termino</th>
                                    <th scope="col">Sala</th>
                                    <th scope="col">Estatu</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                <!-- El bucle foreach almacena los registros de 
                                nuestra colección en una variable -->
                                @foreach ($reservas as $reserva)
                                    <tr class="text-center">
                                        <!-- Imprimimos nuestros registro -->
                                        <th scope="row" class="align-middle py-2">{{ $reserva->id }}</th>
                                        <td class="align-middle py-2">{{ $reserva->nombre }}</td>
                                        <td class="align-middle py-2">{{ $reserva->descripcion }}</td>
                                        <td class="align-middle py-2">{{ $reserva->fecha_inicio }}</td>
                                        <td class="align-middle py-2">{{ $reserva->fecha_termino }}</td>
                                        <td class="align-middle py-2">{{ $reserva->sala->nombre }}</td>
                                        <td class="align-middle py-2">{{ $reserva->estatu->nombre }}</td>
                                        <td class="py-2">
                                            <!-- Redireccionamos a la vista que muestra el detalle de cada registro -->
                                            <a href="{{ route('reservas.show', $reserva) }}" class="btn btn-primary" type="button">Mostrar</a>
                                            <!-- Redireccionamos a la vista para actualizar los registros registrados anteriormente -->
                                            <a href="{{ route('reservas.edit', $reserva) }}" class="btn btn-warning text-white" type="button">Actualizar</a>
                                            <!-- Formulario que nos permite eliminar un registro existente -->
                                            <form class="d-inline" action="{{ route('reservas.destroy', $reserva) }}" method="POST">
                                                <!-- Token de seguridad que verifica al usuario autentificado 
                                                evitando la falsificación de solicitudes -->
                                                @csrf
                                                <!-- Directiva de blade para utilizar el metodo delete -->
                                                @method('DELETE')
                                                <button class="btn btn-danger" type="submit">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach   
                                </tbody>
                                <!-- Valida si existe más de una página -->
                                @if ($reservas->hasPages())
                                    <tfoot>
                                        <tr>
                                            <td colspan="5" class="p-0 pt-3 px-2 mb-0">
                                                <!-- Paginación -->
                                                {{ $reservas->links() }}
                                            </td>
                                        </tr>
                                    </tfoot>
                                @endif
                            </table>
                        @else
                            <div>
                                No se ha encontrado ningún registro.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection