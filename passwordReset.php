<?php
session_start();
include('includes/config.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Load environment variables
try {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
} catch (\Dotenv\Exception\InvalidPathException $e) {
    error_log("Error loading .env file: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['request_reset'])) {
    $emailIdOrfullName = $_POST['emailOrUsername'];

    $stmt = $con->prepare("SELECT emailId FROM tblusers WHERE emailId = ? OR fullName = ?");
    $stmt->bind_param("ss", $emailIdOrfullName, $emailIdOrfullName);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $emailId = $row['emailId'];

        $token = bin2hex(random_bytes(50));
        $_SESSION['reset_token'] = $token;

        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->SMTPDebug = 2; // Enable verbose debug output
            $mail->isSMTP();
            $mail->Host       = $_ENV['SMTP_HOST'] ?? 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = $_ENV['SMTP_USERNAME'] ?? 'your_email@gmail.com';
            $mail->Password   = $_ENV['SMTP_PASSWORD'] ?? 'your_app_password';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = $_ENV['SMTP_PORT'] ?? 587;

            // Set a longer timeout
            $mail->Timeout = 60; // Timeout after 60 seconds

            // Recipients
            $mail->setFrom($_ENV['SMTP_FROM_EMAIL'] ?? 'no-reply@yourdomain.com', 'UmpHub');
            $mail->addAddress($emailId);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Password Reset Request';
            $resetLink = ($_ENV['APP_URL'] ?? 'http://localhost/UMPHub-Updated') . "/reset_password.php?token=" . $token;
            $mail->Body    = "To reset your password, please click the link: <a href='$resetLink'>Reset Password</a>";
            $mail->AltBody = "To reset your password, please copy and paste the following URL into your browser: $resetLink";

            $mail->send();
            $success = "Password reset link has been sent to your email.";
        } catch (Exception $e) {
            $error = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            error_log("Email sending failed: " . $mail->ErrorInfo);
            
            // Additional error information
            $error .= "\nDebug info: " . print_r($mail->SMTPDebug, true);
            
            // Try alternative SMTP settings
            try {
                $mail->Host = 'smtp.office365.com'; // Outlook SMTP server
                $mail->Port = 587;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->send();
                $success = "Password reset link has been sent to your email using alternative SMTP.";
            } catch (Exception $e2) {
                $error .= "\nAlternative SMTP also failed: " . $e2->getMessage();
            }
        }
    } else {
        $error = "Email or username not found.";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Password Reset</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Your existing CSS styles here */
    </style>
</head>
<body>
<div class="container">
    <h2>Request Password Reset</h2>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo nl2br(htmlspecialchars($error)); ?>
        </div>
    <?php endif; ?>
    <?php if (isset($success)): ?>
        <div class="alert alert-success" role="alert">
            <?php echo htmlspecialchars($success); ?>
        </div>
    <?php endif; ?>
    <form method="POST" action="">
        <div class="form-group">
            <label for="emailOrUsername">Email or Username</label>
            <input type="text" class="form-control" id="emailOrUsername" name="emailOrUsername" required>
        </div>
        <button type="submit" name="request_reset" class="btn btn-primary">Request Reset</button>
    </form>
</div>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>