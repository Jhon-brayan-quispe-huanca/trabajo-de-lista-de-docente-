CREATE DATABASE IF NOT EXISTS profesores_db;

USE profesores_db;

CREATE TABLE IF NOT EXISTS profesores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    años INT NOT NULL,
    especialidad VARCHAR(255) NOT NULL
);

INSERT INTO profesores (nombre, años, especialidad) VALUES 
('Juan Perez', 10, 'Matemáticas'),
('Ana Gómez', 15, 'Historia'),
('Luis Rodríguez', 1, 'Física'),
('María Fernández', 20, 'Química'),
('Carlos López', 8, 'Biología');
