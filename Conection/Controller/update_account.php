<?php
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['user_email'])) {
    header("Location: ../login.php");
    exit();
}

// Incluir el archivo de conexión
require_once '../Model/conection.php';

// Obtener el ID del usuario desde la sesión
$userID = $_SESSION['user_id'];

// Crear una instancia de la clase conectar
$conexion = new conectar();
$conn = $conexion->conectarse();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $edad = $_POST['edad'];
    $nivelJuego = $_POST['nivelJuego'];

    try {
        // Preparar y ejecutar la consulta para actualizar la información del usuario
        $stmt = $conn->prepare("UPDATE usuarios SET Nombre = ?, CorreoElectronico = ?, Telefono = ?, Edad = ?, NivelJuego = ? WHERE UserID = ?");
        $stmt->bindParam(1, $nombre, PDO::PARAM_STR);
        $stmt->bindParam(2, $correo, PDO::PARAM_STR);
        $stmt->bindParam(3, $telefono, PDO::PARAM_STR);
        $stmt->bindParam(4, $edad, PDO::PARAM_INT);
        $stmt->bindParam(5, $nivelJuego, PDO::PARAM_STR);
        $stmt->bindParam(6, $userID, PDO::PARAM_INT);
        $stmt->execute();

        // Establecer un mensaje de éxito y redirigir a la página de cuenta
        $_SESSION['success_message'] = "Información actualizada con éxito.";
        header("Location: ../View/html/update.php");
        exit();
    } catch (PDOException $e) {
        // Establecer un mensaje de error y redirigir a la página de cuenta
        $_SESSION['error_message'] = "Error al actualizar la información: " . $e->getMessage();
        header("Location: ../View/html/update.php");
        exit();
    }
} else {
    // Redirigir a la página de cuenta si el método de solicitud no es POST
    header("Location: ../View/html/update.php");
    exit();
}
