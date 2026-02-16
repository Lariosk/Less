CREATE DATABASE inventario
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE inventario;
CREATE TABLE producto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo VARCHAR(50) NOT NULL UNIQUE,
    nombre VARCHAR(150) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10,2) NOT NULL CHECK (precio > 0),
    stock INT NOT NULL DEFAULT 0 CHECK (stock >= 0),
    activo BOOLEAN NOT NULL DEFAULT TRUE,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
CREATE TABLE categoria (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL UNIQUE,
    descripcion TEXT
);
CREATE TABLE proveedor (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL UNIQUE,
    contacto VARCHAR(100),
    telefono VARCHAR(20),
    email VARCHAR(100)
);
CREATE TABLE producto_categoria (
    producto_id INT NOT NULL,
    categoria_id INT NOT NULL,
    PRIMARY KEY (producto_id, categoria_id),
    FOREIGN KEY (producto_id) REFERENCES producto(id) ON DELETE CASCADE,            
    FOREIGN KEY (categoria_id) REFERENCES categoria(id) ON DELETE CASCADE
);
CREATE INDEX idx_nombre ON producto(nombre);
CREATE INDEX idx_activo ON producto(activo);
INSERT INTO producto (codigo, nombre, descripcion, precio, stock)
VALUES 
('P001', 'Laptop Lenovo', 'Laptop 16GB RAM', 18500.00, 10),
('P002', 'Mouse Logitech', 'Mouse inalámbrico', 350.00, 50),
('P003', 'Teclado Mecánico', 'Switch azul', 1200.00, 20);
