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
    <link rel="stylesheet" href="../css/servicios.css">
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
                <a class="in in2" href="nosotros.php">Nosotros</a>
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
    <section id="servicios" class="services-section">
    <div class="container">
        <h2 class="section-title">Nuestros Servicios</h2>
        <div class="services-grid">
            <!-- Servicio 1: Reservas de Mesas de Billar -->
            <div class="service-card">
                <div class="service-icon">
                    <i class="fa-solid fa-calendar-check"></i>
                </div>
                <h3 class="service-title">Reservas de Mesas de Billar</h3>
                <p class="service-description">
                    Reserva mesas de billar de manera fácil y rápida en tu club favorito. Elige entre diferentes tipos de mesas y horarios que se adapten a tus necesidades.
                </p>
            </div>
            <!-- Servicio 2: Gestión de Citas -->
            <div class="service-card">
                <div class="service-icon">
                    <i class="fa-solid fa-cogs"></i>
                </div>
                <h3 class="service-title">Gestión de Citas</h3>
                <p class="service-description">
                    Administra tus reservas de manera eficiente. Modifica, cancela o reprograma tus citas de billar desde cualquier dispositivo.
                </p>
            </div>
            <!-- Servicio 3: Pago en Línea Seguro -->
            <div class="service-card">
                <div class="service-icon">
                    <i class="fa-solid fa-credit-card"></i>
                </div>
                <h3 class="service-title">Pago en Línea Seguro</h3>
                <p class="service-description">
                    Realiza pagos de manera segura y sencilla a través de nuestra plataforma. Confirmación instantánea y recibos electrónicos disponibles.
                </p>
            </div>
            <!-- Servicio 4: Promociones y Ofertas Exclusivas -->
            <div class="service-card">
                <div class="service-icon">
                    <i class="fa-solid fa-tags"></i>
                </div>
                <h3 class="service-title">Promociones y Ofertas Exclusivas</h3>
                <p class="service-description">
                    Accede a promociones exclusivas y descuentos especiales al usar nuestra plataforma. Mantente al tanto de las últimas ofertas para disfrutar más tiempo jugando.
                </p>
            </div>
            <!-- Servicio 5: Historial de Citas y Estadísticas -->
            <div class="service-card">
                <div class="service-icon">
                    <i class="fa-solid fa-chart-line"></i>
                </div>
                <h3 class="service-title">Historial de Citas y Estadísticas</h3>
                <p class="service-description">
                    Consulta tu historial de reservas y obtén estadísticas sobre tu uso de la plataforma. Lleva un control de tus citas y mejora tu experiencia.
                </p>
            </div>
            <!-- Servicio 6: Soporte al Cliente Personalizado -->
            <div class="service-card">
                <div class="service-icon">
                    <i class="fa-solid fa-headset"></i>
                </div>
                <h3 class="service-title">Soporte al Cliente Personalizado</h3>
                <p class="service-description">
                    ¿Necesitas ayuda? Nuestro equipo de soporte está disponible para asistirte en cualquier momento. Contacta con nosotros por chat, correo electrónico o teléfono.
                </p>
            </div>

            <div class="service-card">
                <div class="service-icon">
                    <i class="fa-solid fa-star"></i>
                </div>
                <h3 class="service-title">Membresías VIP</h3>
                <p class="service-description">
                    Disfruta de beneficios exclusivos y acceso prioritario a eventos especiales.
                </p>
            </div>
            
            <div class="service-card">
                <div class="service-icon">
                    <i class="fa-solid fa-trophy"></i>
                </div>
                <h3 class="service-title">Torneos y Competencias</h3>
                <p class="service-description">
                    Participa en torneos y competencias organizados por nuestra plataforma.
                </p>
            </div>
        </div>
    </div>
</section>

<footer class="text-center text-lg-start fondito textito --bs-gray-900">
  <!-- Section: Social media -->
  <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
    <!-- Left -->
    <div class="me-5 d-none d-lg-block">
      <span>Mantente informado de las ultimas novedades con nuestras redes sociales:</span>
    </div>
    <!-- Left -->

    <!-- Right -->
    <div>
      <a href="https://www.instagram.com/juan.no.15/" class="me-4 text-reset">
        <i class="fa-brands fa-instagram"></i>
      </a>
      <a href="http://www.youtube.com/@Juan_Malaver" class="me-4 text-reset">
        <i class="fa-brands fa-youtube"></i>
      </a>
      <a href="https://twitter.com/JUANDAVIDMALA12" class="me-4 text-reset">
        <i class="fa-brands fa-x-twitter"></i>
      </a>
    </div>
    <!-- Right -->
  </section>
  <!-- Section: Social media -->

  <!-- Section: Links  -->
  <section class="">
    <div class="container text-center text-md-start mt-5">
      <!-- Grid row -->
      <div class="row mt-3">
        <!-- Grid column -->
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
          <!-- Content -->
          <h6 class="text-uppercase fw-bold mb-4">
            <i class="fas fa-gem me-3"></i>Conexión Perfecta
          </h6>
          <p>
          Domina el arte del billar: reserva tu mesa y perfecciona tu técnica en un ambiente exclusivo.
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">
            Servicio al cliente
          </h6>
          <p>
            <a href="account.php" class="text-reset">Mi cuenta</a>
          </p>
          <p>
            <a href="faq.php" class="text-reset">Atención al cliente</a>
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">
            Compañia
          </h6>
          <p>
            <a href="nosotros.php" class="text-reset">Sobre nosotros</a>
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">Contacto</h6>
          <p><i class="fas fa-home me-3"></i> Av. El Dorado #103, Bogotá </p>
          <p>
            <i class="fas fa-envelope me-3"></i>
            ConexiónPerfecta@gmail.com
          </p>
          <p><i class="fas fa-phone me-3"></i> +57 302 404 7788 </p>
        </div>
        <!-- Grid column -->
      </div>
      <!-- Grid row -->
    </div>
  </section>
  <!-- Section: Links  -->

  <!-- Copyright -->
  <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
    © 2024 Copyright
    <p class="text-reset fw-bold">Conexión Perfecta</p>
  </div>
  <!-- Copyright -->
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>