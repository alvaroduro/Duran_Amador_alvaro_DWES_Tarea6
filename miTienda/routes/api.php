<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/test-db', function () {
    try {
        DB::connection()->getPdo();
        return "✅ Conexión exitosa a la base de datos: " . DB::connection()->getDatabaseName();
    } catch (QueryException $e) {
        return "❌ No se pudo conectar a la base de datos. Error: " . $e->getMessage();
    }
});

use App\Http\Controllers\ProductoController;

//Route::resource('productos', ProductoController::class);

// Vista del formulario
Route::post('/crearProducto', [ProductoController::class, 'store']);



Route::apiResource('productos', ProductoController::class);


