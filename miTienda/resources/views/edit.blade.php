
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container">
    <h2 class="mb-4">Editar Producto</h2>

    {{-- Mostrar errores de validación --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>❌ Por favor corrige los siguientes errores:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('productos.update', $producto->codprod) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') {{-- Método PUT para actualizar --}}

        <div class="mb-3">
            <label class="form-label">Nombre:</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $producto->nombre) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Categoría:</label>
            <input type="text" name="categoria" class="form-control" value="{{ old('categoria', $producto->categoria) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">PVP:</label>
            <input type="number" step="0.01" name="pvp" class="form-control" value="{{ old('pvp', $producto->pvp) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Stock:</label>
            <input type="number" name="stock" class="form-control" value="{{ old('stock', $producto->stock) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Imagen actual:</label><br>
            @if ($producto->imagen)
                <img src="{{ asset($producto->imagen) }}" width="100" height="100" class="mb-2">
            @else
                <p>No hay imagen</p>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label">Cambiar Imagen:</label>
            <input type="file" name="imagen" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Observaciones:</label>
            <textarea name="observaciones" class="form-control">{{ old('observaciones', $producto->observaciones) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('productos.index') }}" class="btn btn-secondary">Volver</a>
    </form>
</div>
</body>
</html>
