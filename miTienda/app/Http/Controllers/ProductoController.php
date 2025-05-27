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
        $productos = Producto::all(); // o paginados con Producto::paginate(10);
        return view('listar', compact('productos'));

        // Devolverlos en formato JSON
        /*return response()->json([
            'message' => '✅ Listado de productos obtenido correctamente',
            'data' => $productos
        ]);*/
    }

    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'nombre' => 'required|string|max:15',
            'categoria' => 'required|string|max:15',
            'pvp' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'observaciones' => 'nullable|string'
        ]);

        if ($validated->fails()) {
            return response()->json([
                'message' => '❌ Error de validación',
                'errors' => $validated->errors()
            ], 400);
        }

        $data = $request->all();

        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $imagen->move(public_path('images'), $nombreImagen);
            $data['imagen'] = 'images/' . $nombreImagen;
        }

        $producto = Producto::create($data);

        return response()->json([
            'message' => '✅ Producto creado correctamente',
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

        $validated = Validator::make($request->all(), [
            'nombre' => 'required|string|max:15',
            'categoria' => 'required|string|max:15',
            'pvp' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'observaciones' => 'nullable|string'
        ]);

        if ($validated->fails()) {
            return response()->json([
                'message' => '❌ Error de validación',
                'errors' => $validated->errors()
            ], 400);
        }

        $data = $request->all();

        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $imagen->move(public_path('images'), $nombreImagen);
            $data['imagen'] = 'images/' . $nombreImagen;
        } else {
            $data['imagen'] = $producto->imagen; // mantener imagen anterior si no se sube nueva
        }

        $producto->update($data);

        return response()->json([
            'message' => '✅ Producto actualizado correctamente',
            'producto' => $producto
        ], 200);
    }



    public function destroy($id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json([
                'message' => '❌ Producto no encontrado',
            ], 404);
        }

        $producto->delete();

        return response()->json([
            'message' => '✅ Producto eliminado correctamente',
            'producto_eliminado' => $producto
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        return view('edit', compact('producto'));
    }
}
