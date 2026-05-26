<?php
session_start();
include '../../Model/conection.php';

if (!isset($_GET['cita_id'])) {
    header("Location: ../../index.php");
    exit();
}

$citaId = $_GET['cita_id'];

$conexion = new conectar();
$conn = $conexion->conectarse();

try {
    $stmt = $conn->prepare("SELECT * FROM citas WHERE CitaID = ?");
    $stmt->bindParam(1, $citaId, PDO::PARAM_INT);
    $stmt->execute();
    $cita = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$cita) {
        echo "Error: No se encontró la cita.";
        exit();
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Pago</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="confirmation-message">
            <h2>¡Pago Confirmado!</h2>
            <p>Tu cita ha sido agendada con éxito.</p>
            <div class="cita-detalles">
                <h3>Detalles de la Cita</h3>
                <p><strong>ID de la Cita:</strong> <?php echo $cita['CitaID']; ?></p>
                <p><strong>Fecha y Hora de Inicio:</strong> <?php echo $cita['FechaHoraInicio']; ?></p>
                <p><strong>Duración:</strong> <?php echo $cita['Duracion']; ?> horas</p>
                <p><strong>Mesa:</strong> <?php echo $cita['MesaID']; ?></p>
                <p><strong>Estado:</strong> <?php echo $cita['Estado']; ?></p>
            </div>
            <a href="../../index.php" class="btn">Volver al Inicio</a>
        </div>
    </div>
</body>
</html>
