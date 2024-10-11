<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\Cotizacion;
use Illuminate\Http\Request;

class FacturaController extends Controller
{

    public function generarFactura(Request $request, $cotizacionId)
    {
        $cotizacion = Cotizacion::findOrFail($cotizacionId);

        $factura = new Factura();
        $factura->cotizacion_id = $cotizacion->id; 
        $factura->monto_total = $cotizacion->total_con_impuesto; 
        $factura->fecha_factura = now(); 
        $factura->estado = 'Pendiente'; 
        $factura->save(); 

        return response()->json([
            'message' => 'Factura generada con éxito',
            'factura' => $factura,
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $facturas = Factura::all(); 
        return response()->json($facturas);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $factura = Factura::findOrFail($id); 
        return response()->json($factura);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $factura = Factura::findOrFail($id); 
        $factura->update($request->all()); 
        return response()->json([
            'message' => 'Factura actualizada con éxito',
            'factura' => $factura,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $factura = Factura::findOrFail($id); 
        $factura->delete();
        return response()->json(['message' => 'Factura eliminada con éxito']);
    }
}
