<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'codeaxe2_bucket');
define('DB_USER', 'codeaxe2_bucketbucket');
define('DB_PASS', '&t#NA3J@qKU.');
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
?>
