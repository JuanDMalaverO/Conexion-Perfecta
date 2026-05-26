<?php
include_once '../Model/conection.php';
include_once '../Model/auth.php';

$con = new conectar();
$conexion = $con->conectarse();

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Obtener los datos actuales del usuario
    $query_usuario = $conexion->prepare("SELECT * FROM usuarios WHERE UserID = :id");
    $query_usuario->bindParam(':id', $userId, PDO::PARAM_INT);
    $query_usuario->execute();
    $usuario = $query_usuario->fetch(PDO::FETCH_ASSOC);

    if (!$usuario) {
        header("Location: ../View/php/usuarios.php?mensaje=Usuario no encontrado");
        exit();
    }

    // Actualizar los datos del usuario si se envió el formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $telefono = $_POST['telefono'];
        $edad = $_POST['edad'];

        $query_actualizar = $conexion->prepare("UPDATE usuarios SET Nombre = :nombre, CorreoElectronico = :correo, Telefono = :telefono, Edad = :edad WHERE UserID = :id");
        $query_actualizar->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $query_actualizar->bindParam(':correo', $correo, PDO::PARAM_STR);
        $query_actualizar->bindParam(':telefono', $telefono, PDO::PARAM_STR);
        $query_actualizar->bindParam(':edad', $edad, PDO::PARAM_INT);
        $query_actualizar->bindParam(':id', $userId, PDO::PARAM_INT);

        if ($query_actualizar->execute()) {
            header("Location: ../View/php/usuarios.php?mensaje=Usuario actualizado correctamente");
            exit();
        } else {
            $mensaje = "Error al actualizar el usuario";
        }
    }
} else {
    header("Location: ../View/php/usuarios.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link href="../dist/output.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-900 font-sans">
    <div class="flex min-h-screen">
        <main class="flex-1 p-10 bg-white shadow-lg rounded-lg">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Editar Usuario</h2>

            <!-- Formulario de edición de usuario -->
            <form method="POST">
                <div class="mb-4">
                    <label class="block text-gray-700">Nombre</label>
                    <input type="text" name="nombre" value="<?= htmlspecialchars($usuario['Nombre']) ?>" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Correo Electrónico</label>
                    <input type="email" name="correo" value="<?= htmlspecialchars($usuario['CorreoElectronico']) ?>" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Teléfono</label>
                    <input type="text" name="telefono" value="<?= htmlspecialchars($usuario['Telefono']) ?>" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Edad</label>
                    <input type="number" name="edad" value="<?= htmlspecialchars($usuario['Edad']) ?>" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500">
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-200">Actualizar Usuario</button>
                </div>
            </form>

            <?php if (isset($mensaje)): ?>
                <div class="mt-4 text-red-500"><?= htmlspecialchars($mensaje) ?></div>
            <?php endif; ?>
        </main>
    </div>
</body>
</html>
