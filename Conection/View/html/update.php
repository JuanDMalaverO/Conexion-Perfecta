<?php
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['user_email'])) {
    header("Location: ../../login.php");
    exit();
}

// Incluir el archivo de conexión
require_once '../../Model/conection.php';

// Obtener el ID del usuario desde la sesión
$userID = $_SESSION['user_id'];

// Crear una instancia de la clase conectar
$conexion = new conectar();
$conn = $conexion->conectarse();

try {
    // Preparar y ejecutar la consulta para obtener la información del usuario
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE UserID = ?");
    $stmt->bindParam(1, $userID, PDO::PARAM_INT);
    $stmt->execute();
    
    // Verificar si se encontró el usuario
    if ($stmt->rowCount() > 0) {
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        // Redirigir al login si no se encuentra el usuario
        header("Location: ../../login.php");
        exit();
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Agregar Titulo"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style_account.css">
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
                <a class="in in3" href="agendar.php">Agenda tu cita</a>
            </div>
            <div class="social">
                <a href="https://www.instagram.com/juan.no.15/" target="_blank" class="hover:underline me-4 md:me-6"><i class="fa-brands fa-instagram"></i></a>
                <a href="http://www.youtube.com/@juandavidmalaverorganista8132" target="_blank" class="hover:underline me-4 md:me-6"><i class="fa-brands fa-youtube"></i></a>
                <a href="https://twitter.com/JUANDAVIDMALA12" target="_blank" class="hover:underline me-4 md:me-6"><i class="fa-brands fa-x-twitter"></i></a>
            </div>
        </nav>
    </header>
    <style>
        .containerxs { width: 60%; margin: auto; color: #dddddd; }
        .success-message, .error-message { margin: 10px 0; padding: 10px; border-radius: 5px; }
        .success-message { background-color: #051b11; color: #75b798; border-radius: 7px; border: 1px solid #0f5132;}
        .error-message { background-color: #2c0b0e; color: #ea868f; border-radius: 7px; border: 1px solid #842029;}
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; }
        .form-group input { width: 100%; padding: 8px; box-sizing: border-box; border-radius: 7px; }
        .form-group button { padding: 10px 20px; background-color: #209cf4; color: #fff; border: none; cursor: pointer; border-radius: 5px;}
        .cosi1 {
    background-color: transparent !important;
}

.cosi1:hover {
    background-color: rgba(255, 255, 255, 0.1) !important;
}
.cosi2 {
    background-color: rgba(255, 255, 255, 0.1) !important;

}

.vaxis {
    flex: 0.2 !important;
    width: 100%;
    height: 100%;
}

.vacio2 {
    flex: 0.2 !important;
    width: 100%;
    height: 100%;
}
    </style>

    <div class="principal">
        <div class="vaxis"></div>
        <div class="menulateral">
            
            <div class="informacionusu">

                <a href="account.php" class="redcos1 redcos">
                    <div class="cosi1 cos"><i class="fa-solid fa-house recurs"></i> Inicio</div>
                </a>
                <a href="" class="redcos2 redcos">
                    <div class="cosi2 cos"><i class="fa-regular fa-address-card recurs"></i> Información Personal</div>
                </a>

            </div>
            <div class="infoxi">
                <a href="../../Controller/logout.php" class="logout"><div><i class="fa-solid fa-right-to-bracket recurs"></i> Cerrar Sesión</div></a>
            </div>
        </div>
        <div class="contenidousu">

            <div class="imgusu">
                <div class="fotoprin2">
                    <i class="fa-solid fa-user fotoprin"></i>
                </div>
                <br>
                <div class="usuario">
                    <?php if (isset($_SESSION['user_name'])): ?>
                        <h2 class="personac">Hola, <?php echo htmlspecialchars($_SESSION['user_name']); ?></h2>
                    <?php else: ?>
                        <h3></h3>
                    <?php endif; ?>
                </div>
                <p class="infox2">Gestiona tu información, la privacidad y la seguridad para mejorar tu experiencia en Conexión Perfecta</p>
            </div>

            <div class="contenusu2">
            <div class="containerxs">
        <h2>Información de la Cuenta</h2>
        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="success-message"><?php echo htmlspecialchars($_SESSION['success_message']); unset($_SESSION['success_message']); ?></div>
        <?php endif; ?>
        <?php if (isset($_SESSION['error_message'])): ?>
            <div class="error-message"><?php echo htmlspecialchars($_SESSION['error_message']); unset($_SESSION['error_message']); ?></div>
        <?php endif; ?>
        <form action="../../Controller/update_account.php" method="POST">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input class="imforacup" type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($usuario['Nombre']); ?>" required>
            </div>
            <div class="form-group">
                <label for="correo">Correo Electrónico:</label>
                <input class="imforacup" type="email" id="correo" name="correo" value="<?php echo htmlspecialchars($usuario['CorreoElectronico']); ?>" required>
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input class="imforacup" type="text" id="telefono" name="telefono" value="<?php echo htmlspecialchars($usuario['Telefono']); ?>">
            </div>
            <div class="form-group">
                <label for="edad">Edad:</label>
                <input class="imforacup" type="number" id="edad" min="18" name="edad" value="<?php echo htmlspecialchars($usuario['Edad']); ?>">
            </div>
            <div class="form-group">
                <button type="submit">Actualizar Información</button>
            </div>
        </form>
    </div>

            </div>
                


            </div>
            <div class="vacio2"></div>
        </div>

        
    </div>

    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
