<?php
include_once '../../Model/conection.php';
include_once '../../Model/auth.php';

$con = new conectar();
$conexion = $con->conectarse();

// Obtener datos para el reporte de citas por mes
$query_citas_mes = $conexion->prepare("
    SELECT DATE_FORMAT(FechaHoraInicio, '%Y-%m') as Mes, COUNT(*) as TotalCitas 
    FROM citas 
    GROUP BY Mes 
    ORDER BY Mes
");
$query_citas_mes->execute();
$citas_mes = $query_citas_mes->fetchAll(PDO::FETCH_ASSOC);

// Obtener datos para el reporte de ingresos por mes
$query_ingresos_mes = $conexion->prepare("
    SELECT
        DATE_FORMAT(FechaHoraInicio, '%Y-%m') AS mes,
        SUM(TIMESTAMPDIFF(HOUR, FechaHoraInicio, FechaHoraFin) * 7000) AS ingresos_mensuales
    FROM
        citas
    GROUP BY
        mes
    ORDER BY
        mes
");
$query_ingresos_mes->execute();
$ingresos_mes = $query_ingresos_mes->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes</title>
    <link href="../../dist/output.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                <a href="../../index.php" class="flex items-center px-6 py-3 text-gray-700 group-hover:bg-blue-50 group-hover:text-blue-600 transition duration-200">
                    <i class="fas fa-home mr-3 text-gray-500 group-hover:text-blue-600 transition duration-200"></i>
                    <span class="font-medium">Inicio</span>
                </a>
            </li>
            <li class="group mt-2">
                <a href="usuarios.php" class="flex items-center px-6 py-3 text-gray-700 group-hover:bg-blue-50 group-hover:text-blue-600 transition duration-200">
                    <i class="fas fa-users mr-3 text-gray-500 group-hover:text-blue-600 transition duration-200"></i>
                    <span class="font-medium">Usuarios</span>
                </a>
            </li>
            <li class="group mt-2">
                <a href="citas.php" class="flex items-center px-6 py-3 text-gray-700 group-hover:bg-blue-50 group-hover:text-blue-600 transition duration-200">
                    <i class="fas fa-calendar-alt mr-3 text-gray-500 group-hover:text-blue-600 transition duration-200"></i>
                    <span class="font-medium">Citas</span>
                </a>
            </li>
            <li class="group mt-2">
                <a href="#" class="flex items-center px-6 py-3 text-gray-700 group-hover:bg-blue-50 group-hover:text-blue-600 transition duration-200">
                    <i class="fas fa-chart-line mr-3 text-gray-500 group-hover:text-blue-600 transition duration-200"></i>
                    <span class="font-medium">Reportes</span>
                </a>
            </li>
        </ul>
    </nav>
    <div class="mt-10 px-6">
        <a href="../../Controller/logout.php" class="block text-center bg-red-500 text-white py-2 rounded-lg hover:bg-red-600 transition duration-200">
            Cerrar Sesión
        </a>
    </div>
</aside>

        <!-- Contenido principal -->
        <main class="flex-1 p-10 bg-white shadow-lg rounded-lg">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Reportes</h2>

            <!-- Reporte de Citas por Mes -->
            <div class="mb-6">
                <h3 class="text-xl font-semibold text-gray-800">Citas por Mes</h3>
                <canvas id="citasMesChart"></canvas>
            </div>

            <!-- Reporte de Ingresos por Mes -->
            <div class="mb-6">
                <h3 class="text-xl font-semibold text-gray-800">Ingresos por Mes</h3>
                <canvas id="ingresosMesChart"></canvas>
            </div>
        </main>
    </div>

    <script>
        // Datos para Citas por Mes
        const citasMesLabels = <?= json_encode(array_column($citas_mes, 'Mes')) ?>;
        const citasMesData = <?= json_encode(array_column($citas_mes, 'TotalCitas')) ?>;

        const citasMesCtx = document.getElementById('citasMesChart').getContext('2d');
        const citasMesChart = new Chart(citasMesCtx, {
            type: 'line',
            data: {
                labels: citasMesLabels,
                datasets: [{
                    label: 'Citas por Mes',
                    data: citasMesData,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Datos para Ingresos por Mes
        const ingresosMesLabels = <?= json_encode(array_column($ingresos_mes, 'mes')) ?>;
        const ingresosMesData = <?= json_encode(array_column($ingresos_mes, 'ingresos_mensuales')) ?>;

        const ingresosMesCtx = document.getElementById('ingresosMesChart').getContext('2d');
        const ingresosMesChart = new Chart(ingresosMesCtx, {
            type: 'bar',
            data: {
                labels: ingresosMesLabels,
                datasets: [{
                    label: 'Ingresos por Mes',
                    data: ingresosMesData,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
