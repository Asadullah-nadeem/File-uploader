<?php
require_once 'config.php';

function authenticateApiKey($apiKey) {
    $pdo = getDatabaseConnection();
    $stmt = $pdo->prepare("SELECT * FROM subscribers WHERE api_key = :api_key");
    $stmt->execute(['api_key' => $apiKey]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $apiKey = $_SERVER['HTTP_API_KEY'] ?? '';
    $user = authenticateApiKey($apiKey);

    if (!$user) {
        http_response_code(401);
        echo json_encode(["error" => "Unauthorized. Invalid API key."]);
        exit;
    }

    if (!isset($_FILES['image']) || $_FILES['image']['error'] != UPLOAD_ERR_OK) {
        http_response_code(400);
        echo json_encode(["error" => "No valid image uploaded."]);
        exit;
    }

    $fileType = mime_content_type($_FILES['image']['tmp_name']);
    $validImageTypes = [
        'image/jpeg', 'image/png', 'image/gif', 'image/bmp',
        'image/webp', 'image/tiff', 'image/svg+xml', 'image/x-icon',
        'image/heic', 'image/avif'
    ];

    if (!in_array($fileType, $validImageTypes)) {
        http_response_code(400);
        echo json_encode(["error" => "Invalid file type. Only images are allowed."]);
        exit;
    }

    $uniqueDirKey = bin2hex(random_bytes(4));
    $uploadDir = UPLOAD_DIR . $uniqueDirKey . '/';

    if (!is_dir($uploadDir) && !mkdir($uploadDir, 0777, true)) {
        http_response_code(500);
        echo json_encode(["error" => "Failed to create upload directory."]);
        exit;
    }

    $fileName = bin2hex(random_bytes(8)) . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    $filePath = $uploadDir . $fileName;

    if (move_uploaded_file($_FILES['image']['tmp_name'], $filePath)) {
        http_response_code(200);
        echo json_encode([
            "success" => "Image uploaded successfully.",
            "file_url" => BASE_URL . $uploadDir . $fileName
        ]);
    } else {
        http_response_code(500);
        echo json_encode(["error" => "Failed to upload image."]);
    }
} else {
    http_response_code(405);
    echo json_encode(["error" => "Method not allowed. Please use POST."]);
}
