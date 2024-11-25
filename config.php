<?php
define('DB_HOST', 'localhost');
define('DB_NAME', '*************');
define('DB_USER', '*************');
define('DB_PASS', '**************');
define('UPLOAD_DIR', 'uploads/');
define('BASE_URL', 'https://url.in/');
function getDatabaseConnection() {
    try {
        $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Database connection failed: " . $e->getMessage());
    }
}

