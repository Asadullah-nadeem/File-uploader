<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'config.php';
function generateApiKey($length = 32) {
    return bin2hex(random_bytes($length / 2));
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $pdo = getDatabaseConnection();
        $stmt = $pdo->prepare("SELECT * FROM subscribers WHERE email = :email");
        $stmt->execute(['email' => $email]);
        
        if ($stmt->rowCount() > 0) {
            $message = "This email is already subscribed.";
        } else {
            $apiKey = generateApiKey();

            $stmt = $pdo->prepare("INSERT INTO subscribers (email, api_key) VALUES (:email, :api_key)");
            if ($stmt->execute(['email' => $email, 'api_key' => $apiKey])) {
                $subject = "Your API Key for Image Upload";
                $message = "Thank you for subscribing! Here is your API key:\n\n" . $apiKey;
                $headers = "From: no-reply@bucket.codeaxe.co.in";

                if (mail($email, $subject, $message, $headers)) {
                    $message = "Subscription successful! Your API key has been sent to your email.";
                } else {
                    $message = "Failed to send email. Please try again.";
                }
            } else {
                $message = "Failed to insert data into the database.";
            }
        }
    } else {
        $message = "Invalid email address.";
    }

    echo "<script>
        alert('$message');
        window.location.href = 'index.php';
    </script>";
} else {
    echo "<script>
        alert('No email provided.');
        window.location.href = 'index.php';
    </script>";
}