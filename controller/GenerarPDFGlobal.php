<?php
require_once '../fpdf.php';
require_once __DIR__ . '/CompraController.php';

$controller = new CompraController();
$compras = $controller->obtenerTodasLasCompras();

$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', "Reporte de TODAS las Compras"), 0, 1, 'C');
$pdf->Ln(5);

// Encabezado
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(50, 10, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', 'Nombre'), 1);
$pdf->Cell(25, 10, 'DNI', 1);
$pdf->Cell(47, 10, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', 'Producto'), 1);
$pdf->Cell(25, 10, 'P. Unitario', 1);
$pdf->Cell(20, 10, 'Cantidad', 1);
$pdf->Cell(25, 10, 'Subtotal', 1);
$pdf->Ln();

// Contenido
$pdf->SetFont('Arial', '', 9);
$totalGeneral = 0;

while ($row = $compras->fetch_assoc()) {
    $nombre = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $row['nombrePersona']);
    $producto = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $row['producto']);
    $dni = $row['dni'];
    $precio = number_format($row['precio_unitario'], 2);
    $cantidad = $row['cantidad'];
    $subtotal = $row['precio_unitario'] * $cantidad;
    $totalGeneral += $subtotal;

    $pdf->Cell(50, 10, $nombre, 1);
    $pdf->Cell(25, 10, $dni, 1);
    $pdf->Cell(47, 10, $producto, 1);
    $pdf->Cell(25, 10, 'S/ ' . $precio, 1);
    $pdf->Cell(20, 10, $cantidad, 1);
    $pdf->Cell(25, 10, 'S/ ' . number_format($subtotal, 2), 1);
    $pdf->Ln();
}

// Total
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(167, 10, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', 'Total General:'), 1);
$pdf->Cell(25, 10, 'S/ ' . number_format($totalGeneral, 2), 1);

// 🧹 Evita errores por salida previa (deprecaciones, espacios, etc.)
ob_clean();
$pdf->Output();
exit;
