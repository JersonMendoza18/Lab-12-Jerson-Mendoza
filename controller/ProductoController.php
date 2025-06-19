<?php
require_once __DIR__ . '/../model/Producto.php';

class ProductoController {
    private $modelo;

    public function __construct() {
        $this->modelo = new Producto();
    }

    public function listarProductos() {
        return $this->modelo->listar();
    }

    public function obtenerProducto($id) {
        return $this->modelo->obtenerPorId($id);
    }
}
?>
