<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Software;
use App\Models\Licencia;
use App\Traits\SkuGenerator;
use App\Traits\SerialGenerator;

class SoftwareController extends Controller
{
    use SkuGenerator, SerialGenerator;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $softwares = Software::with('sistemaOperativo', 'licencia')->get();
        return response()->json($softwares);
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
            'sku' => 'required|string|unique:softwares|max:10',
            'nombre' => 'required|string|max:100',
            'precio' => 'required|numeric|min:0',
            'so_id' => 'required|exists:sistema_operativo,id',
        ]);

        if ($validated->fails()) {
            return response()->json($validated->errors(), 422);
        }
    
        $software = new Software();
        $software->sku = $request->sku;
        $software->nombre = $request->nombre;
        $software->precio = $request->precio;
        $software->so_id = $request->so_id;
        $software->save();

        $licencia = new Licencia();
        $licencia->serial = strtoupper($this->generarSerialUnico());
        $licencia->software_id = $software->id;
        $licencia->save();

        $response = Software::with('sistemaOperativo', 'licencia')->findOrFail($software->id);
    
        return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $response = Software::with('sistemaOperativo', 'licencia')->find($id);
        if (!$response) {
            return response()->json(['message' => 'No existe registro'], 404);
        }
        return response()->json($response, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Software $software)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Software $software)
    {
        $validated = Validator::make($request->all(), [
            'sku' => 'required|string|unique:softwares|max:10',
            'nombre' => 'required|string|max:100',
            'precio' => 'required|numeric|min:0',
            'so_id' => 'required|exists:sistema_operativo,id',
        ]);

        if ($validated->fails()) {
            return response()->json($validated->errors(), 422);
        }
    
        $software->sku = $request->sku;
        $software->nombre = $request->nombre;
        $software->precio = $request->precio;
        $software->so_id = $request->so_id;
        $software->save();

        $response = Software::with('sistemaOperativo', 'licencia')->findOrFail($software->id);
    
        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $licencia = Licencia::where('software_id', $id)->first();
        $response = Software::find($id);

        if (!$response) {
            return response()->json(['message' => 'No existe registro'], 404);
        }

        $licencia->delete();
        $response->delete();
        return response()->json(['message' => 'Registro eliminado'], 200);
    }
}
