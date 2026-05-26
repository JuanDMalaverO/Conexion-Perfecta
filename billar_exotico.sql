-- ============================================================
--  Base de datos: billar_exotico
--  Proyecto: Conexión Perfecta
--  Reconstruida a partir del código fuente PHP
-- ============================================================

CREATE DATABASE IF NOT EXISTS `billar_exotico`
  CHARACTER SET utf8
  COLLATE utf8_general_ci;

USE `billar_exotico`;

-- ------------------------------------------------------------
-- Tabla: roles
-- Roles de usuario del sistema
-- ------------------------------------------------------------
CREATE TABLE `roles` (
  `Rol_id`     INT          NOT NULL AUTO_INCREMENT,
  `NombreRol`  VARCHAR(50)  NOT NULL,
  PRIMARY KEY (`Rol_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Datos base: el código usa id_rol_fk=1 al auto-registrarse
-- y Rol_id=2 cuando el admin agrega un usuario manualmente
INSERT INTO `roles` (`Rol_id`, `NombreRol`) VALUES
  (1, 'Admin'),
  (2, 'Usuario');

-- ------------------------------------------------------------
-- Tabla: usuarios
-- Cuentas de usuario de la plataforma
-- ------------------------------------------------------------
CREATE TABLE `usuarios` (
  `UserID`             INT           NOT NULL AUTO_INCREMENT,
  `Nombre`             VARCHAR(100)  NOT NULL,
  `CorreoElectronico`  VARCHAR(150)  NOT NULL,
  `Usu_clave`          VARCHAR(255)  NOT NULL,
  `Telefono`           VARCHAR(20)   DEFAULT NULL,
  `Edad`               INT           DEFAULT NULL,
  `NivelJuego`         VARCHAR(50)   DEFAULT NULL,
  `id_rol_fk`          INT           NOT NULL DEFAULT 2,
  `created_at`         DATETIME      NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`UserID`),
  UNIQUE KEY `uk_correo` (`CorreoElectronico`),
  CONSTRAINT `fk_usuario_rol`
    FOREIGN KEY (`id_rol_fk`) REFERENCES `roles` (`Rol_id`)
    ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ------------------------------------------------------------
-- Tabla: mesasbillar
-- Mesas físicas del billar
-- IDs codificados en agendar_cita.php:
--   11,12,13 => '3 bandas'
--   21,22,23,24 => 'libres'
--   31 => 'pool'
-- ------------------------------------------------------------
CREATE TABLE `mesasbillar` (
  `MesaID`    INT          NOT NULL,
  `TipoMesa`  VARCHAR(50)  NOT NULL,
  PRIMARY KEY (`MesaID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `mesasbillar` (`MesaID`, `TipoMesa`) VALUES
  (11, '3 bandas'),
  (12, '3 bandas'),
  (13, '3 bandas'),
  (21, 'libres'),
  (22, 'libres'),
  (23, 'libres'),
  (24, 'libres'),
  (31, 'pool');

-- ------------------------------------------------------------
-- Tabla: citas
-- Reservas de mesa agendadas por los usuarios
-- Estado puede ser: Pendiente, Confirmada, Cancelada
-- ------------------------------------------------------------
CREATE TABLE `citas` (
  `CitaID`            INT      NOT NULL AUTO_INCREMENT,
  `UserID`            INT      NOT NULL,
  `MesaID`            INT      NOT NULL,
  `FechaHoraInicio`   DATETIME NOT NULL,
  `FechaHoraFin`      DATETIME NOT NULL,
  `Estado`            ENUM('Pendiente','Confirmada','Cancelada') NOT NULL DEFAULT 'Pendiente',
  `CantidadJugadores` INT      NOT NULL,
  PRIMARY KEY (`CitaID`),
  CONSTRAINT `fk_cita_usuario`
    FOREIGN KEY (`UserID`) REFERENCES `usuarios` (`UserID`)
    ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT `fk_cita_mesa`
    FOREIGN KEY (`MesaID`) REFERENCES `mesasbillar` (`MesaID`)
    ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ------------------------------------------------------------
-- Tabla: password_resets
-- Tokens temporales para restablecimiento de contraseña
-- El token expira 1 hora después de su creación (ver send_reset_link.php)
-- ------------------------------------------------------------
CREATE TABLE `password_resets` (
  `id`      INT          NOT NULL AUTO_INCREMENT,
  `UserID`  INT          NOT NULL,
  `Token`   VARCHAR(100) NOT NULL,
  `Expiry`  DATETIME     NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_token` (`Token`),
  CONSTRAINT `fk_reset_usuario`
    FOREIGN KEY (`UserID`) REFERENCES `usuarios` (`UserID`)
    ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
