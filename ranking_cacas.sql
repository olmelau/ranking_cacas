-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS ranking_cacas
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE ranking_cacas;

-- Tabla de usuarios
CREATE TABLE usuarios (
    id_usuario INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Tabla de grupos
CREATE TABLE grupos (
    id_grupo INT PRIMARY KEY AUTO_INCREMENT,
    nombre_grupo VARCHAR(100) NOT NULL,
    descripcion TEXT NULL,
    creado_por INT,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (creado_por) REFERENCES usuarios(id_usuario) ON DELETE SET NULL
) ENGINE=InnoDB;

-- Tabla pivote: usuarios en grupos
CREATE TABLE grupos_usuarios (
    id_usuario INT NOT NULL,
    id_grupo INT NOT NULL,
    fecha_union TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_usuario, id_grupo),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON DELETE CASCADE,
    FOREIGN KEY (id_grupo) REFERENCES grupos(id_grupo) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Tabla de contadores de cacas por usuario y grupo
CREATE TABLE contador_cacas (
    id_usuario INT NOT NULL,
    id_grupo INT NOT NULL,
    total_cacas INT NOT NULL DEFAULT 0,
    ultima_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id_usuario, id_grupo),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON DELETE CASCADE,
    FOREIGN KEY (id_grupo) REFERENCES grupos(id_grupo) ON DELETE CASCADE
) ENGINE=InnoDB;