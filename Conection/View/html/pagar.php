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
    // Obtener los detalles de la cita
    $stmt = $conn->prepare("SELECT * FROM citas WHERE CitaID = ?");
    $stmt->bindParam(1, $citaId, PDO::PARAM_INT);
    $stmt->execute();
    $cita = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$cita) {
        echo "Error: No se encontró la cita.";
        exit();
    }

    // Calcular el total a pagar
    $precioPorHora = 7000;
    $fechaHoraInicio = new DateTime($cita['FechaHoraInicio']);
    $fechaHoraFin = new DateTime($cita['FechaHoraFin']);
    $duracionHoras = $fechaHoraFin->diff($fechaHoraInicio)->h;
    $totalAPagar = $duracionHoras * $precioPorHora;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $sql = "UPDATE citas SET Estado = 'Confirmada' WHERE CitaID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $citaId);

        if ($stmt->execute()) {
            header("Location: ../../index.php?payment=success");
            exit();
        } else {
            echo "Error al confirmar el pago.";
        }
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagar Cita | Conexión Perfecta</title>
    <link rel="stylesheet" href="../css/pay.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<header class="header">
        <nav class="navegation">
            <div class="vacio"></div>
            <h2 class="logo">Conexión Perfecta</h2>
            <div class="info">
                <a class="in in1" href="../../index.php">Inicio</a>
                <a class="in in2" href="nosotros.php">Nosotros</a>
            </div>
            <div class="social">
              <a href="https://www.instagram.com/juan.no.15/" target="_blank" class="hover:underline me-4 md:me-6"><i class="fa-brands fa-instagram"></i></a>
              <a href="http://www.youtube.com/@Juan_Malaver" target="_blank" class="hover:underline me-4 md:me-6"><i class="fa-brands fa-youtube"></i></a>
              <a href="https://twitter.com/JUANDAVIDMALA12" target="_blank" class="hover:underline me-4 md:me-6"><i class="fa-brands fa-x-twitter"></i></a>
              <?php if (isset($_SESSION['user_name'])): ?>
                    <a href="account.php" class="boton-mi-cuenta"><i class="fa-solid fa-user"></i>Mi cuenta</a>
                <?php endif; ?>
            </div>
        </nav>
    </header>
    <section class="infpay">
    <div class="payment-container">
        <div class="form-container">
            <h2 class="form-title">Pagar y Confirmar Cita</h2>
            <form action="pagar.php?cita_id=<?php echo htmlspecialchars($citaId); ?>" method="POST">
                <div class="form-group">
                    <label for="card-number" class="form-label">Número de Tarjeta</label>
                    <input type="text" id="card-number" placeholder="XXXX XXXX XXXX XXXX" maxlength="19" required class="form-input">
                </div>
                <div class="form-group">
                    <label for="card-holder" class="form-label">Titular de la Tarjeta</label>
                    <input type="text" id="card-holder" placeholder="Nombre Completo" required class="form-input">
                </div>
                <div class="form-group-inline">
                    <div class="form-group">
                        <label for="expiry-date" class="form-label">Fecha de Expiración</label>
                        <input type="text" id="expiry-date" placeholder="MM/YY" maxlength="5" required class="form-input">
                    </div>
                    <div class="form-group">
                        <label for="cvv" class="form-label">CVV</label>
                        <input type="text" id="cvv" placeholder="123" maxlength="4" required class="form-input">
                    </div>
                </div>
                <div class="form-group">
                    <label for="billing-address" class="form-label">Dirección de Facturación</label>
                    <input type="text" id="billing-address" placeholder="Dirección completa" required class="form-input">
                </div>
                <div class="summary">
                    <h3 class="summary-title">Resumen de la Cita</h3>
                    <p><strong>Fecha y Hora de Inicio:</strong> <?php echo $fechaHoraInicio->format('Y-m-d H:i'); ?></p>
                    <p><strong>Duración:</strong> <?php echo $duracionHoras; ?> horas</p>
                    <p><strong>Mesa:</strong> <?php echo $cita['MesaID']; ?></p>
                    <p class="total"><strong>Total a pagar:</strong> COP $<?php echo number_format($totalAPagar); ?></p>
                </div>
                <button type="submit" class="confirm-button">Confirmar y Pagar</button>
            </form>
        </div>
        <div class="summary-container">
            <h3 class="summary-title">Detalles de Pago</h3>
            <p class="summary-text">Cita ID: <?php echo htmlspecialchars($citaId); ?></p>
            <p class="summary-text">Total a Pagar: COP $<?php echo number_format($totalAPagar); ?></p>
        </div>
    </div>
    </section>
</body>
</html>