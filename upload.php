<?php

require_once 'config.php';

$pdo = getDatabaseConnection();

function generate8BitUniqueKey($length = 8) {
    return substr(bin2hex(random_bytes($length)), 0, $length); 
}

//if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
//    $uniqueDirKey = generate8BitUniqueKey();
//    $uploadDir = UPLOAD_DIR . $uniqueDirKey . '/';
//
//    if (!is_dir($uploadDir)) {
//        mkdir($uploadDir, 0777, true);
//    }
//
//    $fileName = generate8BitUniqueKey() . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
//    $filePath = $uploadDir . $fileName;
//
//    if (move_uploaded_file($_FILES['image']['tmp_name'], $filePath)) {
//        $uniqueKey = generateUniqueKey();
//
//        $stmt = $pdo->prepare("INSERT INTO images (unique_key, file_name, directory_key) VALUES (:unique_key, :file_name, :directory_key)");
//        $stmt->execute(['unique_key' => $uniqueKey, 'file_name' => $fileName, 'directory_key' => $uniqueDirKey]);
//
//        $uniqueUrl = BASE_URL . "view.php?key=" . $uniqueKey;
//        $fileUrl = BASE_URL . $uploadDir . $fileName;
//
//        echo "Image uploaded successfully! Access it at: $uniqueUrl";
//        echo "<br>Direct image URL: $fileUrl";
//    } else {
//        echo "Failed to upload the image.";
//    }
//}
//if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
//    $fileType = mime_content_type($_FILES['image']['tmp_name']);
//    $validImageTypes = ['image/jpeg', 'image/png', 'image/gif'];
//
//    if (!in_array($fileType, $validImageTypes)) {
//        echo "Invalid file type. Only image files are allowed.";
//        exit;
//    }
//
//    $uniqueDirKey = generate8BitUniqueKey();
//    $uploadDir = UPLOAD_DIR . $uniqueDirKey . '/';
//
//    if (!is_dir($uploadDir)) {
//        mkdir($uploadDir, 0777, true);
//    }
//
//    $fileName = generate8BitUniqueKey() . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
//    $filePath = $uploadDir . $fileName;
//
//    if (move_uploaded_file($_FILES['image']['tmp_name'], $filePath)) {
//        $uniqueKey = generateUniqueKey();
//
//        $stmt = $pdo->prepare("INSERT INTO images (unique_key, file_name, directory_key) VALUES (:unique_key, :file_name, :directory_key)");
//        $stmt->execute(['unique_key' => $uniqueKey, 'file_name' => $fileName, 'directory_key' => $uniqueDirKey]);
//
//        $uniqueUrl = BASE_URL . "view.php?key=" . $uniqueKey;
//        $fileUrl = BASE_URL . $uploadDir . $fileName;
//
//        echo "Image uploaded successfully! Access it at: $uniqueUrl";
//        echo "<br>Direct image URL: $fileUrl";
//    } else {
//        echo "Failed to upload the image.";
//    }
//} else {
//    echo "No file uploaded.";
//}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    $maxSize = 5 * 1024 * 1024; // 5 MB in bytes
    if ($_FILES['image']['size'] > $maxSize) {
        echo "File size exceeds 5 MB. Please upload a smaller image.";
        exit;
    }

    $fileType = mime_content_type($_FILES['image']['tmp_name']);
    $validImageTypes = [
        'image/jpeg', 'image/png', 'image/gif', 'image/bmp',
        'image/webp', 'image/tiff', 'image/svg+xml', 'image/x-icon',
        'image/heic', 'image/avif'
    ];

    if (!in_array($fileType, $validImageTypes)) {
        echo "Invalid file type. Only image files are allowed.";
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
        $uniqueKey = generateUniqueKey();

        $stmt = $pdo->prepare("INSERT INTO images (unique_key, file_name, directory_key) VALUES (:unique_key, :file_name, :directory_key)");
        $stmt->execute(['unique_key' => $uniqueKey, 'file_name' => $fileName, 'directory_key' => $uniqueDirKey]);

        $uniqueUrl = BASE_URL . "view.php?key=" . $uniqueKey;
        $fileUrl = BASE_URL . $uploadDir . $fileName;

        echo "Image uploaded successfully! Access it at: $uniqueUrl";
        echo "<br>Direct image URL: $fileUrl";
    } else {
        echo "Failed to upload the image.";
    }
} else {
    echo "No file uploaded.";
}

