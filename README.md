# Conexión Perfecta

Sistema web de reservas de mesas de billar para **El Rey de la 80**, desarrollado en PHP con arquitectura MVC. Permite a los usuarios agendar citas en línea y cuenta con un panel de administración para gestionar usuarios, citas y ver reportes.

---

## Características

### Plataforma de usuarios (`Conection/`)
- Registro e inicio de sesión con contraseñas cifradas (bcrypt)
- Reserva de mesas con verificación de disponibilidad en tiempo real
- Soporte para tres tipos de mesa: **3 Bandas**, **Libres** y **Pool**
- Gestión de cuenta personal (datos, contraseña, historial de citas)
- Recuperación de contraseña por correo electrónico (token de un solo uso)
- Podio de usuarios destacados de la semana en la página principal

### Panel de administración (`Conection_admin/`)
- Dashboard con métricas clave: total de usuarios, citas del día, citas activas
- Gráficos de usuarios registrados por día y citas por hora (Chart.js)
- CRUD completo de usuarios y citas
- Reportes mensuales de citas e ingresos estimados

---

## Tecnologías

| Capa | Tecnología |
|---|---|
| Backend | PHP 7.4+ con PDO |
| Base de datos | MySQL 5.7+ |
| Frontend (usuarios) | Bootstrap 5, CSS personalizado, Particles.js |
| Frontend (admin) | Tailwind CSS 3, Chart.js |
| Email | PHPMailer 6.9 (SMTP Gmail) |
| Dependencias PHP | Composer |
| Dependencias CSS admin | npm / Node.js |

---

## Requisitos previos

- PHP 7.4 o superior
- MySQL 5.7 o superior
- Composer
- Node.js + npm (solo para recompilar el CSS del admin)
- Servidor web compatible con PHP (Apache/Nginx, o XAMPP/Laragon)

---

## Instalación

### 1. Clonar el repositorio

```bash
git clone https://github.com/JuanDMalaverO/Conexion-Perfecta.git
cd Conexion-Perfecta
```

### 2. Crear la base de datos

Importa el archivo SQL incluido en cualquier cliente MySQL (phpMyAdmin, MySQL Workbench, CLI):

```bash
mysql -u root -p < billar_exotico.sql
```

### 3. Configurar la aplicación principal

```bash
cp Conection/config.example.php Conection/config.php
```

Edita `Conection/config.php` con tus datos reales:

```php
define('DB_HOST',    'localhost');
define('DB_NAME',    'billar_exotico');
define('DB_USER',    'root');
define('DB_PASS',    'tu_password');

define('MAIL_USER',  'tu-correo@gmail.com');
define('MAIL_PASS',  'xxxx xxxx xxxx xxxx'); // Contraseña de aplicación Gmail
define('APP_URL',    'http://localhost/Conection');
```

> **Contraseña de aplicación Gmail:** ve a [myaccount.google.com/apppasswords](https://myaccount.google.com/apppasswords) y genera una.

### 4. Configurar el panel de administración

```bash
cp Conection_admin/config.example.php Conection_admin/config.php
```

Edita `Conection_admin/config.php`:

```php
define('DB_HOST',        'localhost');
define('DB_NAME',        'billar_exotico');
define('DB_USER',        'root');
define('DB_PASS',        'tu_password');
define('ADMIN_PASSWORD', 'tu-password-seguro');
```

### 5. Instalar dependencias PHP

```bash
cd Conection
composer install
```

### 6. (Opcional) Recompilar el CSS del admin

Solo necesario si modificas los estilos del panel:

```bash
cd Conection_admin
npm install
npm run build
```

---

## Estructura del proyecto

```
Conexion-Perfecta/
├── billar_exotico.sql          # Script de creación de la base de datos
├── README.md
├── .gitignore
│
├── Conection/                  # Aplicación principal (usuarios)
│   ├── config.php              # Credenciales locales (gitignored)
│   ├── config.example.php      # Plantilla de configuración
│   ├── composer.json
│   ├── index.php               # Página de inicio
│   ├── Controller/             # Lógica de negocio
│   │   ├── login.php
│   │   ├── register.php
│   │   ├── agendar_cita.php
│   │   ├── update_account.php
│   │   ├── update_password.php
│   │   ├── send_reset_link.php
│   │   └── logout.php
│   ├── Model/
│   │   └── conection.php       # Clase de conexión PDO
│   └── View/
│       ├── html/               # Páginas PHP de la app
│       ├── css/                # Estilos
│       ├── js/                 # Scripts
│       └── assets/             # Imágenes y videos
│
└── Conection_admin/            # Panel de administración
    ├── config.php              # Credenciales locales (gitignored)
    ├── config.example.php      # Plantilla de configuración
    ├── package.json
    ├── index.php               # Dashboard principal + login admin
    ├── Controller/             # Lógica CRUD del admin
    ├── Model/
    │   ├── conection.php
    │   └── auth.php
    ├── dist/
    │   └── output.css          # Tailwind compilado
    └── View/php/               # Páginas del panel
```

---

## Mesas disponibles

| ID(s) | Tipo |
|---|---|
| 11, 12, 13 | 3 Bandas |
| 21, 22, 23, 24 | Libres |
| 31 | Pool |

---

## Seguridad

- Contraseñas de usuarios cifradas con `password_hash()` (bcrypt)
- Consultas SQL con PDO y sentencias preparadas (prevención de SQL injection)
- Tokens de restablecimiento de contraseña de un solo uso con expiración de 1 hora
- Credenciales sensibles fuera del código fuente (`config.php` gitignored)
- Comparación de contraseña de admin con `hash_equals()` (prevención de timing attacks)

---

## Autor

**Juan David Malaver**  
[GitHub](https://github.com/JuanDMalaverO) · [Instagram](https://www.instagram.com/juan._malaver/)

---

## Licencia

Este proyecto es de uso personal y educativo.
