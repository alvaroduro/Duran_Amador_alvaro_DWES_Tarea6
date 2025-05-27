<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="text-center mb-4">📦 Listado de Productos</h2>

    <!-- Formulario para leer datos (búsqueda, filtrado, etc.) -->
    <form method="GET" action="" class="mb-4">
        <div class="row g-2">
            <div class="col-md-6">
                <input type="text" name="buscar" class="form-control" placeholder="🔍 Buscar producto por nombre">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Buscar</button>
            </div>
        </div>
    </form>

    <!-- Tabla de productos -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>PVP</th>
                    <th>Stock</th>
                    <th>Imagen</th>
                    <th>Observaciones</th>
                    <th>Operaciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Suponiendo que tienes una variable $productos con los datos -->
                <?php foreach ($productos as $producto): ?>
                    <tr class="text-center">
                        <td><?= $producto->codprod ?></td>
                        <td><?= htmlspecialchars($producto->nombre) ?></td>
                        <td><?= htmlspecialchars($producto->categoria) ?></td>
                        <td><?= number_format($producto->pvp, 2) ?> €</td>
                        <td><?= $producto->stock ?></td>
                        <td>
                        @if($producto->imagen)
                            <img src="{{ asset($producto->imagen) }}"  width="40" height="40">
                        @else
                            No hay imagen
                        @endif
                    </td>
                        <td><?= htmlspecialchars($producto->observaciones) ?></td>
                        <td>
                            <a href="{{ route('productos.edit', $producto) }}" class="btn btn-sm btn-warning me-1">✏️ Editar</a>
                             
                            <form action="{{ route('productos.destroy', $producto->codprod) }}"
                                    method="POST" class="d-inline">
                                    @csrf
                            @method('DELETE')
                                <input type="hidden" name="id" value="<?= $producto->codprod ?>">
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este producto?')">🗑️ Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>

                <?php if (empty($productos)): ?>
                    <tr>
                        <td colspan="8" class="text-center text-muted">No hay productos disponibles.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
