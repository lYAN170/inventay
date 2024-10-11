<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use App\Models\Categoria; // Assuming you have a Categoria model
use App\Models\Categorias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Productos::with('categoria')->get(); // Fetch products with category relation
        return view('productos.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categorias::all(); // Get all categories for the dropdown
        return view('productos.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Log request data for debugging
        Log::info('Request Data:', $request->all());

        // Validate the request
        $request->validate([
            'Codigo_serie' => 'required|string|max:50',
            'Descripcion' => 'required|string|max:120',
            'cantidad' => 'required|integer',
            'precio' => 'required|numeric',
            'imagen' => 'required|image|max:2048',
            'categoria_id' => 'required|exists:categorias,id', // Ensure the category exists
        ]);

        // Store the uploaded image
        $path = $request->file('imagen')->store('imagenes');

        // Create the product with the validated data
        Productos::create(array_merge($request->all(), ['imagen' => $path]));

        // Redirect to the product index page with a success message
        return redirect()->route('admin.productos.index')->with('success', 'Producto creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Productos $producto)
    {
        return view('productos.show', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Productos $producto)
    {
        $categorias = Categorias::all(); // Get all categories for the dropdown
        return view('productos.edit', compact('producto', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Productos $producto)
    {
        // Log request data for debugging
        Log::info('Request Data:', $request->all());

        // Validate the request
        $request->validate([
            'Codigo_serie' => 'required|string|max:50',
            'Descripcion' => 'required|string|max:120',
            'cantidad' => 'required|integer',
            'precio' => 'required|numeric',
            'imagen' => 'nullable|image|max:2048', // Image is optional
            'categoria_id' => 'required|exists:categorias,id', // Ensure the category exists
        ]);

        // Store the uploaded image if provided
        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('imagenes');
            $producto->imagen = $path; // Update the image path
        }

        // Update the product with the validated data
        $producto->update($request->except('imagen')); // Exclude image field if not updated

        // Redirect to the product index page with a success message
        return redirect()->route('admin.productos.index')->with('success', 'Producto actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Productos $producto)
    {
        // Delete the product
        $producto->delete();

        // Redirect to the product index page with a success message
        return redirect()->route('admin.productos.index')->with('success', 'Producto eliminado exitosamente.');
    }
}
