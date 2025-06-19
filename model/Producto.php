<?php
require_once 'Conexion.php';

class Producto {
    private $conexion;

    public function __construct() {
        $this->conexion = (new Conexion())->getConexion();
    }

    public function listar() {
        $sql = "SELECT * FROM producto";
        return $this->conexion->query($sql);
    }

    public function obtenerPorId($idProducto) {
        $stmt = $this->conexion->prepare("SELECT * FROM producto WHERE idProducto = ?");
        $stmt->bind_param("i", $idProducto);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}
?>
