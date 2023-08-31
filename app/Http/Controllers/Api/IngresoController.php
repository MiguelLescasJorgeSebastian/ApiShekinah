<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ingreso;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IngresoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ingreso=Ingreso::all();
        return $ingreso;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validacion de los datos 
       $request->validate([
            'nombre' => 'required|string|max:100',
            'monto' => 'required|numeric',
            'fecha' => 'required|date',
            'tipo_ingreso' => 'required|string',
            'descripcion' => 'nullable|string|max:255'
        ]);
        //alta de ingreso
        $ingreso = new Ingreso();
        $ingreso->nombre =$request->nombre;
        $ingreso->monto =$request->monto;
        $ingreso->fecha =$request->fecha;
        $ingreso->tipo_ingreso =$request->tipo_ingreso;
        $ingreso->descripcion =$request->descripcion;

        $ingreso->save();
        //respuesta
        return response($ingreso,Response::HTTP_CREATED);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       $ingreso= Ingreso::find($id);
       if (Ingreso::find($id)){
        return response($ingreso,Response::HTTP_OK);
       }else{
        return response(["message"=> "no encontrado"],Response::HTTP_FOUND);
       }
       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $ingreso= Ingreso::findOrFail($request->$id);
        $ingreso->nombre =$request->nombre;
        $ingreso->monto =$request->monto;
        $ingreso->fecha =$request->fecha;
        $ingreso->tipo_ingreso =$request->tipo_ingreso;
        $ingreso->descripcion =$request->descripcion;

        $ingreso->save();
        return response($ingreso,Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ingreso=Ingreso::destroy($id);
        return response($ingreso,Response::HTTP_OK);
    }
}
