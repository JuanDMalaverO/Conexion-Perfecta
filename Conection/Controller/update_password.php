<?php
include '../Model/conection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'];
    $newPassword = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($newPassword === $confirmPassword) {
        $conexion = new conectar();
        $conn = $conexion->conectarse();

        // Verificar el token
        $stmt = $conn->prepare("SELECT UserID FROM password_resets WHERE Token = ? AND Expiry > NOW()");
        $stmt->bindParam(1, $token);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $userId = $row['UserID'];

            // Actualizar la contraseña
            $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
            $stmt = $conn->prepare("UPDATE usuarios SET Usu_clave = ? WHERE UserID = ?");
            $stmt->bindParam(1, $hashedPassword);
            $stmt->bindParam(2, $userId);

            if ($stmt->execute()) {
                // Eliminar el token de restablecimiento
                $stmt = $conn->prepare("DELETE FROM password_resets WHERE UserID = ?");
                $stmt->bindParam(1, $userId);
                $stmt->execute();

                echo "Tu contraseña ha sido restablecida con éxito.";
            } else {
                echo "Error al restablecer la contraseña.";
            }
        } else {
            echo "El enlace de restablecimiento es inválido o ha expirado.";
        }
    } else {
        echo "Las contraseñas no coinciden.";
    }
}