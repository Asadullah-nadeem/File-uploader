<?php
require_once 'config.php';

$pdo = getDatabaseConnection();

if (isset($_GET['key'])) {
    $uniqueKey = $_GET['key'];
    $stmt = $pdo->prepare("SELECT file_name FROM images WHERE unique_key = :unique_key");
    $stmt->execute(['unique_key' => $uniqueKey]);
    $image = $stmt->fetch();

    if ($image) {
        $filePath = UPLOAD_DIR . $image['file_name'];
        $mimeType = mime_content_type($filePath);

        if (file_exists($filePath)) {
            header("Content-Type: $mimeType");
            readfile($filePath);
        } else {
            http_response_code(404);
            echo "Image file not found.";
        }
    } else {
        http_response_code(400);
        echo "Invalid image key.";
    }
} else {
    http_response_code(400);
    echo "No image key provided.";
}