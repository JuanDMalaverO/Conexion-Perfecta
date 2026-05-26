<?php
session_start();
$logoutSuccess = isset($_GET['register']) && $_GET['register'] == 'success';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Agregar Titulo"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style_login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Conexión Perfecta | Agenda tu cita de billar</title>
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
                <a href="http://www.youtube.com/@juandavidmalaverorganista8132" target="_blank" class="hover:underline me-4 md:me-6"><i class="fa-brands fa-youtube"></i></a>
                <a href="https://twitter.com/JUANDAVIDMALA12" target="_blank" class="hover:underline me-4 md:me-6"><i class="fa-brands fa-x-twitter"></i></a>
            </div>
        </nav>
    </header>

    <div class="princip">
    <div class="wrapper">
    <div class="form-box login">
            <h2>Iniciar Sesión</h2>
            <form action="../../Controller/login.php" method="POST">
            <div class="input-box">
                <span class="icon"><ion-icon name="mail"></ion-icon></span>
                <input type="email" name="email" required>
                <label>Correo Electrónico</label>
            </div>
            <div class="input-box">
                <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                <input type="password" name="password" required>
                <label>Contraseña</label>
            </div>
            <div class="ingat">
                <label><input type="checkbox"> Recordar Contraseña</label>
                <a href="request_reset.php">Olvidé mi Contraseña</a>
            </div>
            
            <?php
            if (isset($_SESSION['error_message'])) {
                echo '<div class="error-message">' . htmlspecialchars($_SESSION['error_message']) . '</div>';
                unset($_SESSION['error_message']);
            }
            ?>
            <button type="submit" class="btnxd">Iniciar Sesión</button>
            <div class="login-register">
                <p>¿No tienes una cuenta? <a href="register.php" class="register-link"> Regístrate</a></p>
            </div>
        </form>
        </div>   
    </div>
</div>
<?php if ($logoutSuccess): ?>
    <div id="myModal" class="modal2">
        <div class="modal-content2">
            <span class="close"></span>
            <p><i class="fa-solid fa-check"></i> Usuario creado con exito, inicia sesión</p>
        </div>
    </div>
    <?php endif; ?>

    <script>
        var modal = document.getElementById("myModal");

        var span = document.getElementsByClassName("close")[0];

        function fadeInModal() {
            modal.classList.add('fade-in');
        }

        function fadeOutModal() {
            modal.classList.add('fade-out');
            setTimeout(function() {
                modal.style.display = "none";
                window.location.href = 'login.php';
            }, 1000);
        }
        span.onclick = function() {
            fadeOutModal();
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                fadeOutModal();
            }
        }

        <?php if ($logoutSuccess): ?>
        window.onload = function() {
            fadeInModal();
            setTimeout(function() {
                fadeOutModal();
            }, 3000);
        }
        <?php endif; ?>
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="../js/script_register.js"></script>
</body>
</html>