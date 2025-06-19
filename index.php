<?php
require_once 'controller/PersonaController.php';
require_once 'controller/CompraController.php';
require_once 'controller/ProductoController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dni = $_POST['dni'];
    $nombre = $_POST['nombre'];
    $productos = $_POST['productos'];

    $personaCtrl = new PersonaController();
    $persona = $personaCtrl->buscarPorDNI($dni);

    if (!$persona) {
        $personaCtrl->registrarPersona($nombre, $dni);
        $persona = $personaCtrl->buscarPorDNI($dni);
    }

    $compraCtrl = new CompraController();
    $productoCtrl = new ProductoController();
    $listaProductos = [];

    foreach ($productos as $p) {
        $info = $productoCtrl->obtenerProducto($p['idProducto']);
        $listaProductos[] = [
            'idProducto' => $p['idProducto'],
            'cantidad' => $p['cantidad'],
            'precio_unitario' => $info['precio']
        ];
    }

    $compraCtrl->registrarCompraCompleta($persona['idPersona'], $listaProductos);

    // Redirige después del POST para evitar duplicación
    header("Location: /Actividad1/view/CompraView.php?success=1");
    exit;
} else {
    // Mostrar el formulario por defecto
    include 'view/CompraView.php';
}
