<?php
require_once 'Conexion.php';

class DetalleCompra {
    private $conexion;

    public function __construct() {
        $this->conexion = (new Conexion())->getConexion();
    }

    public function registrar($idCompra, $idProducto, $cantidad, $precio_unitario) {
        $subtotal = $cantidad * $precio_unitario;
        $stmt = $this->conexion->prepare("INSERT INTO detalle_compra 
            (idCompra, idProducto, cantidad, precio_unitario, subtotal) 
            VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iiidd", $idCompra, $idProducto, $cantidad, $precio_unitario, $subtotal);
        return $stmt->execute();
    }
}
?>
