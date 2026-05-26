<?php
session_start();
include '../Model/conection.php';

function agendar_cita($userId, $tipoMesa, $fecha, $horaInicio, $horas, $cantidadJugadores) {
    $conexion = new conectar();
    $conn = $conexion->conectarse();

    // Definir los códigos de mesas según el tipo
    $mesas = [
        '3 bandas' => [11, 12, 13],
        'libres' => [21, 22, 23, 24],
        'pool' => [31]
    ];

    // Obtener las mesas correspondientes al tipo de mesa seleccionado
    $mesasTipo = $mesas[$tipoMesa];

    try {
        // Convertir fecha y hora en DateTime
        $fechaHoraInicio = new DateTime("$fecha $horaInicio");
        $fechaHoraFin = clone $fechaHoraInicio;
        $fechaHoraFin->modify("+$horas hours");

        foreach ($mesasTipo as $mesaId) {
            // Verificar si la mesa está disponible en el rango de tiempo solicitado
            $sql = "SELECT * FROM citas 
                    WHERE MesaID = ? 
                    AND Estado != 'Cancelada'
                    AND (
                        (FechaHoraInicio < ? AND FechaHoraFin > ?) 
                        OR 
                        (FechaHoraInicio < ? AND FechaHoraFin > ?) 
                        OR 
                        (FechaHoraInicio >= ? AND FechaHoraFin <= ?)
                    )";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $mesaId);
            $stmt->bindParam(2, $fechaHoraFin->format('Y-m-d H:i:s'));
            $stmt->bindParam(3, $fechaHoraInicio->format('Y-m-d H:i:s'));
            $stmt->bindParam(4, $fechaHoraFin->format('Y-m-d H:i:s'));
            $stmt->bindParam(5, $fechaHoraInicio->format('Y-m-d H:i:s'));
            $stmt->bindParam(6, $fechaHoraInicio->format('Y-m-d H:i:s'));
            $stmt->bindParam(7, $fechaHoraFin->format('Y-m-d H:i:s'));
            $stmt->execute();

            if ($stmt->rowCount() == 0) {
                // Insertar la cita en la base de datos
                $sqlInsert = "INSERT INTO citas (UserID, MesaID, FechaHoraInicio, FechaHoraFin, Estado, CantidadJugadores)
                              VALUES (?, ?, ?, ?, 'Pendiente', ?)";

                $stmtInsert = $conn->prepare($sqlInsert);
                $stmtInsert->bindParam(1, $userId);
                $stmtInsert->bindParam(2, $mesaId);
                $stmtInsert->bindParam(3, $fechaHoraInicio->format('Y-m-d H:i:s'));
                $stmtInsert->bindParam(4, $fechaHoraFin->format('Y-m-d H:i:s'));
                $stmtInsert->bindParam(5, $cantidadJugadores);

                if ($stmtInsert->execute()) {
                    // Devolver el ID de la última cita insertada
                    return $conn->lastInsertId();
                } else {
                    return "Error al agendar la cita: " . $conn;
                }
            }
        }
        return "No hay mesas disponibles en el rango de tiempo solicitado.";
    } catch (PDOException $e) {
        return "Error: " . $e->getMessage();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];
        $tipoMesa = $_POST['tipoMesa'];
        $fecha = $_POST['fecha'];
        $horaInicio = $_POST['fechaHoraInicio'];
        $horas = $_POST['horas'];
        $cantidadJugadores = $_POST['cantidadJugadores'];

        $result = agendar_cita($userId, $tipoMesa, $fecha, $horaInicio, $horas, $cantidadJugadores);

        if (is_numeric($result)) {
            header("Location: ../View/html/pagar.php?cita_id=$result");
            exit();
        } else {
            $_SESSION['error_message'] = $result;
            header("Location: ../View/html/agendar.php");
            exit();
        }
    } else {
        $_SESSION['error_message'] = "Debes iniciar sesión para agendar una cita.";
        header("Location: ../View/html/login.php");
        exit();
    }
} else {
    header("Location: ../View/html/agendar.php");
    exit();
}