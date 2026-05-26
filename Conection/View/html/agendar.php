<?php
session_start();
if (!isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit();
}
$agendaUrl = isset($_SESSION['user_name']) ? 'View/html/agendar.php' : 'View/html/login.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Agregar Titulo"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style_agendar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Conexión Perfecta | Agenda tu cita de billar</title>
</head>
<script>
        function setMinDate() {
            var today = new Date();
            today.setDate(today.getDate() + 1);
            var day = ("0" + today.getDate()).slice(-2);
            var month = ("0" + (today.getMonth() + 1)).slice(-2);
            var year = today.getFullYear();
            var minDate = year + "-" + month + "-" + day;
            document.getElementById('fecha').setAttribute('min', minDate);
        }
        window.onload = setMinDate;
    </script>
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

    <div class="principal">
        <div class="seccion1"></div>


        <div class="seccion2">
    <div class="containerfor">
        <h2 class="lox2">Agendar Cita</h2>
        <p class="avisel">Para garantizar la disponibilidad de la mesa de billar de su preferencia, le solicitamos agendar su cita con al menos 24 horas de anticipación.</p>
        <?php if (isset($_SESSION['error_message'])): ?>
            <div class="error-message"><?php echo htmlspecialchars($_SESSION['error_message']); unset($_SESSION['error_message']); ?></div>
        <?php endif; ?>
        <form action="../../Controller/agendar_cita.php" method="POST" id="appointmentForm">
            <div class="form-group">
                <label for="tipoMesa">Tipo de Mesa</label>
                <select name="tipoMesa" id="tipoMesa" required>
                    <option value="3 bandas">3 Bandas</option>
                    <option value="libres">Libres</option>
                    <option value="pool">Pool</option>
                </select>
            </div>
            <div class="form-group">
                <label for="fecha">Fecha</label>
                <input type="date" id="fecha" name="fecha" required>
            </div>
            <div class="form-group">
                <label for="fechaHoraInicio">Hora de inicio</label>
                <select name="fechaHoraInicio" id="fechaHoraInicio" required>
                    <option value="08:00">8:00 am</option>
                    <option value="08:30">8:30 am</option>
                    <option value="09:00">9:00 am</option>
                    <option value="09:30">9:30 am</option>
                    <option value="10:00">10:00 am</option>
                    <option value="10:30">10:30 am</option>
                    <option value="11:00">11:00 am</option>
                    <option value="11:30">11:30 am</option>
                    <option value="12:00">12:00 pm</option>
                    <option value="12:30">12:30 pm</option>
                    <option value="13:00">1:00 pm</option>
                    <option value="13:30">1:30 pm</option>
                    <option value="14:00">2:00 pm</option>
                    <option value="14:30">2:30 pm</option>
                    <option value="15:00">3:00 pm</option>
                    <option value="15:30">3:30 pm</option>
                    <option value="16:00">4:00 pm</option>
                    <option value="16:30">4:30 pm</option>
                    <option value="17:00">5:00 pm</option>
                    <option value="17:30">5:30 pm</option>
                    <option value="18:00">6:00 pm</option>
                    <option value="18:30">6:30 pm</option>
                    <option value="19:00">7:00 pm</option>
                    <option value="19:30">7:30 pm</option>
                    <option value="20:00">8:00 pm</option>
                    <option value="20:30">8:30 pm</option>
                    <option value="21:00">9:00 pm</option>
                    <option value="21:30">9:30 pm</option>
                    <option value="22:00">10:00 pm</option>
                </select>
            </div>
            <div class="form-group">
                <label for="horas">Horas de juego</label>
                <select name="horas" id="horas" required>
                    <option value="1">1 hora</option>
                    <option value="2">2 horas</option>
                    <option value="3">3 horas</option>
                    <option value="4">4 horas</option>
                </select>
            </div>
            <div class="form-group">
                <label for="cantidadJugadores">Jugadores</label>
                <input type="number" id="cantidadJugadores" name="cantidadJugadores" min="1" max="10" required>
                <small class="avisodor">Puedes agregar hasta un máximo de 10 jugadores.</small>
            </div>
            <div class="form-group button-group">
                <button type="submit" class="agforbi">Agendar</button>
            </div>
        </form>
    </div>
</div>




        <div class="seccion3"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="../js/agendar.js"></script>
</body>
</html>