<?php
include_once '../../Model/conection.php';
include_once '../../Model/auth.php';

$con = new conectar();
$conexion = $con->conectarse();

// Consulta para obtener los usuarios
$query_usuarios = $conexion->prepare("SELECT * FROM usuarios");
$query_usuarios->execute();
$usuarios = $query_usuarios->fetchAll(PDO::FETCH_ASSOC);

$search = isset($_GET['search']) ? $_GET['search'] : '';

// Consulta para obtener los usuarios según la búsqueda
$query_usuarios = $conexion->prepare("SELECT * FROM usuarios WHERE CorreoElectronico LIKE :search");
$query_usuarios->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
$query_usuarios->execute();
$usuarios = $query_usuarios->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Usuarios</title>
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
                <a href="#" class="flex items-center px-6 py-3 text-gray-700 group-hover:bg-blue-50 group-hover:text-blue-600 transition duration-200">
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
                <h2 class="text-2xl font-semibold text-gray-800">Administrar Usuarios</h2>
                <a href="agregar_usuario.php" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-200">Agregar Usuario</a>
            </div>

            <div class="mb-4">
                <form method="GET" action="usuarios.php">
                    <div class="flex">
                        <input type="text" name="search" placeholder="Buscar por correo electrónico" value="<?= htmlspecialchars($search) ?>" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-200 ml-2">Buscar</button>
                    </div>
                </form>
            </div>

            <?php if (isset($_GET['mensaje'])): ?>
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                <p><?= htmlspecialchars($_GET['mensaje']) ?></p>
            </div>
            <?php endif; ?>

            <!-- Modal de confirmación -->
<div id="modalEliminar" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden">
    <div class="bg-white rounded-lg shadow-lg p-6 w-80">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Eliminar Usuario</h2>
        <p class="text-gray-600 mb-6">¿Estás seguro de que quieres eliminar este usuario?</p>
        <div class="flex justify-end">
            <button id="cancelarEliminar" class="bg-gray-300 text-gray-800 px-4 py-2 rounded-lg mr-2 hover:bg-gray-400">Cancelar</button>
            <a id="confirmarEliminar" href="#" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">Eliminar</a>
        </div>
    </div>
</div>


            <!-- Tabla de Usuarios -->
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <tr>
                            <th class="py-3 px-6 text-left">ID</th>
                            <th class="py-3 px-6 text-left">Nombre</th>
                            <th class="py-3 px-6 text-left">Correo Electrónico</th>
                            <th class="py-3 px-6 text-left">Fecha de Registro</th>
                            <th class="py-3 px-6 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
    <?php foreach ($usuarios as $usuario): ?>
    <tr class="border-b border-gray-200 hover:bg-gray-100">
        <td class="py-3 px-6 text-left"><?= $usuario['UserID'] ?></td>
        <td class="py-3 px-6 text-left"><?= $usuario['Nombre'] ?></td>
        <td class="py-3 px-6 text-left"><?= $usuario['CorreoElectronico'] ?></td>
        <td class="py-3 px-6 text-left"><?= $usuario['created_at'] ?></td>
        <td class="py-3 px-6 text-center">
            <a href="../../Controller/editar_usuario.php?id=<?= $usuario['UserID'] ?>" class="text-blue-500 hover:text-blue-600 mr-2">Editar</a>
            <!-- Enlace de eliminación con confirmación -->
            <a href="#" 
   class="text-red-500 hover:text-red-600" 
   onclick="mostrarModalEliminar('../../Controller/eliminar_usuario.php?id=<?= $usuario['UserID'] ?>');">
   Eliminar
</a>
        </td>
    </tr>
    <?php endforeach; ?>
</tbody>
                </table>
            </div>
        </main>
    </div>
    <script>
    function mostrarModalEliminar(url) {
        // Mostrar el modal
        const modal = document.getElementById('modalEliminar');
        modal.classList.remove('hidden');

        // Establecer la URL de confirmación en el botón de eliminar
        const confirmarEliminar = document.getElementById('confirmarEliminar');
        confirmarEliminar.href = url;

        // Manejar el cierre del modal al hacer clic en cancelar
        const cancelarEliminar = document.getElementById('cancelarEliminar');
        cancelarEliminar.onclick = function() {
            modal.classList.add('hidden');
        };
    }
</script>

</body>
</html>
