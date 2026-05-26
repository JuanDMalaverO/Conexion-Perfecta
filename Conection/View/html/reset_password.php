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
        </nav>
    </header>

    <div class="princip">
    <div class="wrapper">
    <div class="form-box login">
            <h2>Restablecer Contraseña</h2>
            <form action="../../Controller/update_password.php" method="POST">
            <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
            <div class="input-box">
                <span class="icon"><ion-icon name="mail"></ion-icon></span>
                <input type="password" name="password" id="password" required>
                <label>Nueva Contraseña</label>
            </div>


            <div class="input-box">
                <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                <input type="password" name="confirm_password" id="confirm_password" required>
                <label>Confirmar Nueva Contraseña</label>
            </div>
            
            <button type="submit" class="btnxd">Iniciar Sesión</button>
        </form>
        </div>   
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="../js/script_register.js"></script>
</body>
</html>