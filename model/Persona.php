<?php
require_once 'Conexion.php';

class Persona {
    private $conn;

    public function __construct() {
        $this->conn = (new Conexion())->getConexion();
    }

    public function registrar($nombre, $dni) {
        $stmt = $this->conn->prepare("INSERT INTO persona (nombre, dni) VALUES (?, ?)");
        $stmt->bind_param("ss", $nombre, $dni);
        return $stmt->execute();
    }

    public function buscarPorDNI($dni) {
        $stmt = $this->conn->prepare("SELECT * FROM persona WHERE dni = ?");
        $stmt->bind_param("s", $dni);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}
