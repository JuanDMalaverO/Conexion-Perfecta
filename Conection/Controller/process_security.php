<?php
session_start();
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
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Validar que la nueva contraseña y la confirmación sean iguales
    if ($new_password !== $confirm_password) {
        $_SESSION['error_message'] = "Las nuevas contraseñas no coinciden.";
        header("Location: ../View/html/security.php");
        exit();
    }

    try {
        // Obtener la contraseña actual desde la base de datos
        $stmt = $conn->prepare("SELECT Usu_clave FROM usuarios WHERE UserID = ?");
        $stmt->bindParam(1, $userID, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user || !password_verify($current_password, $user['Usu_clave'])) {
            $_SESSION['error_message'] = "La contraseña actual es incorrecta.";
            header("Location: ../View/html/security.php");
            exit();
        }

        // Actualizar la contraseña en la base de datos
        $new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE usuarios SET Usu_clave = ? WHERE UserID = ?");
        $stmt->bindParam(1, $new_password_hashed, PDO::PARAM_STR);
        $stmt->bindParam(2, $userID, PDO::PARAM_INT);
        $stmt->execute();

        $_SESSION['success_message'] = "La contraseña ha sido cambiada con éxito.";
        header("Location: ../View/html/security.php");
        exit();
    } catch (PDOException $e) {
        $_SESSION['error_message'] = "Error al cambiar la contraseña: " . $e->getMessage();
        header("Location: ../View/html/security.php");
        exit();
    }
} else {
    // Redirigir a la página de seguridad si el método de solicitud no es POST
    header("Location: ../View/html/security.php");
    exit();
}
