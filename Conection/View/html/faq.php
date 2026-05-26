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
    <link rel="stylesheet" href="../css/faq.css">
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
    <main class="container my-5">
        <h2 class="display-4 text-center mb-4 section-title">Preguntas Frecuentes</h2>
        <div class="accordion" id="faqAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        ¿Qué es Conexión Perfecta?
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Conexión Perfecta es una plataforma en línea diseñada para los amantes del billar. Permite a los usuarios agendar citas en las mejores salas de billar, mantenerse informados sobre los torneos más importantes y disfrutar de noticias y artículos sobre el mundo del billar.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        ¿Cómo puedo agendar una cita?
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Para agendar una cita, primero debes crear una cuenta en nuestra plataforma. Una vez registrado, puedes iniciar sesión y dirigirte a la sección de "Agenda tu cita". Selecciona la fecha, hora y tipo de mesa que prefieras, y sigue los pasos para confirmar tu cita.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        ¿Cómo puedo cancelar una cita?
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Puedes cancelar una cita desde tu perfil de usuario. En la sección de "Citas Recientes", selecciona la cita que deseas cancelar y haz clic en el botón "Cancelar". Recuerda que las cancelaciones deben hacerse al menos 24 horas antes de la cita programada.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        ¿Qué métodos de pago aceptan?
                    </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Aceptamos la mayoría de las tarjetas de crédito y débito, así como pagos a través de plataformas como PayPal. También puedes realizar pagos directamente en la sala de billar, dependiendo de las políticas de cada establecimiento.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFive">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                        ¿Puedo recibir noticias y actualizaciones sobre eventos de billar?
                    </button>
                </h2>
                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        ¡Claro que sí! Puedes suscribirte a nuestro boletín de noticias desde tu perfil de usuario. De esta manera, recibirás las últimas noticias y actualizaciones sobre eventos y torneos de billar directamente en tu correo electrónico.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingSix">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                        ¿Cómo contacto con el soporte de Conexión Perfecta?
                    </button>
                </h2>
                <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Si necesitas asistencia o tienes alguna pregunta, puedes contactarnos a través de la sección "Contacto" en nuestra página web. También puedes enviarnos un correo electrónico a soporte@conexionperfecta.com.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
    <h2 class="accordion-header" id="headingSeven">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
            ¿Puedo cambiar la mesa reservada después de haber agendado una cita?
        </button>
    </h2>
    <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#faqAccordion">
        <div class="accordion-body">
            Una vez que hayas agendado una cita, no podrás cambiar la mesa seleccionada. Sin embargo, puedes cancelar la cita y agendar una nueva con la mesa de tu preferencia, siempre y cuando lo hagas con al menos 24 horas de anticipación.
        </div>
    </div>
</div>

<div class="accordion-item">
    <h2 class="accordion-header" id="headingEight">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
            ¿Qué sucede si llego tarde a mi cita?
        </button>
    </h2>
    <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight" data-bs-parent="#faqAccordion">
        <div class="accordion-body">
            Si llegas tarde a tu cita, tu tiempo de juego será reducido en función del tiempo de retraso. No se reembolsarán los minutos perdidos. Te recomendamos llegar a tiempo para disfrutar al máximo de tu experiencia.
        </div>
    </div>
</div>

<div class="accordion-item">
    <h2 class="accordion-header" id="headingNine">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
            ¿Ofrecen algún tipo de descuento o promoción?
        </button>
    </h2>
    <div id="collapseNine" class="accordion-collapse collapse" aria-labelledby="headingNine" data-bs-parent="#faqAccordion">
        <div class="accordion-body">
            Sí, ocasionalmente ofrecemos descuentos y promociones especiales. Te recomendamos suscribirte a nuestro boletín para estar al tanto de las últimas ofertas. También puedes visitar nuestra página de promociones en el sitio web.
        </div>
    </div>
</div>

<div class="accordion-item">
    <h2 class="accordion-header" id="headingTen">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
            ¿Es necesario registrarse para utilizar Conexión Perfecta?
        </button>
    </h2>
    <div id="collapseTen" class="accordion-collapse collapse" aria-labelledby="headingTen" data-bs-parent="#faqAccordion">
        <div class="accordion-body">
            Sí, para poder agendar citas, recibir noticias y acceder a todas las funcionalidades de Conexión Perfecta, es necesario registrarse y crear una cuenta. El proceso de registro es rápido y sencillo.
        </div>
    </div>
</div>

<div class="accordion-item">
    <h2 class="accordion-header" id="headingEleven">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven">
            ¿Cómo puedo recuperar mi contraseña si la olvidé?
        </button>
    </h2>
    <div id="collapseEleven" class="accordion-collapse collapse" aria-labelledby="headingEleven" data-bs-parent="#faqAccordion">
        <div class="accordion-body">
            Si olvidaste tu contraseña, puedes hacer clic en "Olvidé mi Contraseña" en la página de inicio de sesión. Te enviaremos un enlace a tu correo electrónico para que puedas restablecerla de manera segura.
        </div>
    </div>
</div>

<div class="accordion-item">
    <h2 class="accordion-header" id="headingTwelve">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwelve" aria-expanded="false" aria-controls="collapseTwelve">
            ¿Cómo puedo dar mi opinión o sugerencias sobre la plataforma?
        </button>
    </h2>
    <div id="collapseTwelve" class="accordion-collapse collapse" aria-labelledby="headingTwelve" data-bs-parent="#faqAccordion">
        <div class="accordion-body">
            Nos encantaría escuchar tus opiniones y sugerencias. Puedes enviarnos tus comentarios a través de la sección "Contacto" en nuestra página web. Valoramos todas las sugerencias y trabajamos constantemente para mejorar la experiencia de nuestros usuarios.
        </div>
    </div>
</div>

<div class="accordion-item">
    <h2 class="accordion-header" id="headingThirteen">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThirteen" aria-expanded="false" aria-controls="collapseThirteen">
            ¿Dónde puedo ver mis citas agendadas?
        </button>
    </h2>
    <div id="collapseThirteen" class="accordion-collapse collapse" aria-labelledby="headingThirteen" data-bs-parent="#faqAccordion">
        <div class="accordion-body">
            Puedes ver todas tus citas agendadas en la sección "Citas Recientes" de tu perfil de usuario. Allí encontrarás información detallada sobre cada cita, incluyendo la fecha, hora, mesa reservada y estado de la reserva.
        </div>
    </div>
</div>

        </div>
    </main>

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
            <a href="#!" class="text-reset">Atención al cliente</a>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>