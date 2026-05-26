<?php
include '../Model/conection.php';

function verificar_usuario($correoElectronico, $password) {
    $conexion = new conectar();
    $conn = $conexion->conectarse();

    try {
        $stmt = $conn->prepare("SELECT UserID, Usu_clave, Nombre FROM usuarios WHERE CorreoElectronico = ?");
        $stmt->bindParam(1, $correoElectronico);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $hashed_password = $row['Usu_clave'];
            $nombre = $row['Nombre'];
            $user_id = $row['UserID'];

            if (password_verify($password, $hashed_password)) {
                return ['name' => $nombre, 'id' => $user_id];
            } else {
                return false;
            }
        } else {
            return false;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}

session_start();

if (isset($_POST['email']) && isset($_POST['password'])) {
    $correoElectronico = $_POST['email'];
    $password = $_POST['password'];

    $user = verificar_usuario($correoElectronico, $password);

    if ($user) {
        $_SESSION['user_email'] = $correoElectronico;
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_id'] = $user['id'];

        header("Location: ../index.php");
        exit();
    } else {
        $_SESSION['error_message'] = "Correo electrónico o contraseña incorrectos.";
        header("Location: ../View/html/login.php"); 
        exit();
    }
} else {
    $_SESSION['error_message'] = "Por favor, complete todos los campos del formulario.";
    header("Location: ../View/html/login.php"); 
    exit();
}