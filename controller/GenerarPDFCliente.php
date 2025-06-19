<?php
require_once '../fpdf.php';
require_once __DIR__ . '/CompraController.php';

if (!isset($_GET['dni'])) {
    die("DNI no especificado.");
}

$dni = $_GET['dni'];
$controller = new CompraController();
$compras = $controller->obtenerComprasPorDNI($dni);

if (!$compras || $compras->num_rows === 0) {
    die("No se encontraron compras para el DNI especificado.");
}

$comprasArray = [];
$nombrePersona = '';

// Extraemos datos y almacenamos en array (para poder recorrerlos varias veces)
while ($row = $compras->fetch_assoc()) {
    $comprasArray[] = $row;
    if (!$nombrePersona) {
        $nombrePersona = $row['nombrePersona'];
    }
}

// Crear PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, "Reporte de Compras", 0, 1, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, "Nombre: $nombrePersona", 0, 1);
$pdf->Cell(0, 10, "DNI: $dni", 0, 1);
$pdf->Ln(5);

// Encabezado de tabla
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(60, 10, 'Producto', 1);
$pdf->Cell(30, 10, 'P. Unitario', 1);
$pdf->Cell(30, 10, 'Cantidad', 1);
$pdf->Cell(40, 10, 'Subtotal', 1);
$pdf->Ln();

// Detalle
$pdf->SetFont('Arial', '', 10);
$total = 0;
foreach ($comprasArray as $row) {
    $subtotal = $row['precio_unitario'] * $row['cantidad'];
    $total += $subtotal;

    $pdf->Cell(60, 10, $row['producto'], 1);
    $pdf->Cell(30, 10, 'S/ ' . number_format($row['precio_unitario'], 2), 1);
    $pdf->Cell(30, 10, $row['cantidad'], 1);
    $pdf->Cell(40, 10, 'S/ ' . number_format($subtotal, 2), 1);
    $pdf->Ln();
}

// Total
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(120, 10, 'Total:', 1);
$pdf->Cell(40, 10, 'S/ ' . number_format($total, 2), 1);

$pdf->Output();
