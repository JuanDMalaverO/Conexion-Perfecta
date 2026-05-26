<?php
session_start();
$agendaUrl = isset($_SESSION['user_name']) ? 'agendar.php' : 'login.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Agregar Titulo"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/nosotros.css">
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
                <a class="in in3" href="<?php echo $agendaUrl; ?>">Agenda tu cita</a>
            </div>
            <div class="social">
              <a href="https://www.instagram.com/juan.no.15/" target="_blank" class="hover:underline me-4 md:me-6"><i class="fa-brands fa-instagram"></i></a>
              <a href="http://www.youtube.com/@Juan_Malaver" target="_blank" class="hover:underline me-4 md:me-6"><i class="fa-brands fa-youtube"></i></a>
              <a href="https://twitter.com/JUANDAVIDMALA12" target="_blank" class="hover:underline me-4 md:me-6"><i class="fa-brands fa-x-twitter"></i></a>
              <?php if (isset($_SESSION['user_name'])): ?>
                    <a href="account.php" class="boton-mi-cuenta"><i class="fa-solid fa-user"></i>Mi cuenta</a>
                <?php endif; ?>
            </div>
        </nav>
    </header>


    <section class="container-fluid py-5 bg-light text-dark">
        <div class="container text-center">
            <h2 class="display-4 fw-bold">Sobre Nosotros</h2>
            <p class="lead">Conoce quiénes somos y cómo podemos ayudarte a disfrutar del billar al máximo.</p>
        </div>
    </section>
    
    <section class="container-fluid py-5 text-white" style="background: url('https://images.unsplash.com/photo-1579124585557-04bcbfdeeb32?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80') center center / cover no-repeat;">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="bg-dark bg-opacity-75 p-4 rounded">
                        <h2 class="fw-bold">¿Qué es Conexión Perfecta?</h2>
                        <p>"Conexión Perfecta" es la solución definitiva para los amantes del billar. Nuestra plataforma conecta jugadores y facilita la organización de partidas en mesas locales, todo en un ambiente fácil y eficiente.</p>
                        <h4 class="mt-4">Nuestra Visión</h4>
                        <p>Crear una comunidad vibrante de jugadores de billar que puedan conectarse, competir y disfrutar de un ambiente amigable y accesible.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="bg-dark bg-opacity-75 p-4 rounded">
                        <h4 class="fw-bold">Beneficios</h4>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check text-success"></i> Facilidad de uso</li>
                            <li><i class="fas fa-check text-success"></i> Conexiones relevantes</li>
                            <li><i class="fas fa-check text-success"></i> Gestión eficiente</li>
                            <li><i class="fas fa-check text-success"></i> Exploración de mesas</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="container-fluid py-5 bg-light text-dark">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-md-6 order-md-2">
                    <img src="../assets/registro.png" class="img-fluid rounded shadow-lg" alt="Registro">
                </div>
                <div class="col-md-6 order-md-1">
                    <div class="p-4">
                        <h2 class="fw-bold">¿Qué incluye mi registro?</h2>
                        <p>Al registrarte en "Conexión Perfecta", obtienes acceso a herramientas y recursos que mejoran tu experiencia como jugador de billar.</p>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-user-plus text-primary"></i> Agendar y gestionar partidas</li>
                            <li><i class="fas fa-users text-primary"></i> Conectarte con otros jugadores</li>
                            <li><i class="fas fa-map-marker-alt text-primary"></i> Información sobre las mejores mesas</li>
                            <li><i class="fas fa-calendar-alt text-primary"></i> Gestión de horarios y recordatorios</li>
                            <li><i class="fas fa-trophy text-primary"></i> Acceso a eventos y torneos exclusivos</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="container-fluid py-5 text-white" style="background: url('https://images.unsplash.com/photo-1512427691650-1e4e0bbf6dd4?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80') center center / cover no-repeat;">
        <div class="container py-5">
            <div class="bg-dark bg-opacity-75 p-4 rounded">
                <div class="text-center mb-4">
                    <h2 class="fw-bold">Primeros Pasos</h2>
                    <p class="lead">Sigue estos sencillos pasos para comenzar a disfrutar del billar con nuestra plataforma.</p>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="bg-secondary bg-opacity-50 p-4 rounded mb-4">
                            <h4><i class="fas fa-user-check text-warning"></i> Registro</h4>
                            <p>Crea tu cuenta en nuestra plataforma en pocos minutos.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="bg-secondary bg-opacity-50 p-4 rounded mb-4">
                            <h4><i class="fas fa-user-edit text-warning"></i> Completa tu Perfil</h4>
                            <p>Añade información relevante para que otros jugadores te conozcan mejor.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="bg-secondary bg-opacity-50 p-4 rounded mb-4">
                            <h4><i class="fas fa-search text-warning"></i> Explorar Partidas</h4>
                            <p>Navega por las partidas disponibles o crea la tuya propia.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="bg-secondary bg-opacity-50 p-4 rounded mb-4">
                            <h4><i class="fas fa-exchange-alt text-warning"></i> Conexión</h4>
                            <p>Envía y recibe solicitudes para organizar tus partidas.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="bg-secondary bg-opacity-50 p-4 rounded mb-4">
                            <h4><i class="fas fa-bell text-warning"></i> Confirmación</h4>
                            <p>Recibe notificaciones y recordatorios para no perderte ninguna partida.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    
    

</body>
</html>