<?php

namespace App\Http\Controllers;
use App\Models\Pedido;
use App\Models\Proveedor;
use App\Models\Cotizacion;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pedidos = Pedido::with('proveedor', 'cotizacion')->get(); // Trae pedidos con sus relaciones
        return view('pedidos.index', compact('pedidos'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $proveedores = Proveedor::all(); 
        $cotizaciones = Cotizacion::all(); 
        return view('pedidos.create', compact('proveedores', 'cotizaciones'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'proveedor_id' => 'required|exists:proveedores,id',
            'cotizacion_id' => 'nullable|exists:cotizaciones,id', 
            'producto' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:255',
            'precio_unitario' => 'required|numeric',
            'cantidad' => 'required|integer',
            'fecha_pedido' => 'required|date',
            'estado' => 'required|string|max:50',
            'fecha_entrega' => 'nullable|date',
        ]);

        // Crear el pedido en la base de datos
        Pedido::create($request->all());

        // Redireccionar con un mensaje de éxito
        return redirect()->route('admin.pedidos.index')->with('success', 'Pedido creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
