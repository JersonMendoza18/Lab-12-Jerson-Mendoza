<?php
require_once '../controller/CompraController.php';
require_once '../controller/PersonaController.php';

$compras = [];
$dni = '';
if (isset($_GET['dni'])) {
    $dni = $_GET['dni'];
    $controller = new CompraController();
    $compras = $controller->obtenerComprasPorDNI($dni);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Compras por Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card shadow">
        <div class="card-header bg-info text-white">
            <h4 class="mb-0 text-center">Filtrar Compras por DNI</h4>
        </div>
        <div class="card-body">
            <form class="row g-3 mb-4" method="GET">
                <div class="col-md-6">
                    <label class="form-label">Ingrese DNI:</label>
                    <input type="text" name="dni" value="<?= htmlspecialchars($dni) ?>" class="form-control" required>
                </div>
                <div class="col-md-6 align-self-end">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                    <a href="CompraView.php" class="btn btn-secondary">Volver</a>
                    <?php if ($dni): ?>
                        <a href="../controller/GenerarPDFCliente.php?dni=<?= urlencode($dni) ?>" target="_blank" class="btn btn-success">
                            PDF Cliente
                        </a>
                    <?php endif; ?>
                </div>
            </form>

            <?php if ($dni && $compras && $compras->num_rows > 0): ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-center">
                        <thead class="table-secondary">
                            <tr>
                                <th>Nombre</th>
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
                                    <td><?= htmlspecialchars($row['producto']) ?></td>
                                    <td>S/ <?= number_format($row['precio_unitario'], 2) ?></td>
                                    <td><?= $row['cantidad'] ?></td>
                                    <td>S/ <?= number_format($row['subtotal'], 2) ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php elseif ($dni): ?>
                <div class="alert alert-warning">No se encontraron compras para el DNI <?= htmlspecialchars($dni) ?>.</div>
            <?php endif; ?>
        </div>
    </div>
</div>

</body>
</html>
