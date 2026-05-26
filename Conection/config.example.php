<?php
// ============================================================
//  Copia este archivo como config.php y completa tus valores.
//  NUNCA subas config.php a control de versiones.
// ============================================================

// Base de datos
define('DB_HOST',    'localhost');
define('DB_PORT',    '3306');
define('DB_NAME',    'billar_exotico');
define('DB_USER',    'root');
define('DB_PASS',    '');
define('DB_CHARSET', 'utf8');

// Correo SMTP (Gmail)
// Genera una contraseña de aplicación en: https://myaccount.google.com/apppasswords
define('MAIL_HOST',      'smtp.gmail.com');
define('MAIL_PORT',      587);
define('MAIL_USER',      'tu-correo@gmail.com');
define('MAIL_PASS',      'xxxx xxxx xxxx xxxx');
define('MAIL_FROM_NAME', 'Conexión Perfecta');

// URL base de la aplicación (sin barra final)
define('APP_URL', 'http://localhost/Conection');
