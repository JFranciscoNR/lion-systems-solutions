<?php

namespace App\Http\Controllers;

use App\Models\Estatu;
use App\Models\Reserva;
use App\Models\Sala;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $buscar = $request->get('buscar');
        //Recuperación de todos los registros del modelo reserva
        $reservas = Reserva::where('nombre','like','%'.$buscar.'%')->orderBy('id')->paginate(5);
        //Pasamos la colección a la vista haciendo uso del método compact()
        return view('reservas.index', compact(['reservas','buscar']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $carbon = Carbon::now('America/Mexico_City');
        $fecha = $carbon->toDateString();
        $tiempo = $carbon->toTimeString();
        //Recuperación de todos los registros del modelo estatu
        $estatus = Estatu::all();
        $salas = Sala::all();
        //Redireccionamiento a la vista para crear registro y 
        //Pasamos la colección a la vista haciendo uso del método compact()
        return view('reservas.create', compact(['estatus','salas','fecha','tiempo']));
        //return response()->json($carbon, 200);
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
            'nombre' => ['required','max:50', 'unique:reservas,nombre'],
            'descripcion' => ['max:200'],
            'estatu_id' => ['required', 'numeric'],
        ]);
        //creación de un objeto e instanciar la clase Reserva
        $reserva = new Reserva();
        $reserva->nombre = $request->nombre;
        $reserva->descripcion = $request->descripcion;
        $reserva->fecha_inicio = $request->fecha_inicio;
        $reserva->fecha_termino = $request->fecha_inicio;
        //Si el campo es nulo, se agregara el id del usuario autentificado
        if(is_null($reserva->user_id)){
            $reserva->user_id = Auth::user()->id;
        }
        $reserva->sala_id = $request->sala_id;
        $reserva->estatu_id = $request->estatu_id;
        //Guardar la información con el método save
        $reserva->save();
        //Redireccionar al registro creado
        return redirect()->route('reservas.show', $reserva);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Reserva $reserva)
    {
        //Intancia de la clase Reserva
        //Pasamos la colección a la vista haciendo uso del método compact()
        return view('reservas.show', compact('reserva'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Reserva $reserva)
    {
        $carbon = Carbon::now('America/Mexico_City');
        $fecha = $carbon;
        //Recuperación de todos los registros del modelo estatu
        $estatus = Estatu::all();
        $salas = Sala::all();
        //Intancia de la clase Reserva
        //Pasamos la colección a la vista haciendo uso del método compact()
        return view('reservas.edit', compact(['reserva','salas','estatus','fecha']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reserva $reserva)
    {
        //Validaciones
        $request->validate([
            'nombre' => ['required','max:50'],
            'descripcion' => ['max:200'],
            'estatu_id' => ['required', 'numeric'],
        ]);
        //Intancia de la clase Reserva
        $reserva->nombre = $request->nombre;
        $reserva->descripcion = $request->descripcion;
        $reserva->fecha_inicio = $request->fecha_inicio;
        $reserva->fecha_termino = $request->fecha_inicio;
        $reserva->sala_id = $request->sala_id;
        $reserva->estatu_id = $request->estatu_id;
        //Guardar la información con el método save
        $reserva->save();
        //Redireccionar a la vista index
        return redirect()->route('reservas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reserva $reserva)
    {
        //Intancia de la clase Reserva
        //Eliminar registro con el método delete()
        $reserva->delete();
        //Redireccionar a la vista index
        return redirect()->route('reservas.index');
    }
}
