<?php
require_once 'Conexion.php';

class Compra {
    private $conn;

    public function __construct() {
        $this->conn = (new Conexion())->getConexion();
    }

    public function registrarCompra($idPersona, $productos) {
        $this->conn->begin_transaction();

        try {
            // Insertar encabezado de compra
            $stmt = $this->conn->prepare("INSERT INTO compra (idPersona) VALUES (?)");
            $stmt->bind_param("i", $idPersona);
            $stmt->execute();
            $idCompra = $stmt->insert_id;

            // Preparar inserción de detalles
            $stmtDetalle = $this->conn->prepare("
                INSERT INTO detalle_compra (idCompra, idProducto, cantidad, precio_unitario, subtotal)
                VALUES (?, ?, ?, ?, ?)
            ");

            foreach ($productos as $producto) {
                $cantidad = $producto['cantidad'];
                $precioUnitario = $producto['precio_unitario'];
                $subtotal = $cantidad * $precioUnitario;

                $stmtDetalle->bind_param(
                    "iiidd",
                    $idCompra,
                    $producto['idProducto'],
                    $cantidad,
                    $precioUnitario,
                    $subtotal
                );
                $stmtDetalle->execute();
            }

            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollback();
            throw $e;
        }
    }

    public function obtenerTodasLasCompras() {
        $sql = "
            SELECT p.nombre AS producto, c.precio_unitario, c.cantidad, 
                   (c.precio_unitario * c.cantidad) AS subtotal,
                   pe.nombre AS nombrePersona, pe.dni
            FROM detalle_compra c
            JOIN producto p ON c.idProducto = p.idProducto
            JOIN compra co ON c.idCompra = co.idCompra
            JOIN persona pe ON co.idPersona = pe.idPersona
            ORDER BY pe.nombre ASC
        ";
        return $this->conn->query($sql);
    }

    public function obtenerComprasPorDNI($dni) {
        $stmt = $this->conn->prepare("
            SELECT pe.nombre AS nombrePersona, pe.dni, pr.nombre AS producto, 
                   dc.precio_unitario, dc.cantidad, 
                   (dc.precio_unitario * dc.cantidad) AS subtotal
            FROM persona pe
            JOIN compra c ON pe.idPersona = c.idPersona
            JOIN detalle_compra dc ON c.idCompra = dc.idCompra
            JOIN producto pr ON dc.idProducto = pr.idProducto
            WHERE pe.dni = ?
        ");
        $stmt->bind_param("s", $dni);
        $stmt->execute();
        return $stmt->get_result();
    }
}
