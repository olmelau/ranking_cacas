-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS cacometro
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE cacometro;

-- Tabla de usuarios
CREATE TABLE usuarios (
    id_usuario INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

-- Tabla de grupos (con contraseña)
CREATE TABLE grupos (
    id_grupo INT PRIMARY KEY AUTO_INCREMENT,
    nombre_grupo VARCHAR(100) NOT NULL,
    contrasena VARCHAR(255) NOT NULL, -- Para entrar al grupo
    creado_por INT NOT NULL, -- Usuario que creó el grupo (admin)
    total_cacas INT NOT NULL DEFAULT 0,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    descripcion VARCHAR(300),
    FOREIGN KEY (creado_por) REFERENCES usuarios(id_usuario) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Tabla pivote: usuarios en grupos (con rol)
CREATE TABLE grupos_usuarios (
    id_usuario INT NOT NULL,
    id_grupo INT NOT NULL,
    rol ENUM('admin', 'miembro') DEFAULT 'miembro', -- Para identificar admins
    fecha_union TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_usuario, id_grupo),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON DELETE CASCADE,
    FOREIGN KEY (id_grupo) REFERENCES grupos(id_grupo) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Tabla de contadores de cacas por usuario y grupo
CREATE TABLE contador_cacas (
    id_usuario INT NOT NULL,
    total_cacas INT NOT NULL DEFAULT 0,
    ultima_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id_usuario),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Nota: Cuando un usuario crea un grupo:
-- 1. Se inserta en grupos (con él como creado_por)
-- 2. Se inserta en grupos_usuarios con rol='admin'

-- Cuando un usuario se une a un grupo existente:
-- 1. Se inserta en grupos_usuarios con rol='miembro'
-- 2. Se inserta en contador_cacas con total_cacas=0

-- Cuando un usuario hace click en el botón caca:
-- UPDATE contador_cacas SET total_cacas = total_cacas + 1 
-- WHERE id_usuario = ? AND id_grupo IN (todos sus grupos)

-- Cuando un admin añade un usuario a un grupo:
-- 1. Verifica que existe el usuario por username/email
-- 2. Inserta en grupos_usuarios con rol='miembro'
-- 3. Inserta en contador_cacas con total_cacas=0

-- Cuando un usuario sale de un grupo:
-- DELETE FROM grupos_usuarios WHERE id_usuario = ? AND id_grupo = ?
-- (el ON DELETE CASCADE eliminará su contador automáticamente)

-- Cuando un admin elimina un grupo:
-- DELETE FROM grupos WHERE id_grupo = ? 
-- (el ON DELETE CASCADE eliminará relaciones y contadores automáticamente)

-- Cuando un usuario elimina su cuenta:
-- DELETE FROM usuarios WHERE id_usuario = ?
-- (el ON DELETE CASCADE eliminará todo su rastro)