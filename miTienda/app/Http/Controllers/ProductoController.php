<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\Validator;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todos los productos
        $productos = Producto::all();

        // Devolverlos en formato JSON
        return response()->json([
            'message' => '✅ Listado de productos obtenido correctamente',
            'data' => $productos
        ]);
    }

    public function store(Request $request)
    {
        // Validar los datos recibidos
        $validated = $request->validate([
            'nombre' => 'required|string|max:15|unique:productos,nombre',
            'categoria' => 'required|string|max:15',
            'pvp' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'imagen' => 'nullable|string|max:100',
            'observaciones' => 'nullable|string'
        ]);

        // Crear el producto
        $producto = Producto::create($validated);

        // Responder con JSON
        return response()->json([
            'message' => 'Producto creado correctamente',
            'producto' => $producto
        ], 201);
    }

    public function show($id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json([
                'message' => '❌ Producto no encontrado'
            ], 404);
        }
        return response()->json($producto);
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        // Validación
        $validated = Validator::make($request->all(), [
            'nombre' => 'required|string|max:15',
            'categoria' => 'required|string|max:15',
            'pvp' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'imagen' => 'nullable|string|max:100',
            'observaciones' => 'nullable|string'
        ]);

        if ($validated->fails()) {
            return response()->json([
                'message' => '❌ Error de validación',
                'errors' => $validated->errors(),
                'status' => 400
            ]);
        }

        // ✅ PASAR LOS DATOS VALIDADOS
        $producto->update($validated->validated());

        return response()->json([
            'message' => '✅ Producto actualizado correctamente',
            'producto' => $producto
        ], 200);
    }


    public function destroy($id)
    {
        Producto::destroy($id);
        return response()->json(null, 204);
    }
}
