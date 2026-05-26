<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
include '../Model/conection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $conexion = new conectar();
    $conn = $conexion->conectarse();

    // Verificar si el correo electrónico existe
    $stmt = $conn->prepare("SELECT UserID FROM usuarios WHERE CorreoElectronico = ?");
    $stmt->bindParam(1, $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $userId = $row['UserID'];

        // Crear un token único
        $token = bin2hex(random_bytes(50));

        // Guardar el token en la base de datos con una validez de 1 hora
        $stmt = $conn->prepare("INSERT INTO password_resets (UserID, Token, Expiry) VALUES (?, ?, DATE_ADD(NOW(), INTERVAL 1 HOUR))");
        $stmt->bindParam(1, $userId);
        $stmt->bindParam(2, $token);
        $stmt->execute();

        // Configurar PHPMailer para enviar el correo
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = MAIL_HOST;
            $mail->SMTPAuth   = true;
            $mail->Username   = MAIL_USER;
            $mail->Password   = MAIL_PASS;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = MAIL_PORT;

            // Desactivar la verificación del certificado en entorno de desarrollo
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            $mail->CharSet = 'UTF-8';

            $mail->setFrom(MAIL_USER, MAIL_FROM_NAME);
            $mail->addAddress($email); // Añadir destinatario

            // Contenido del correo
            $resetLink = APP_URL . '/View/html/reset_password.php?token=' . $token;
            $mail->isHTML(true);
            $mail->Subject = 'Restablecer tu contraseña';
            $mail->Body = '
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: "Georgia", serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333333;
        }
        .container {
            width: 100%;
            padding: 0;
            background-color: #ffffff;
            margin: 20px auto;
            max-width: 600px;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #2c3e50;
            color: #ecf0f1;
            padding: 20px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: normal;
        }
        .content {
            padding: 30px;
            text-align: left;
            line-height: 1.6;
        }
        .content h2 {
            color: #2c3e50;
            font-size: 22px;
            margin-bottom: 20px;
        }
        .content p {
            margin: 15px 0;
        }
        .button-container {
            text-align: center;
            margin-top: 30px;
        }
        .button {
            background-color: #2c3e50;
            color: #ffffff !important;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            display: inline-block;
        }
        .button:hover {
            background-color: #1a252f;
        }
        .footer {
            text-align: center;
            padding: 20px;
            font-size: 12px;
            color: #999999;
            background-color: #2c3e50;
            border-radius: 0 0 10px 10px;
            color: #ecf0f1;
        }
        .footer p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Conexión Perfecta</h1>
        </div>
        <div class="content">
            <h2>Restablecer tu Contraseña</h2>
            <p>Estimado cliente,</p>
            <p>Hemos recibido una solicitud para restablecer tu contraseña. Si no has realizado esta solicitud, puedes ignorar este mensaje.</p>
            <p>Para proceder con el restablecimiento de tu contraseña, por favor, haz clic en el siguiente enlace:</p>
            <div class="button-container">
                <a href="' . $resetLink . '" class="button">Restablecer Contraseña</a>
            </div>
            <p>Este enlace será válido por 1 hora. Si tienes alguna pregunta, no dudes en contactarnos.</p>
        </div>
        <div class="footer">
            <p>&copy; 2024 Conexión Perfecta. Todos los derechos reservados.</p>
            <p>Este mensaje ha sido enviado automáticamente, por favor, no respondas a este correo.</p>
        </div>
    </div>
</body>
</html>
';


            if ($mail->send()) {
                echo 'Se ha enviado un enlace de restablecimiento a tu correo electrónico.';
            } else {
                echo "Error al enviar el correo electrónico. Mailer Error: {$mail->ErrorInfo}";
            }
        } catch (Exception $e) {
            echo "Error al enviar el correo electrónico. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "El correo electrónico no está registrado.";
    }
}