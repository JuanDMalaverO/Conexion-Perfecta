<?php
include_once '../../Model/conection.php';
include_once '../../Model/auth.php';

$con = new conectar();
$conexion = $con->conectarse();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];
    $telefono = $_POST['telefono'];
    $edad = $_POST['edad'];

    // Cifrar la contraseña con MD5
    $contrasena_cifrada = md5($contrasena);

    // Asignar el rol de "Usuario" que tiene Rol_id = 2
    $rol_id = 2;

    if (!empty($nombre) && !empty($correo) && !empty($contrasena) && !empty($telefono) && !empty($edad)) {
        $query_agregar = $conexion->prepare("INSERT INTO usuarios (Nombre, CorreoElectronico, Usu_clave, Telefono, Edad, id_rol_fk, created_at) VALUES (:nombre, :correo, :contrasena, :telefono, :edad, :rol, NOW())");
        $query_agregar->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $query_agregar->bindParam(':correo', $correo, PDO::PARAM_STR);
        $query_agregar->bindParam(':contrasena', $contrasena_cifrada, PDO::PARAM_STR);
        $query_agregar->bindParam(':telefono', $telefono, PDO::PARAM_STR);
        $query_agregar->bindParam(':edad', $edad, PDO::PARAM_INT);
        $query_agregar->bindParam(':rol', $rol_id, PDO::PARAM_INT);

        if ($query_agregar->execute()) {
            header("Location: usuarios.php?mensaje=Usuario agregado correctamente");
            exit();
        } else {
            $mensaje = "Error al agregar el usuario";
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
    <title>Agregar Usuario</title>
    <link href="../../dist/output.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-900 font-sans">
    <div class="flex min-h-screen">
        <main class="flex-1 p-10 bg-white shadow-lg rounded-lg">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Agregar Usuario</h2>

            <!-- Formulario para agregar un nuevo usuario -->
            <form method="POST">
                <div class="mb-4">
                    <label class="block text-gray-700">Nombre</label>
                    <input type="text" name="nombre" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Correo Electrónico</label>
                    <input type="email" name="correo" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Contraseña</label>
                    <input type="password" name="contrasena" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Teléfono</label>
                    <input type="text" name="telefono" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Edad</label>
                    <input type="number" name="edad" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500" required>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-200">Agregar Usuario</button>
                </div>
            </form>

            <?php if (isset($mensaje)): ?>
                <div class="mt-4 text-red-500"><?= htmlspecialchars($mensaje) ?></div>
            <?php endif; ?>
        </main>
    </div>
</body>
</html>
