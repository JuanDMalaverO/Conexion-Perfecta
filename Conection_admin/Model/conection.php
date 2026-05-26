<?php
require_once __DIR__ . '/../config.php';

class conectar {
    public function conectarse() {
        $dsn = sprintf(
            'mysql:host=%s;dbname=%s;port=%s;charset=%s',
            DB_HOST, DB_NAME, DB_PORT, DB_CHARSET
        );
        $pdo = new PDO($dsn, DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]);
        return $pdo;
    }
}
