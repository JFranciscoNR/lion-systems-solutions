@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header p-2 pb-0">
                    <div class="row">
                        <div class="col-md-3 align-middle py-2">
                            <p class="mb-0">Lista de Estatus</p>
                        </div>
                        <div class="col-md-6 pb-sm-2">
                            <!-- Formulario que permite que funcione el buscador -->
                            <!-- Mediante la ruta pasamos labariable $buscar para que en el controlador 
                            se le asigne un valor y sea retornada a la vista -->
                            <form class="d-flex" action="{{ route('estatus.index', $buscar) }}" method="GET">
                                <input name="buscar" class="form-control me-2 mb-0" type="search" placeholder="Buscar" aria-label="buscar" value="{{ $buscar }}">
                                <button class="btn btn-primary" type="submit">&#128270;</button>
                            </form> 
                        </div>
                        <div class="col-md-3 text-md-end pb-sm-2">
                            <!-- Redireccionamos a la vista que nos permitira crear un estatus -->
                            <a class="btn btn-success" href="{{ route('estatus.create') }}" role="button">Crear</a>
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
                        @if($estatus->count())
                            <table class="table table-hover table-bordered mb-0">
                                <thead>
                                <tr class="text-center">
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                <!-- El bucle foreach almacena los registros de 
                                nuestra colecci??n en una variable -->
                                @foreach ($estatus as $estatu)
                                    <tr class="text-center">
                                        <!-- Imprimimos nuestros registro -->
                                        <th scope="row" class="align-middle py-2">{{ $estatu->id }}</th>
                                        <td class="align-middle py-2">{{ $estatu->nombre }}</td>
                                        <td class="py-2">
                                            <!-- Redireccionamos a la vista que muestra el detalle de cada registro -->
                                            <a href="{{ route('estatus.show', $estatu) }}" class="btn btn-primary" type="button">Mostrar</a>
                                            <!-- Redireccionamos a la vista para actualizar los registros registrados anteriormente -->
                                            <a href="{{ route('estatus.edit', $estatu) }}" class="btn btn-warning text-white" type="button">Actualizar</a>
                                            <!-- Formulario que nos permite eliminar un registro existente -->
                                            <form class="d-inline" action="{{ route('estatus.destroy', $estatu) }}" method="POST">
                                                <!-- Token de seguridad que verifica al usuario autentificado 
                                                evitando la falsificaci??n de solicitudes -->
                                                @csrf
                                                <!-- Directiva de blade para utilizar el metodo delete -->
                                                @method('DELETE')
                                                <button class="btn btn-danger" type="submit">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach   
                                </tbody>
                                <!-- Valida si existe m??s de una p??gina -->
                                @if ($estatus->hasPages())
                                    <tfoot>
                                        <tr>
                                            <td colspan="3" class="p-0 pt-3 px-2 mb-0">
                                                <!-- Paginaci??n -->
                                                {{ $estatus->links() }}
                                            </td>
                                        </tr>
                                    </tfoot>
                                @endif
                            </table>
                        @else
                            <div>
                                No se ha encontrado ning??n registro.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection