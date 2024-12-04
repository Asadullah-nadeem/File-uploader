<!--subscribe.php  -->
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'config.php';
function generateApiKey($length = 32)
{
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
                $subject = "Welcome to Codeaxe - Your API Key & Documentation Details";

                $message = "
               <!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background: #f9f9f9;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            color: #007BFF;
        }
        .content {
            margin-bottom: 20px;
        }
        .api-key-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #e9ecef;
            padding: 10px;
            border-radius: 5px;
            font-size: 1em;
        }
        .copy-icon {
            cursor: pointer;
            color: #007BFF;
            font-size: 1.2em;
        }
        .cta {
            text-align: center;
            margin-top: 20px;
        }
        .cta a {
            display: inline-block;
            padding: 10px 20px;
            color: #fff;
            background-color: #007BFF;
            text-decoration: none;
            border-radius: 5px;
        }
        .cta a:hover {
            background-color: #0056b3;
        }
        .footer {
            text-align: center;
            font-size: 0.9em;
            color: #777;
        }
    </style>
</head>
<body>
    <div class='container'>
        <div class='header'>
            <h1>Welcome to Codeaxe</h1>
        </div>
        <div class='content'>
            <p>Hi there,</p>
            <p>Thank you for signing up! We're excited to have you onboard. Here is your API Key:</p>
            <div class='api-key-container'>
                <span id='apiKey'>$apiKey</span>
            </div>
            <p>You can access the API documentation and further details using the link below:</p>
            <p><a href='https://bucket.codeaxe.co.in/docs' target='_blank'>API Documentation</a></p>
            <p>If you have any questions or need assistance, feel free to reach out to us.</p>
        </div>
        <div class='cta'>
            <a href='https://bucket.codeaxe.co.in'>Go to Dashboard</a>
        </div>
        <div class='footer'>
            <p>&copy; " . date('Y') . " Codeaxe. All rights reserved.</p>
        </div>
    </div>
    <script>
        function copyApiKey() {
            var apiKeyText = document.getElementById('apiKey').innerText;
            navigator.clipboard.writeText(apiKeyText).then(function() {
                alert('API Key copied to clipboard!');
            }, function(err) {
                alert('Failed to copy API Key.');
            });
        }
    </script>
</body>
</html>
";

                $headers = "From: no-reply@bucket.codeaxe.co.in\r\n";
                // $headers .= "Reply-To: support@bucket.codeaxe.co.in\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

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
