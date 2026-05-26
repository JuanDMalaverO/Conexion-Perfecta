<?php
// Incluir el archivo de control de registro
include '../Controller/control_register.php';

session_start();

if (isset($_GET['namereg']) && isset($_GET['emailreg']) && isset($_GET['passwordreg'])) {
    $nombre = $_GET['namereg'];
    $correoElectronico = $_GET['emailreg'];
    $usu_clave = $_GET['passwordreg'];

    // Verificar si el correo electrónico ya está registrado
    if (verificar_correo($correoElectronico)) {
        $_SESSION['error_message'] = "El correo electrónico ya está registrado. Por favor, use otro correo.";
        header("Location: ../View/html/register.php");
        exit();
    } else {
        // Registrar al usuario si el correo electrónico no está registrado
        $resultado = registrar_usuario($nombre, $correoElectronico, $usu_clave);

        if ($resultado) {
            header("Location: ../View/html/login.php?register=success");
            exit();
        } else {
            $_SESSION['error_message'] = "Error al registrar el usuario.";
            header("Location: ../View/html/register.php");
            exit();
        }
    }
} else {
    $_SESSION['error_message'] = "Por favor, complete todos los campos del formulario.";
    header("Location: ../View/html/register.php");
    exit();
}