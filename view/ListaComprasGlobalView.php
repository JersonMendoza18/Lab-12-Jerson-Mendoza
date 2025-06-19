<?php
require_once '../controller/CompraController.php';

$controller = new CompraController();
$compras = $controller->obtenerTodasLasCompras();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Todas las Compras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0 text-center">Listado de Todas las Compras</h4>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-end mb-3">
                <a href="CompraView.php" class="btn btn-secondary">Volver</a>
                <a href="../controller/GenerarPDFGlobal.php" target="_blank" class="btn btn-danger ms-2">Generar PDF General</a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>Nombre</th>
                            <th>DNI</th>
                            <th>Producto</th>
                            <th>Precio Unitario</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $compras->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['nombrePersona']) ?></td>
                                <td><?= htmlspecialchars($row['dni']) ?></td>
                                <td><?= htmlspecialchars($row['producto']) ?></td>
                                <td>S/ <?= number_format($row['precio_unitario'], 2) ?></td>
                                <td><?= $row['cantidad'] ?></td>
                                <td>S/ <?= number_format($row['subtotal'], 2) ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

</body>
</html>