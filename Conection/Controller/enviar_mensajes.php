<?php
include '../Model/conection.php';

function obtenerUsuarios() {
    $conexion = new conectar();
    $conn = $conexion->conectarse();

    $stmt = $conn->prepare("SELECT Nombre, CorreoElectronico FROM usuarios");
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function enviarCorreo($nombre, $email) {
    $asunto = "¡Oferta Especial en Conexión Perfecta!";
    $mensaje = "
    <html>
    <head>
        <title>Oferta Especial</title>
    </head>
    <body>
        <h1>Hola, $nombre</h1>
        <p>Tenemos una oferta especial para ti. ¡No te la pierdas!</p>
        <p>Visita nuestra página y agenda tu cita ahora mismo.</p>
        <a href='http://tu-sitio.com'>Conexión Perfecta</a>
    </body>
    </html>
    ";

    // Encabezados del correo
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: no-reply@tu-sitio.com" . "\r\n";

    // Enviar correo
    mail($email, $asunto, $mensaje, $headers);
}

$usuarios = obtenerUsuarios();

foreach ($usuarios as $usuario) {
    enviarCorreo($usuario['Nombre'], $usuario['CorreoElectronico']);
}

echo "Mensajes enviados exitosamente.";