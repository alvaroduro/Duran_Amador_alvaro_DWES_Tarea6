<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-db', function () {
    try {
        DB::connection()->getPdo();
        return "✅ Conexión exitosa a la base de datos: " . DB::connection()->getDatabaseName();
    } catch (QueryException $e) {
        return "❌ No se pudo conectar a la base de datos. Error: " . $e->getMessage();
    }
});
