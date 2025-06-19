<?php
require_once __DIR__ . '/../model/Compra.php';
require_once __DIR__ . '/../model/Persona.php';

class CompraController {
    private $compraModel;

    public function __construct() {
        $this->compraModel = new Compra();
    }

    public function registrarCompraCompleta($idPersona, $productos) {
        return $this->compraModel->registrarCompra($idPersona, $productos);
    }

    public function obtenerComprasPorDNI($dni) {
        return $this->compraModel->obtenerComprasPorDNI($dni);
    }

    public function obtenerTodasLasCompras() {
        return $this->compraModel->obtenerTodasLasCompras();
    }
}
