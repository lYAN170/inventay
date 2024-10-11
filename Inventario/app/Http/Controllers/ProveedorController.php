<?php

namespace App\Http\Controllers;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proveedores = Proveedor::all(); 
        return response()->json($proveedores);
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
        $request->validate([
            'nombre' => 'required|string|max:150',
            'ruc' => 'required|string|max:50|unique:proveedores',
            'email' => 'nullable|email|max:255',
            'telefono' => 'required|string|max:50',
            'direccion' => 'required|string|max:255',
        ]);

        $proveedor = Proveedor::create($request->all());

        return response()->json([
            'message' => 'Proveedor creado con éxito',
            'proveedor' => $proveedor,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $proveedor = Proveedor::findOrFail($id); 
        return response()->json($proveedor);
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
        $proveedor = Proveedor::findOrFail($id); 

        $request->validate([
            'nombre' => 'required|string|max:150',
            'ruc' => 'required|string|max:50|unique:proveedores,ruc,' . $proveedor->id,
            'email' => 'nullable|email|max:255',
            'telefono' => 'required|string|max:50',
            'direccion' => 'required|string|max:255',
        ]);

        $proveedor->update($request->all());

        return response()->json([
            'message' => 'Proveedor actualizado con éxito',
            'proveedor' => $proveedor,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $proveedor = Proveedor::findOrFail($id); 
        $proveedor->delete(); 




        
        return response()->json(['message' => 'Proveedor eliminado con éxito']);
    }
}
