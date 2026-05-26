<?php
include_once '../../Model/conection.php';
include_once '../../Model/auth.php';

$con = new conectar();
$conexion = $con->conectarse();

// Obtener la lista de usuarios y mesas
$query_usuarios = $conexion->prepare("SELECT UserID, Nombre FROM usuarios");
$query_usuarios->execute();
$usuarios = $query_usuarios->fetchAll(PDO::FETCH_ASSOC);

$query_mesas = $conexion->prepare("SELECT MesaID, TipoMesa as NombreMesa FROM mesasbillar");
$query_mesas->execute();
$mesas = $query_mesas->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuarioId = $_POST['usuario'];
    $mesaId = $_POST['mesa'];
    $fechaHoraInicio = $_POST['fecha_hora_inicio'];
    $fechaHoraFin = $_POST['fecha_hora_fin'];
    $estado = $_POST['estado'];

    if (!empty($usuarioId) && !empty($mesaId) && !empty($fechaHoraInicio) && !empty($fechaHoraFin)) {
        $query_agregar = $conexion->prepare("
            INSERT INTO citas (UserID, MesaID, FechaHoraInicio, FechaHoraFin, Estado) 
            VALUES (:usuario, :mesa, :fecha_hora_inicio, :fecha_hora_fin, :estado)
        ");
        $query_agregar->bindParam(':usuario', $usuarioId, PDO::PARAM_INT);
        $query_agregar->bindParam(':mesa', $mesaId, PDO::PARAM_INT);
        $query_agregar->bindParam(':fecha_hora_inicio', $fechaHoraInicio, PDO::PARAM_STR);
        $query_agregar->bindParam(':fecha_hora_fin', $fechaHoraFin, PDO::PARAM_STR);
        $query_agregar->bindParam(':estado', $estado, PDO::PARAM_STR);

        if ($query_agregar->execute()) {
            header("Location: citas.php?mensaje=Cita agregada correctamente");
            exit();
        } else {
            $mensaje = "Error al agregar la cita";
        }
    } else {
        $mensaje = "Por favor, complete todos los campos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Cita</title>
    <link href="../../dist/output.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-900 font-sans">
    <div class="flex min-h-screen">
        <main class="flex-1 p-10 bg-white shadow-lg rounded-lg">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Agregar Cita</h2>

            <!-- Formulario para agregar una nueva cita -->
            <form method="POST">
                <div class="mb-4">
                    <label class="block text-gray-700">Usuario</label>
                    <select name="usuario" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500" required>
                        <?php foreach ($usuarios as $usuario): ?>
                            <option value="<?= $usuario['UserID'] ?>"><?= htmlspecialchars($usuario['Nombre']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Mesa</label>
                    <select name="mesa" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500" required>
                        <?php foreach ($mesas as $mesa): ?>
                            <option value="<?= $mesa['MesaID'] ?>"><?= htmlspecialchars($mesa['NombreMesa']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Fecha y Hora Inicio</label>
                    <input type="datetime-local" name="fecha_hora_inicio" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Fecha y Hora Fin</label>
                    <input type="datetime-local" name="fecha_hora_fin" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Estado</label>
                    <select name="estado" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500">
                        <option value="Confirmada">Confirmada</option>
                        <option value="Pendiente">Pendiente</option>
                        <option value="Cancelada">Cancelada</option>
                    </select>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-200">Agregar Cita</button>
                </div>
            </form>

            <?php if (isset($mensaje)): ?>
                <div class="mt-4 text-red-500"><?= htmlspecialchars($mensaje) ?></div>
            <?php endif; ?>
        </main>
    </div>
</body>
</html>
