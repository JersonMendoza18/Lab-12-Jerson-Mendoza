-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS bd_ventas
CHARACTER SET utf8mb4
COLLATE utf8mb4_general_ci;

-- Usar la base de datos
USE bd_ventas;

-- Tabla persona
CREATE TABLE IF NOT EXISTS persona (
    idPersona INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    dni VARCHAR(8) NOT NULL UNIQUE
);

-- Tabla producto
CREATE TABLE IF NOT EXISTS producto (
    idProducto INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    precio DECIMAL(10, 2) NOT NULL
);

-- Tabla compra (encabezado)
CREATE TABLE IF NOT EXISTS compra (
    idCompra INT AUTO_INCREMENT PRIMARY KEY,
    idPersona INT NOT NULL,
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (idPersona) REFERENCES persona(idPersona)
);

-- Tabla detalle_compra
CREATE TABLE IF NOT EXISTS detalle_compra (
    idDetalle INT AUTO_INCREMENT PRIMARY KEY,
    idCompra INT NOT NULL,
    idProducto INT NOT NULL,
    cantidad INT NOT NULL,
    precio_unitario DECIMAL(10, 2) NOT NULL,
    subtotal DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (idCompra) REFERENCES compra(idCompra),
    FOREIGN KEY (idProducto) REFERENCES producto(idProducto)
);

-- Insertar productos adicionales
INSERT INTO producto (nombre, precio) VALUES
('Laptop HP', 2500.00),
('Mouse Logitech', 80.00),
('Teclado Redragon', 180.00),
('Monitor Samsung 24"', 650.00),
('Memoria RAM Kingston 8GB', 210.00),
('Disco Duro Externo 1TB', 320.00),
('Audífonos Sony WH-1000XM4', 1200.00),
('Parlantes Bluetooth JBL', 450.00),
('Impresora Epson EcoTank', 890.00),
('Webcam Logitech HD', 200.00),
('Cable HDMI 2m', 25.00),
('Silla Gamer Cougar', 750.00),
('Teclado Mecánico HyperX Alloy', 310.00),
('Router TP-Link AC1200', 180.00),
('Tableta Gráfica Wacom', 470.00),
('Micrófono Condensador USB', 250.00),
('Base Enfriadora para Laptop', 95.00),
('Hub USB 4 Puertos', 60.00),
('Mouse Pad XL', 35.00),
('SSD NVMe 500GB', 390.00);
