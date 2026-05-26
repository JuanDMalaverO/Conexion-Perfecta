<?php
// Incluir el archivo de conexión
include '../Model/conection.php';

function verificar_correo($correoElectronico) {
    // Crear una instancia de la clase conectar
    $conexion = new conectar();
    $conn = $conexion->conectarse();

    try {
        // Preparar y ejecutar la consulta
        $stmt = $conn->prepare("SELECT COUNT(*) FROM usuarios WHERE CorreoElectronico = ?");
        $stmt->bindParam(1, $correoElectronico);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        // Verificar si se encontró el correo
        return $count > 0;
    } catch (PDOException $e) {
        // Manejar la excepción en caso de error
        echo "Error: " . $e->getMessage();
        return false;
    }
}

function registrar_usuario($nombre, $correoElectronico, $usu_clave, $id_rol_fk = 1) {
    // Crear una instancia de la clase conectar
    $conexion = new conectar();
    $conn = $conexion->conectarse();

    try {
        // Encriptar la contraseña
        $hashed_password = password_hash($usu_clave, PASSWORD_DEFAULT);

        // Preparar y ejecutar la consulta
        $stmt = $conn->prepare("INSERT INTO usuarios (Nombre, CorreoElectronico, Usu_clave, id_rol_fk) VALUES (?, ?, ?, ?)");
        $stmt->bindParam(1, $nombre);
        $stmt->bindParam(2, $correoElectronico);
        $stmt->bindParam(3, $hashed_password);
        $stmt->bindParam(4, $id_rol_fk);

        // Ejecutar la consulta y verificar si fue exitosa
        return $stmt->execute();
    } catch (PDOException $e) {
        // Manejar la excepción en caso de error
        echo "Error: " . $e->getMessage();
        return false;
    }
}
