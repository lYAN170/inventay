<?php

namespace App\Http\Controllers;
use App\Models\Cotizacion;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class CotizacionController extends Controller
{

      /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cotizaciones = Cotizacion::with('proveedor')->get(); 
        return response()->json($cotizaciones);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $cotizacion = Cotizacion::with('proveedor')->find($id);
        
        if (!$cotizacion) {
            return response()->json(['message' => 'Cotización no encontrada'], 404);
        }

        return response()->json($cotizacion);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'proveedor_id' => 'required|exists:proveedores,id',
            'producto' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio_unitario' => 'required|numeric',
            'cantidad' => 'required|integer',
            'precio_total' => 'required|numeric',
            'impuesto' => 'nullable|numeric',
            'total_con_impuesto' => 'required|numeric',
            'fecha_cotizacion' => 'required|date',
        ]);

        $cotizacion = Cotizacion::create($request->all());

        return response()->json([
            'message' => 'Cotización creada con éxito',
            'cotizacion' => $cotizacion
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $cotizacion = Cotizacion::find($id);

        if (!$cotizacion) {
            return response()->json(['message' => 'Cotización no encontrada'], 404);
        }

        $request->validate([
            'proveedor_id' => 'required|exists:proveedores,id',
            'producto' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio_unitario' => 'required|numeric',
            'cantidad' => 'required|integer',
            'precio_total' => 'required|numeric',
            'impuesto' => 'nullable|numeric',
            'total_con_impuesto' => 'required|numeric',
            'fecha_cotizacion' => 'required|date',
        ]);
        $cotizacion->update($request->all());

        return response()->json([
            'message' => 'Cotización actualizada con éxito',
            'cotizacion' => $cotizacion
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cotizacion = Cotizacion::find($id);

        if (!$cotizacion) {
            return response()->json(['message' => 'Cotización no encontrada'], 404);
        }
        $cotizacion->delete();

        return response()->json(['message' => 'Cotización eliminada con éxito']);
    }
}



