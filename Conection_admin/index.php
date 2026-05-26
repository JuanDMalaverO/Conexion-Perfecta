<?php
session_start();
require_once __DIR__ . '/config.php';

// Verificar si la sesión ya está autenticada
if (isset($_POST['password'])) {
    $password = $_POST['password'];
    if (hash_equals(ADMIN_PASSWORD, $password)) {
        $_SESSION['authenticated'] = true;
        header("Location: index.php");
        exit();
    } else {
        $error = "Contraseña incorrecta.";
    }
}

if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true):
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificación de Identidad</title>
    <link href="dist/output.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-900 font-sans">
    <div class="flex items-center justify-center min-h-screen bg-gray-900 bg-opacity-75">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-sm">
            <h1 class="text-2xl font-semibold text-center mb-4">Verifique su Identidad</h1>
            <form method="POST" action="index.php">
                <div class="mb-4">
                    <label class="block text-gray-700">Contraseña:</label>
                    <input type="password" name="password" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500" required>
                </div>
                <?php if (isset($error)): ?>
                    <p class="text-red-500 text-center"><?= $error ?></p>
                <?php endif; ?>
                <div class="flex justify-center">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-200">Ingresar</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

<?php
exit();
endif;
?>
<?php
include_once 'Model/conection.php';

$con = new conectar();
$conexion = $con->conectarse();

// Total de usuarios hasta la fecha
$query_total_usuarios = $conexion->prepare("SELECT COUNT(*) as total FROM usuarios");
$query_total_usuarios->execute();
$total_usuarios = $query_total_usuarios->fetch(PDO::FETCH_ASSOC)['total'];

// Usuarios registrados esta semana
$query_usuarios_esta_semana = $conexion->prepare("
    SELECT COUNT(*) as total FROM usuarios 
    WHERE YEARWEEK(created_at, 1) = YEARWEEK(CURDATE(), 1)
");
$query_usuarios_esta_semana->execute();
$usuarios_esta_semana = $query_usuarios_esta_semana->fetch(PDO::FETCH_ASSOC)['total'];

// Usuarios registrados la semana pasada
$query_usuarios_semana_pasada = $conexion->prepare("
    SELECT COUNT(*) as total FROM usuarios 
    WHERE YEARWEEK(created_at, 1) = YEARWEEK(CURDATE() - INTERVAL 1 WEEK, 1)
");
$query_usuarios_semana_pasada->execute();
$usuarios_semana_pasada = $query_usuarios_semana_pasada->fetch(PDO::FETCH_ASSOC)['total'];

// Cálculo del cambio porcentual
if ($usuarios_semana_pasada > 0) {
    $cambio_porcentual = (($usuarios_esta_semana - $usuarios_semana_pasada) / $usuarios_semana_pasada) * 100;
} else {
    $cambio_porcentual = $usuarios_esta_semana > 0 ? 100 : 0;
}

// Texto de cambio (incremento o decremento)
$cambio_texto = $cambio_porcentual >= 0 ? "incremento" : "decremento";
$cambio_color = $cambio_porcentual >= 0 ? "bg-green-100 text-green-600" : "bg-red-100 text-red-600";

// Consulta para obtener el número de citas de hoy
$query_citas_hoy = $conexion->prepare("SELECT COUNT(*) as total FROM citas WHERE DATE(FechaHoraInicio) = CURDATE()");
$query_citas_hoy->execute();
$citas_hoy = $query_citas_hoy->fetch(PDO::FETCH_ASSOC)['total'];

// Consulta para obtener el número de citas activas
$query_citas_activas = $conexion->prepare("SELECT COUNT(*) as total FROM citas WHERE Estado='Confirmada'");
$query_citas_activas->execute();
$citas_activas = $query_citas_activas->fetch(PDO::FETCH_ASSOC)['total'];

$query_usuarios_por_dia = $conexion->prepare("
    SELECT DATE(created_at) as fecha, COUNT(*) as total 
    FROM usuarios 
    WHERE created_at >= CURDATE() - INTERVAL 7 DAY 
    GROUP BY DATE(created_at)
");
$query_usuarios_por_dia->execute();
$usuarios_por_dia = $query_usuarios_por_dia->fetchAll(PDO::FETCH_ASSOC);

$query_citas_por_hora = $conexion->prepare("
    SELECT HOUR(FechaHoraInicio) as hora, COUNT(*) as total 
    FROM citas 
    WHERE DATE(FechaHoraInicio) = CURDATE() 
    GROUP BY HOUR(FechaHoraInicio)
");
$query_citas_por_hora->execute();
$citas_por_hora = $query_citas_por_hora->fetchAll(PDO::FETCH_ASSOC);

// Datos para el gráfico de usuarios por día
$fechas = [];
$totales_usuarios = [];
foreach ($usuarios_por_dia as $row) {
    $fechas[] = $row['fecha'];
    $totales_usuarios[] = $row['total'];
}

// Datos para el gráfico de citas por hora
$horas = [];
$totales_citas = [];
foreach ($citas_por_hora as $row) {
    $horas[] = $row['hora'];
    $totales_citas[] = $row['total'];
}


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conexión Perfecta | Administrador</title>
    <link href="dist/output.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body class="bg-gray-100 text-gray-900 font-sans">
    <div class="flex min-h-screen">
        <!-- Menú lateral -->
        <aside class="w-64 bg-white shadow-lg">
    <div class="p-6">
        <h1 class="text-2xl font-semibold text-gray-800">Conexión Perfecta</h1>
    </div>
    <nav class="mt-8">
        <ul>
            <li class="group">
                <a href="#" class="flex items-center px-6 py-3 text-gray-700 group-hover:bg-blue-50 group-hover:text-blue-600 transition duration-200">
                    <i class="fas fa-home mr-3 text-gray-500 group-hover:text-blue-600 transition duration-200"></i>
                    <span class="font-medium">Inicio</span>
                </a>
            </li>
            <li class="group mt-2">
                <a href="View/php/usuarios.php" class="flex items-center px-6 py-3 text-gray-700 group-hover:bg-blue-50 group-hover:text-blue-600 transition duration-200">
                    <i class="fas fa-users mr-3 text-gray-500 group-hover:text-blue-600 transition duration-200"></i>
                    <span class="font-medium">Usuarios</span>
                </a>
            </li>
            <li class="group mt-2">
                <a href="View/php/citas.php" class="flex items-center px-6 py-3 text-gray-700 group-hover:bg-blue-50 group-hover:text-blue-600 transition duration-200">
                    <i class="fas fa-calendar-alt mr-3 text-gray-500 group-hover:text-blue-600 transition duration-200"></i>
                    <span class="font-medium">Citas</span>
                </a>
            </li>
            <li class="group mt-2">
                <a href="View/php/reportes.php" class="flex items-center px-6 py-3 text-gray-700 group-hover:bg-blue-50 group-hover:text-blue-600 transition duration-200">
                    <i class="fas fa-chart-line mr-3 text-gray-500 group-hover:text-blue-600 transition duration-200"></i>
                    <span class="font-medium">Reportes</span>
                </a>
            </li>
        </ul>
    </nav>
    <div class="mt-10 px-6">
        <a href="Controller/logout.php" class="block text-center bg-red-500 text-white py-2 rounded-lg hover:bg-red-600 transition duration-200">
            Cerrar Sesión
        </a>
    </div>
</aside>


        <!-- Contenido principal -->
        <main class="flex-1 p-10 bg-white shadow-lg rounded-lg">
            <div class="mb-8">
                <h2 class="text-3xl font-semibold text-gray-800">Dashboard del Administrador</h2>
                <p class="text-gray-600">Gestión y monitoreo de las operaciones del sistema.</p>
            </div>

            <!-- Sección de tarjetas principales -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
                <div class="bg-gray-100 p-6 rounded-lg shadow-md">
                    <h3 class="text-gray-600 text-lg">Total de Usuarios</h3>
                    <p class="text-4xl font-bold text-gray-800 mt-2"><?= $total_usuarios ?></p>
                    <div class="mt-2">
                        <span class="inline-block <?= $cambio_color ?> text-sm px-2 py-1 rounded">
                            <?= number_format(abs($cambio_porcentual), 2) ?>% <?= $cambio_texto ?> desde la semana pasada
                        </span>
                    </div>
                </div>
                <div class="bg-gray-100 p-6 rounded-lg shadow-md">
                    <h3 class="text-gray-600 text-lg">Citas para Hoy</h3>
                    <p class="text-4xl font-bold text-gray-800 mt-2"><?= $citas_hoy ?></p>
                    <div class="mt-2">
                        <span class="inline-block bg-blue-100 text-blue-600 text-sm px-2 py-1 rounded">En curso</span>
                    </div>
                </div>
                <div class="bg-gray-100 p-6 rounded-lg shadow-md">
                    <h3 class="text-gray-600 text-lg">Citas Activas</h3>
                    <p class="text-4xl font-bold text-gray-800 mt-2"><?= $citas_activas ?></p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Gráfico de Usuarios Registrados por Día -->
                <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Usuarios Registrados en los Últimos 7 Días</h3>
                    <div class="relative" style="max-width: 700px; max-height: 700px;">
                        <canvas id="usuariosChart"></canvas>
                    </div>
                </div>

                <!-- Gráfico de Citas por Hora -->
                <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Distribución de Citas por Hora (Hoy)</h3>
                    <div class="relative" style="max-width: 700px; max-height: 700px;">
                        <canvas id="citasChart"></canvas>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Datos para el gráfico de Usuarios por Día
        const usuariosData = {
            labels: <?= json_encode($fechas) ?>,
            datasets: [{
                label: 'Usuarios Registrados',
                backgroundColor: '#4CAF50',
                borderColor: '#4CAF50',
                data: <?= json_encode($totales_usuarios) ?>,
            }]
        };

        const configUsuarios = {
            type: 'bar',
            data: usuariosData,
            options: {
                maintainAspectRatio: true,
                responsive: true,
                scales: {
                    x: {
                        beginAtZero: true,
                    },
                    y: {
                        beginAtZero: true,
                    }
                }
            }
        };

        new Chart(document.getElementById('usuariosChart'), configUsuarios);

        // Datos para el gráfico de Citas por Hora
        const citasData = {
            labels: <?= json_encode($horas) ?>,
            datasets: [{
                label: 'Citas por Hora',
                backgroundColor: '#2196F3',
                borderColor: '#2196F3',
                data: <?= json_encode($totales_citas) ?>,
            }]
        };

        const configCitas = {
            type: 'bar',
            data: citasData,
            options: {
                maintainAspectRatio: true,
                responsive: true,
                scales: {
                    x: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Horas del Día'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Número de Citas'
                        }
                    }
                }
            }
        };

        new Chart(document.getElementById('citasChart'), configCitas);
    </script>
</body>
</html>