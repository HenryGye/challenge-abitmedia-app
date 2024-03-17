<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $servicios = Servicio::all();
        return response()->json($servicios);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'sku' => 'required|string|unique:servicios|max:10',
            'nombre' => 'required|string|max:100',
            'precio' => 'required|numeric|min:0',
        ]);

        if ($validated->fails()) {
            return response()->json($validated->errors(), 422);
        }
    
        $servicio = new Servicio();
        $servicio->sku = $request->sku;
        $servicio->nombre = $request->nombre;
        $servicio->precio = $request->precio;
        $servicio->save();

        $response = Servicio::findOrFail($servicio->id);
    
        return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $response = Servicio::find($id);
        if (!$response) {
            return response()->json(['message' => 'No existe registro'], 404);
        }
        return response()->json($response, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Servicio $servicio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Servicio $servicio)
    {
        $validated = Validator::make($request->all(), [
            'sku' => 'required|string|unique:servicios|max:10',
            'nombre' => 'required|string|max:100',
            'precio' => 'required|numeric|min:0',
        ]);

        if ($validated->fails()) {
            return response()->json($validated->errors(), 422);
        }
    
        $servicio->sku = $request->sku;
        $servicio->nombre = $request->nombre;
        $servicio->precio = $request->precio;
        $servicio->save();

        $response = Servicio::findOrFail($servicio->id);
    
        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $response = Servicio::find($id);

        if (!$response) {
            return response()->json(['message' => 'No existe registro'], 404);
        }

        $response->delete();
        return response()->json(['message' => 'Registro eliminado'], 200);
    }
}
