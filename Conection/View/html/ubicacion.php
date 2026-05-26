<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubicación - Conexión Perfecta</title>
    <link rel="stylesheet" href="../css/ubi.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
    <h2 class="section-title">Ubicación</h2>
        <div class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d497.0532287737677!2d-74.0912315545792!3d4.695840040624972!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e3f9b3a8e00f3e1%3A0xba6bf028081c2b51!2sbillares%20mixtos%20el%20rey!5e0!3m2!1ses-419!2sco!4v1723386500794!5m2!1ses-419!2sco" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

        <div class="info2">
            <h2>Encuéntranos en</h2>
            <p><i class="fa fa-map-marker-alt"></i>Avenida Calle 68 #95-50, Bogotá, Colombia</p>
            <p><i class="fa fa-phone"></i>+57 123 456 7890</p>
            <p><i class="fa fa-envelope"></i>info@conexionperfecta.com</p>
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
