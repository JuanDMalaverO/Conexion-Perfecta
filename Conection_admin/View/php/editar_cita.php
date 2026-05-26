<?php
include_once '../../Model/conection.php';
include_once '../../Model/auth.php';

$con = new conectar();
$conexion = $con->conectarse();

if (isset($_GET['id'])) {
    $citaId = $_GET['id'];

    // Obtener los datos actuales de la cita
    $query_cita = $conexion->prepare("
        SELECT c.CitaID, c.FechaHoraInicio, c.FechaHoraFin, c.Estado, u.UserID, u.Nombre as NombreUsuario, m.MesaID, m.TipoMesa as NombreMesa 
        FROM citas c
        JOIN usuarios u ON c.UserID = u.UserID
        JOIN mesasbillar m ON c.MesaID = m.MesaID
        WHERE CitaID = :id
    ");
    $query_cita->bindParam(':id', $citaId, PDO::PARAM_INT);
    $query_cita->execute();
    $cita = $query_cita->fetch(PDO::FETCH_ASSOC);

    if (!$cita) {
        header("Location: citas.php?mensaje=Cita no encontrada");
        exit();
    }

    // Obtener la lista de mesas
    $query_mesas = $conexion->prepare("SELECT MesaID, TipoMesa as NombreMesa FROM mesasbillar");
    $query_mesas->execute();
    $mesas = $query_mesas->fetchAll(PDO::FETCH_ASSOC);

    // Actualizar los datos de la cita si se envió el formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $fechaHoraInicio = $_POST['fecha_hora_inicio'];
        $fechaHoraFin = $_POST['fecha_hora_fin'];
        $mesaId = $_POST['mesa'];
        $estado = $_POST['estado'];

        $query_actualizar = $conexion->prepare("
            UPDATE citas 
            SET FechaHoraInicio = :fecha_hora_inicio, FechaHoraFin = :fecha_hora_fin, MesaID = :mesa, Estado = :estado
            WHERE CitaID = :id
        ");
        $query_actualizar->bindParam(':fecha_hora_inicio', $fechaHoraInicio, PDO::PARAM_STR);
        $query_actualizar->bindParam(':fecha_hora_fin', $fechaHoraFin, PDO::PARAM_STR);
        $query_actualizar->bindParam(':mesa', $mesaId, PDO::PARAM_INT);
        $query_actualizar->bindParam(':estado', $estado, PDO::PARAM_STR);
        $query_actualizar->bindParam(':id', $citaId, PDO::PARAM_INT);

        if ($query_actualizar->execute()) {
            header("Location: citas.php?mensaje=Cita actualizada correctamente");
            exit();
        } else {
            $mensaje = "Error al actualizar la cita";
        }
    }
} else {
    header("Location: citas.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cita</title>
    <link href="../../dist/output.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-900 font-sans">
    <div class="flex min-h-screen">
        <main class="flex-1 p-10 bg-white shadow-lg rounded-lg">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Editar Cita</h2>

            <!-- Formulario de edición de cita -->
            <form method="POST">
                <div class="mb-4">
                    <label class="block text-gray-700">Fecha y Hora Inicio</label>
                    <input type="datetime-local" name="fecha_hora_inicio" value="<?= htmlspecialchars($cita['FechaHoraInicio']) ?>" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Fecha y Hora Fin</label>
                    <input type="datetime-local" name="fecha_hora_fin" value="<?= htmlspecialchars($cita['FechaHoraFin']) ?>" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Mesa</label>
                    <select name="mesa" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500">
                        <?php foreach ($mesas as $mesa): ?>
                            <option value="<?= $mesa['MesaID'] ?>" <?= $mesa['MesaID'] == $cita['MesaID'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($mesa['NombreMesa']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Estado</label>
                    <select name="estado" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500">
                        <option value="Confirmada" <?= $cita['Estado'] == 'Confirmada' ? 'selected' : '' ?>>Confirmada</option>
                        <option value="Pendiente" <?= $cita['Estado'] == 'Pendiente' ? 'selected' : '' ?>>Pendiente</option>
                        <option value="Cancelada" <?= $cita['Estado'] == 'Cancelada' ? 'selected' : '' ?>>Cancelada</option>
                    </select>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-200">Actualizar Cita</button>
                </div>
            </form>

            <?php if (isset($mensaje)): ?>
                <div class="mt-4 text-red-500"><?= htmlspecialchars($mensaje) ?></div>
            <?php endif; ?>
        </main>
    </div>
</body>
</html>
