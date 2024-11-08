<?php
require_once 'config.php';

function authenticateApiKey($apiKey) {
    $pdo = getDatabaseConnection();
    $stmt = $pdo->prepare("SELECT * FROM subscribers WHERE api_key = :api_key");
    $stmt->execute(['api_key' => $apiKey]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function generate8BitUniqueKey($length = 8) {
    return substr(bin2hex(random_bytes($length)), 0, $length); 
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $apiKey = $_SERVER['HTTP_API_KEY'] ?? $_POST['api_key'] ?? '';
    $user = authenticateApiKey($apiKey);
    if (!$user) {
        http_response_code(401);
        echo json_encode(["error" => "Unauthorized. Invalid API key."]);
        exit;
    }

    if (!isset($_FILES['image'])) {
        http_response_code(400);
        echo json_encode(["error" => "No image uploaded."]);
        exit;
    }

    $uniqueDirKey = generate8BitUniqueKey();
    $uploadDir = UPLOAD_DIR . $uniqueDirKey . '/';

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $fileName = generate8BitUniqueKey() . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
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