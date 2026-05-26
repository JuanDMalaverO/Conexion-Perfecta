<?php
include_once '../Model/conection.php';
include_once '../Model/auth.php';

$con = new conectar();
$conexion = $con->conectarse();

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Llamar al procedimiento almacenado para eliminar el usuario
    $query_eliminar = $conexion->prepare("CALL EliminarUsuario(:id)");
    $query_eliminar->bindParam(':id', $userId, PDO::PARAM_INT);

    if ($query_eliminar->execute()) {
        // Redirigir de vuelta a la página de usuarios con un mensaje de éxito
        header("Location: ../View/php/usuarios.php?mensaje=Usuario eliminado correctamente");
        exit();
    } else {
        // Redirigir de vuelta a la página de usuarios con un mensaje de error
        header("Location: ../View/php/usuarios.php?mensaje=Error al eliminar el usuario");
        exit();
    }
} else {
    // Si no se proporciona un ID válido, redirigir de vuelta a la página de usuarios
    header("Location: ../View/php/usuarios.php");
    exit();
}
