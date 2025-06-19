<?php
class Conexion {
    private $host = "localhost";
    private $usuario = "root";
    private $clave = "My password";
    private $bd = "bd_ventas";
    private $conexion;

    public function __construct() {
        $this->conexion = new mysqli($this->host, $this->usuario, $this->clave, $this->bd);
        if ($this->conexion->connect_error) {
            die("Error de conexión: " . $this->conexion->connect_error);
        }
    }

    public function getConexion() {
        return $this->conexion;
    }
}
?>
