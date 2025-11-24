-- Script de Base de Datos para Aula.Net
-- Ejecutar en phpMyAdmin o línea de comandos MySQL
-- IMPORTANTE: Cambiar 'alumno_jperez' por 'alumno_[tu_inicial][tu_apellido]'

CREATE DATABASE IF NOT EXISTS aula_net CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE aula_net;

-- Tabla 1: Usuarios del sistema (para login)
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    tipo ENUM('alumno', 'profesor', 'admin') DEFAULT 'alumno',
    nombre_completo VARCHAR(100),
    email VARCHAR(100),
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    activo BOOLEAN DEFAULT TRUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabla 2: Alumno individual (CAMBIAR EL NOMBRE DE LA TABLA)
-- Ejemplo: Si tu nombre es Juan Pérez, la tabla debe ser: alumno_jperez
CREATE TABLE IF NOT EXISTS alumno_jperez (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombres VARCHAR(100) NOT NULL,
    numero_cedula VARCHAR(20) UNIQUE NOT NULL,
    correo_electronico VARCHAR(100) NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabla 3: Clases/Cursos
CREATE TABLE IF NOT EXISTS clases (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(200) NOT NULL,
    descripcion TEXT,
    profesor_id INT,
    categoria VARCHAR(50),
    imagen VARCHAR(255),
    precio DECIMAL(10, 2),
    duracion_horas INT,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    activa BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (profesor_id) REFERENCES usuarios(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabla 4: Profesores
CREATE TABLE IF NOT EXISTS profesores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT UNIQUE,
    especialidad VARCHAR(100),
    experiencia_anos INT,
    calificacion DECIMAL(3, 2) DEFAULT 0.00,
    biografia TEXT,
    telefono VARCHAR(20),
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabla 5: Inscripciones/Reservas (relación entre alumnos y clases)
CREATE TABLE IF NOT EXISTS inscripciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    alumno_id INT NOT NULL,
    clase_id INT NOT NULL,
    fecha_inscripcion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    estado ENUM('pendiente', 'confirmada', 'cancelada', 'completada') DEFAULT 'pendiente',
    nota_final DECIMAL(5, 2),
    comentario TEXT,
    FOREIGN KEY (alumno_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (clase_id) REFERENCES clases(id) ON DELETE CASCADE,
    UNIQUE KEY unique_inscripcion (alumno_id, clase_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insertar datos de ejemplo para usuarios
INSERT INTO usuarios (usuario, password, tipo, nombre_completo, email) VALUES
('alumno', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'alumno', 'Alumno Demo', 'alumno@aula.net'),
('profesor1', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'profesor', 'Profesor Demo', 'profesor@aula.net'),
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', 'Administrador', 'admin@aula.net');
-- Nota: La contraseña encriptada es '1234' para todos los usuarios de ejemplo

-- Insertar datos en tabla alumno_jperez (CAMBIAR POR TUS DATOS REALES)
-- IMPORTANTE: Reemplazar con tus datos personales
INSERT INTO alumno_jperez (nombres, numero_cedula, correo_electronico) VALUES
('Juan Pérez', '1234567890', 'juan.perez@email.com');
-- CAMBIAR: nombres, numero_cedula, correo_electronico por tus datos reales

-- Insertar clases de ejemplo
INSERT INTO clases (titulo, descripcion, categoria, imagen, precio, duracion_horas, profesor_id) VALUES
('Programación Web Full Stack', 'Aprende a crear aplicaciones web completas desde cero', 'Tecnología', 'programming.jpg', 50000, 40, 2),
('Machine Learning e IA', 'Domina los algoritmos de aprendizaje automático', 'Tecnología', 'machine-learning.jpg', 60000, 50, 2),
('Guitarra Clásica y Moderna', 'Desde acordes básicos hasta técnicas avanzadas', 'Música', 'guitar.jpg', 30000, 30, 2),
('Piano para Principiantes', 'Inicia tu camino musical con el piano', 'Música', 'piano.jpg', 35000, 35, 2),
('Química Orgánica', 'Comprende las reacciones y estructuras orgánicas', 'Ciencias', 'chemistry.jpg', 45000, 40, 2);

-- Insertar profesores de ejemplo
INSERT INTO profesores (usuario_id, especialidad, experiencia_anos, calificacion, biografia) VALUES
(2, 'Programación y Tecnología', 10, 4.8, 'Profesor con amplia experiencia en desarrollo web y tecnologías modernas');

-- Crear índices para mejorar rendimiento
CREATE INDEX idx_clases_categoria ON clases(categoria);
CREATE INDEX idx_inscripciones_estado ON inscripciones(estado);
CREATE INDEX idx_usuarios_tipo ON usuarios(tipo);


