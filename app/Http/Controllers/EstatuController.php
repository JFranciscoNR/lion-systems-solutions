<?php

namespace App\Http\Controllers;

use App\Models\Estatu;
use Illuminate\Http\Request;

class EstatuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $buscar = $request->get('buscar');
        //Recuperación de todos los registros del modelo estatu
        $estatus = Estatu::where('nombre','like','%'.$buscar.'%')->orderBy('id')->paginate(5);
        //Pasamos la colección a la vista haciendo uso del método compact()
        return view('estatus.index', compact(['estatus','buscar']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Redireccionamiento a la vista para crear registro
        return view('estatus.create');
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
            'nombre' => ['required','max:50', 'unique:estatus,nombre'],
        ]);
        //creación de un objeto e instanciar la clase Estatu
        $estatu = new Estatu();
        $estatu->nombre = $request->nombre;
        //Guardar la información con el método save
        $estatu->save();
        //Redireccionar al registro creado
        return redirect()->route('estatus.show', $estatu);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Estatu $estatu)
    {
        //Intancia de la clase Estatu
        //Pasamos la colección a la vista haciendo uso del método compact()
        return view('estatus.show', compact('estatu'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Estatu $estatu)
    {
        //Intancia de la clase Estatu
        //Pasamos la colección a la vista haciendo uso del método compact()
        return view('estatus.edit', compact('estatu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estatu $estatu)
    {
        //Validaciones
        $request->validate([
            'nombre' => ['required','max:50'],
        ]);
        //Intancia de la clase Estatu
        $estatu->nombre = $request->nombre;
        //Guardar la información con el método save
        $estatu->save();
        //Redireccionar a la vista index
        return redirect()->route('estatus.index');
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
