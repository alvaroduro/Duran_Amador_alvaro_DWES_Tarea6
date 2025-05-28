<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Crear Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Formulario para crear producto</h2>
        <form method="POST" action="{{ route('poductos.store') }}" enctype="multipart/form-data">

            @csrf
            <div class="mb-3">
                <label class="form-label">Nombre:</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Categoría:</label>
                <input type="text" name="categoria" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">PVP:</label>
                <input type="number" step="0.01" name="pvp" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Stock:</label>
                <input type="number" name="stock" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Imagen:</label>
                <input type="file" name="imagen" class="form-control" accept="image/*">
            </div>

            <div class="mb-3">
                <label class="form-label">Observaciones:</label>
                <textarea name="observaciones" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Guardar</button>
        </form>
    </div>
</body>

</html>
