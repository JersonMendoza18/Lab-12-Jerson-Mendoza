<?php
require_once __DIR__ . '/../controller/ProductoController.php';
require_once __DIR__ . '/../controller/PersonaController.php';

$productoController = new ProductoController();
$productos = $productoController->listarProductos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Compra</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0">Registro de Compra</h2>
        </div>
        <div class="card-body">

            <?php if (isset($_GET['success'])): ?>
                <div class="alert alert-success">¡Compra registrada exitosamente!</div>
            <?php endif; ?>

            <form action="/Actividad1/index.php" method="POST" id="formCompra">
                <h4 class="mb-3">Datos de la Persona</h4>
                <div class="mb-3">
                    <label class="form-label">DNI:</label>
                    <input type="text" name="dni" class="form-control" required maxlength="8">
                </div>
                <div class="mb-3">
                    <label class="form-label">Nombre:</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>

                <h4 class="mt-4">Productos Comprados</h4>
                <table class="table table-bordered mt-3" id="tablaProductos">
                    <thead class="table-secondary">
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <select name="productos[0][idProducto]" class="form-select" required>
                                    <?php while ($p = $productos->fetch_assoc()): ?>
                                        <option value="<?= $p['idProducto'] ?>">
                                            <?= $p['nombre'] ?> - S/ <?= number_format($p['precio'], 2) ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </td>
                            <td>
                                <input type="number" name="productos[0][cantidad]" min="1" class="form-control" required>
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-danger btn-sm eliminarFila">X</button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="mb-4">
                    <button type="button" class="btn btn-outline-secondary" id="btnAgregarProducto">
                        + Añadir otro producto
                    </button>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <button type="submit" class="btn btn-success">Registrar Compra</button>
                    <a href="ListaComprasClienteView.php" class="btn btn-outline-primary">Ver Compras por Cliente</a>
                    <a href="ListaComprasGlobalView.php" class="btn btn-outline-primary">Ver Compras Global</a>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const btnAgregar = document.getElementById('btnAgregarProducto');
        const tabla = document.querySelector('#tablaProductos tbody');
        let index = 1;

        btnAgregar.addEventListener('click', () => {
            const nuevaFila = tabla.querySelector('tr').cloneNode(true);
            const selects = nuevaFila.querySelectorAll('select, input');
            selects.forEach(el => {
                const name = el.name;
                const nuevoNombre = name.replace(/\[\d+\]/, `[${index}]`);
                el.name = nuevoNombre;
                if (el.tagName === 'INPUT') el.value = '';
            });
            tabla.appendChild(nuevaFila);
            index++;
        });

        tabla.addEventListener('click', (e) => {
            if (e.target.classList.contains('eliminarFila')) {
                const totalFilas = tabla.querySelectorAll('tr').length;
                if (totalFilas > 1) {
                    e.target.closest('tr').remove();
                }
            }
        });
    });
</script>
</body>
</html>
