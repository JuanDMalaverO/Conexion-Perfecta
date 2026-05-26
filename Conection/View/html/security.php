<?php
session_start();
if (!isset($_SESSION['user_email'])) {
    header("Location: ../../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seguridad de la cuenta</title>
</head>
<body>
    <div class="container">
        <h2>Seguridad de la cuenta</h2>
        <?php if (isset($_SESSION['error_message'])): ?>
            <div class="error-message"><?php echo htmlspecialchars($_SESSION['error_message']); unset($_SESSION['error_message']); ?></div>
        <?php endif; ?>
        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="success-message"><?php echo htmlspecialchars($_SESSION['success_message']); unset($_SESSION['success_message']); ?></div>
        <?php endif; ?>
        <form action="../../Controller/process_security.php" method="POST">
            <label for="current_password">Contraseña actual:</label>
            <input type="password" id="current_password" name="current_password" required>
            <br>
            <label for="new_password">Nueva contraseña:</label>
            <input type="password" id="new_password" name="new_password" required>
            <br>
            <label for="confirm_password">Confirmar nueva contraseña:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
            <br>
            <button type="submit">Cambiar contraseña</button>
        </form>
    </div>
</body>
</html>
