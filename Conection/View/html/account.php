<?php
session_start();
if (!isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit();
}
?>
<?php
// Incluir el archivo de conexión
include '../../Model/conection.php';

// Iniciar la sesión

// Obtener el ID del usuario desde la sesión
$userID = $_SESSION['user_id'];

// Crear una instancia de la clase conectar
$conexion = new conectar();
$conn = $conexion->conectarse();

try {
    // Preparar y ejecutar la consulta para obtener las últimas 3 citas del usuario
    $stmt = $conn->prepare("SELECT * FROM citas WHERE UserID = ? ORDER BY FechaHoraInicio DESC LIMIT 3");
    $stmt->bindParam(1, $userID, PDO::PARAM_INT);
    $stmt->execute();
    
    // Verificar si se encontraron citas
    if ($stmt->rowCount() > 0) {
        $citas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $citas = [];
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

    <div class="principal">
        <div class="menulateral">
            
            <div class="informacionusu">

                <a href="" class="redcos1 redcos">
                    <div class="cosi1 cos"><i class="fa-solid fa-house recurs"></i> Inicio</div>
                </a>
                <a href="update.php" class="redcos2 redcos">
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
                <div class="upgrid">
                    <div class="citasrec">
                        <h2 class="citsrec">Citas Recientes</h2>
                        <p class="explor">Explora tu historial de citas</p>
        <div id="citas-recientes">
            <?php if (count($citas) > 0): ?>
                <?php foreach ($citas as $cita): ?>
                    <div class="cita">
                        <?php
                            $estadoClase = '';
                            $estadoTexto = '';
                            $botonPago = '';

                            switch ($cita['Estado']) {
                                case 'Confirmada':
                                    $estadoClase = 'estado-activo';
                                    $estadoTexto = 'Activo';
                                    break;
                                case 'Pendiente':
                                    $estadoClase = 'estado-pendiente';
                                    $estadoTexto = 'Pendiente';
                                    $botonPago = '<a class="pagcitpbe" href="pagar.php?cita_id=' . $cita['CitaID'] . '">Pagar</a>';
                                    break;
                                case 'Cancelada':
                                    $estadoClase = 'estado-cancelada';
                                    $estadoTexto = 'Cancelada';
                                    break;
                                default:
                                    $estadoClase = 'estado-finalizada';
                                    $estadoTexto = 'Finalizada';
                                    break;
                            }
                        ?>
                        <div class="<?php echo $estadoClase; ?>">
                            <span class="estado-punto" style="background-color: <?php echo $estadoClase === 'estado-pendiente' ? '#ffda6a' : ($estadoClase === 'estado-activo' ? '#75b798' : ($estadoClase === 'estado-cancelada' ? '#ea868f' : '#383c44')); ?>"></span>
                            <strong><?php echo $estadoTexto; ?></strong>
                        </div>
                        <div class="ordforacc">
                        <div class="ordpacc orxpac">
                        <p class="infcpac">Mesa: <?php echo $cita['MesaID']; ?></p>
                        <p class="infcpac">Inicio: <?php echo $cita['FechaHoraInicio']; ?></p>
                        </div>
                        <div class="ordpacc2 orxpac">
                        <p class="infcpac">Fin: <?php echo $cita['FechaHoraFin']; ?></p>
                        <p class="infcpac">Jugadores: <?php echo $cita['CantidadJugadores']; ?></p>
                        </div>
                        </div>
                        <?php echo $botonPago; ?>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No has tenido citas recientes.</p>
            <?php endif; ?>
        </div>
                    </div>
                </div>
                


            </div>
            <div class="menulateral2">
            
            <div class="informacionusu2">

                <a href="#" class="redcos2 redcos17">
                    <div class="cosi11 cos"><i class="fa-solid fa-house recurs"></i> Inicio</div>
                </a>
                <a href="update.php" class="redcos2 redcos17">
                    <div class="cosi22 cos"><i class="fa-regular fa-address-card recurs"></i> Información Personal</div>
                </a>

            </div>
            <div class="infoxi2">
                <a href="../../Controller/logout.php" class="logout"><div><i class="fa-solid fa-right-to-bracket recurs"></i> Cerrar Sesión</div></a>
            </div>
        </div>

        </div>

        <div class="vacio2"></div>
    </div>

    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>