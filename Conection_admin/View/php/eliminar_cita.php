<?php
include_once '../../Model/conection.php';
include_once '../../Model/auth.php';

$con = new conectar();
$conexion = $con->conectarse();

if (isset($_GET['id'])) {
    $citaId = $_GET['id'];

    try {
        // Preparar la consulta para eliminar la cita
        $query_eliminar = $conexion->prepare("DELETE FROM citas WHERE CitaID = :id");
        $query_eliminar->bindParam(':id', $citaId, PDO::PARAM_INT);

        if ($query_eliminar->execute()) {
            // Redirigir a la página de citas con un mensaje de éxito
            header("Location: citas.php?mensaje=Cita eliminada correctamente");
            exit();
        } else {
            // Redirigir a la página de citas con un mensaje de error
            header("Location: citas.php?mensaje=Error al eliminar la cita");
            exit();
        }
    } catch (PDOException $e) {
        // Manejar errores si ocurren
        header("Location: citas.php?mensaje=Error: " . $e->getMessage());
        exit();
    }
} else {
    // Si no se proporciona un ID, redirigir a la página de citas
    header("Location: citas.php");
    exit();
}
