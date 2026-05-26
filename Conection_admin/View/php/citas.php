<?php
include_once '../../Model/conection.php';
include_once '../../Model/auth.php';

$con = new conectar();
$conexion = $con->conectarse();

// Consulta para obtener las citas junto con la información del usuario y la mesa
$query_citas = $conexion->prepare("
    SELECT c.CitaID, u.Nombre as NombreUsuario, u.CorreoElectronico, m.TipoMesa as NombreMesa, 
           c.FechaHoraInicio, c.FechaHoraFin, c.Estado 
    FROM citas c
    JOIN usuarios u ON c.UserID = u.UserID
    JOIN mesasbillar m ON c.MesaID = m.MesaID
");
$query_citas->execute();
$citas = $query_citas->fetchAll(PDO::FETCH_ASSOC);

$mensaje = '';
if (isset($_GET['mensaje'])) {
    $mensaje = $_GET['mensaje'];
}

$citaIdBusqueda = isset($_GET['cita_id']) ? $_GET['cita_id'] : '';

// Modificar la consulta SQL para que incluya la búsqueda por CitaID
if ($citaIdBusqueda) {
    $query_citas = $conexion->prepare("
        SELECT c.CitaID, u.Nombre as NombreUsuario, u.CorreoElectronico, m.TipoMesa as NombreMesa, 
               c.FechaHoraInicio, c.FechaHoraFin, c.Estado 
        FROM citas c
        JOIN usuarios u ON c.UserID = u.UserID
        JOIN mesasbillar m ON c.MesaID = m.MesaID
        WHERE c.CitaID = :cita_id
    ");
    $query_citas->bindParam(':cita_id', $citaIdBusqueda, PDO::PARAM_INT);
} else {
    $query_citas = $conexion->prepare("
        SELECT c.CitaID, u.Nombre as NombreUsuario, u.CorreoElectronico, m.TipoMesa as NombreMesa, 
               c.FechaHoraInicio, c.FechaHoraFin, c.Estado 
        FROM citas c
        JOIN usuarios u ON c.UserID = u.UserID
        JOIN mesasbillar m ON c.MesaID = m.MesaID
    ");
}

$query_citas->execute();
$citas = $query_citas->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Citas</title>
    <link href="../../dist/output.css" rel="stylesheet">
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
                <a href="#" class="flex items-center px-6 py-3 text-gray-700 group-hover:bg-blue-50 group-hover:text-blue-600 transition duration-200">
                    <i class="fas fa-calendar-alt mr-3 text-gray-500 group-hover:text-blue-600 transition duration-200"></i>
                    <span class="font-medium">Citas</span>
                </a>
            </li>
            <li class="group mt-2">
                <a href="reportes.php" class="flex items-center px-6 py-3 text-gray-700 group-hover:bg-blue-50 group-hover:text-blue-600 transition duration-200">
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
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold text-gray-800">Administrar Citas</h2>
                <a href="agregar_cita.php" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-200">Agregar Cita</a>
            </div>

            <div class="mb-4">
            <form method="GET" action="citas.php">
                <div class="flex">
                <input type="text" name="cita_id" placeholder="Buscar por CitaID" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500" value="<?= htmlspecialchars($citaIdBusqueda) ?>">
                <button type="submit"  class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-200 ml-2">Buscar</button>
                </div>
            </form>
            </div>

            <?php if (!empty($mensaje)): ?>
                <div class="mb-4 flex items-center justify-between px-4 py-2 border rounded-lg 
                    <?= strpos($mensaje, 'correctamente') !== false ? 'bg-green-100 border-green-200 text-green-800' : 'bg-red-100 border-red-200 text-red-800' ?>">
                    <span>
                        <i class="<?= strpos($mensaje, 'correctamente') !== false ? 'fas fa-check-circle' : 'fas fa-exclamation-triangle' ?> mr-2"></i>
                        <?= htmlspecialchars($mensaje) ?>
                    </span>
                    <button onclick="this.parentElement.style.display='none';" class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            <?php endif; ?>

            <!-- Tabla de Citas -->
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <tr>
                            <th class="py-3 px-6 text-left">ID Cita</th>
                            <th class="py-3 px-6 text-left">Usuario</th>
                            <th class="py-3 px-6 text-left">Correo Usuario</th>
                            <th class="py-3 px-6 text-left">Mesa</th>
                            <th class="py-3 px-6 text-left">Fecha y Hora Inicio</th>
                            <th class="py-3 px-6 text-left">Fecha y Hora Fin</th>
                            <th class="py-3 px-6 text-left">Estado</th>
                            <th class="py-3 px-6 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        <?php if (count($citas) > 0): ?>
                            <?php foreach ($citas as $cita): ?>
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left"><?= $cita['CitaID'] ?></td>
                                <td class="py-3 px-6 text-left"><?= $cita['NombreUsuario'] ?></td>
                                <td class="py-3 px-6 text-left"><?= $cita['CorreoElectronico'] ?></td>
                                <td class="py-3 px-6 text-left"><?= $cita['NombreMesa'] ?></td>
                                <td class="py-3 px-6 text-left"><?= $cita['FechaHoraInicio'] ?></td>
                                <td class="py-3 px-6 text-left"><?= $cita['FechaHoraFin'] ?></td>
                                <td class="py-3 px-6 text-left">
                                    <span class="inline-block px-2 py-1 rounded 
                                        <?= $cita['Estado'] == 'Confirmada' ? 'bg-green-200 text-green-700' : '' ?>
                                        <?= $cita['Estado'] == 'Pendiente' ? 'bg-yellow-200 text-yellow-700' : '' ?>
                                        <?= $cita['Estado'] == 'Cancelada' ? 'bg-red-200 text-red-700' : '' ?>">
                                        <?= $cita['Estado'] ?>
                                    </span>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <a href="editar_cita.php?id=<?= $cita['CitaID'] ?>" class="text-blue-500 hover:text-blue-600 mr-2">Editar</a>
                                    <a href="eliminar_cita.php?id=<?= $cita['CitaID'] ?>" class="text-red-500 hover:text-red-600" onclick="return confirm('¿Realmente quieres eliminar esta cita?');">Eliminar</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="py-3 px-6 text-center text-red-500">No se encontraron citas.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
    
</body>
</html>
