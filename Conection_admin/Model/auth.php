<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    // Si no está autenticado, redirigir a Conection/index.php para que ingrese la contraseña
    header("Location: /Conection_admin/index.php");
    exit();
}