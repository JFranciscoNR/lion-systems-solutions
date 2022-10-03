<?php

namespace App\Http\Controllers;

use App\Models\Sala;
use Illuminate\Http\Request;

class SalaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $buscar = $request->get('buscar');
        //Recuperación de todos los registros del modelo sala
        $salas = Sala::where('nombre','like','%'.$buscar.'%')->orderBy('id')->paginate(5);
        //Pasamos la colección a la vista haciendo uso del método compact()
        return view('salas.index', compact(['salas','buscar']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Redireccionamiento a la vista para crear registro
        return view('salas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validaciones
        $request->validate([
            'nombre' => ['required','max:50', 'unique:salas,nombre'],
            'descripcion' => ['max:200']
        ]);
        //creación de un objeto e instanciar la clase Estatu
        $sala = new Sala();
        $sala->nombre = $request->nombre;
        $sala->descripcion = $request->descripcion;
        //Guardar la información con el método save
        $sala->save();
        //Redireccionar al registro creado
        return redirect()->route('salas.show', $sala);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
