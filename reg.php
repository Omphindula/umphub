<?php
session_start();
require 'vendor/autoload.php'; // Load Composer's autoloader
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include('includes/config.php'); // Include your database configuration file

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST['username'];
    $password = $_POST['password'];
    $emailId = $_POST['email'];

    // Check if email already exists
    $stmt = $con->prepare("SELECT emailId FROM tblusers WHERE emailId = ?");
    if ($stmt === false) {
        die('Prepare() failed: ' . htmlspecialchars($con->error));
    }

    $stmt->bind_param("s", $emailId);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $error = "Email is already registered.";
    } else {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare and bind to insert the new user
        $stmt = $con->prepare("INSERT INTO tblusers (fullName, password, emailId) VALUES (?, ?, ?)");
        if ($stmt === false) {
            die('Prepare() failed: ' . htmlspecialchars($con->error));
        }

        $stmt->bind_param("sss", $fullName, $hashedPassword, $emailId);

        if ($stmt->execute()) {
            $success = "Registration successful.";

            // Send confirmation email using PHPMailer
            $mail = new PHPMailer(true);
            try {
                // Server settings
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com'; // SMTP server
                $mail->SMTPAuth   = true;             
                $mail->Username   = 'omphindulalucas@gmail.com'; // Your email
                $mail->Password   = 'akdbmjflycifqzlq'; // Your password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS
                $mail->Port       = 587; // TCP port to connect to

                // Recipients
                $mail->setFrom('no-reply@umphub.com', 'UmpHub'); // Set "from" address
                $mail->addAddress($emailId, $fullName); // Add a recipient

                // Content
                $mail->isHTML(true);
                $mail->Subject = 'Registration Confirmation';
                $mail->Body    = "Dear $fullName,<br><br>Thank you for registering on UmpHub.<br><br>Best regards,<br>UmpHub Team";

                $mail->send();
                $success .= " A confirmation email has been sent to your email address.";
            } catch (Exception $e) {
                $error = "Registration successful, but the confirmation email could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }

        } else {
            $error = "Error: " . $stmt->error;
        }
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <style>
        /* Basic reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            position: relative;
            overflow: hidden;
        }

        /* SVG Background */
        #bg-wrap {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        #bg-wrap svg {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            z-index: -1;
        }

        /* Fade-in animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Container styling */
        .container {
            background-color: #F0F0F0;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px #4862CB;
            max-width: 400px;
            width: 100%;
            text-align: center;
            animation: fadeIn 1s ease-out; /* Apply fade-in animation */
        }

        /* Heading styling */
        h2 {
            text-align: center;
            font-size: 30px;
            letter-spacing: 2px;
            font-weight: bold;
            color: #7bace7;
        }

        /* Form group styling */
        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .form-group label {
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
            display: block;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            font-size: 16px;
        }

        .form-group input:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25);
        }

        /* Button styling */
        .btn-primary {
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            margin-top: 10px;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #3f6992;
        }

        /* Alert messages */
        .alert {
            background-color: #ffdddd;
            color: #d8000c;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            text-align: center;
        }

        /* Margin top for spacing */
        .mt-3 {
            margin-top: 15px;
        }

        /* Extra links styling */
        .extra-links {
            color: #007bff;
            font-size: 14px;
        }

        .extra-links a {
            color: #007bff;
            text-decoration: none;
        }

        .extra-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div id="bg-wrap">
    <svg viewBox="0 0 100 100" preserveAspectRatio="xMidYMid slice">
        <!-- SVG Definitions and Animated Gradients -->
        <defs>
            <!-- Gradient for Yellow -->
            <radialGradient id="GradientYellow" cx="50%" cy="50%" fx="0.441602%" fy="50%" r=".5">
                <animate attributeName="fx" dur="34s" values="0%;3%;0%" repeatCount="indefinite"></animate>
                <stop offset="0%" stop-color="rgba(255, 255, 0, 1)"></stop>
                <stop offset="100%" stop-color="rgba(255, 255, 0, 0)"></stop>
            </radialGradient>

            <!-- Gradient for Blue -->
            <radialGradient id="GradientBlue" cx="50%" cy="50%" fx="0.441602%" fy="50%" r=".5">
                <animate attributeName="fx" dur="22s" values="0%;3%;0%" repeatCount="indefinite"></animate>
                <stop offset="0%" stop-color="rgba(0, 0, 255, 1)"></stop>
                <stop offset="100%" stop-color="rgba(0, 0, 255, 0)"></stop>
            </radialGradient>

            <!-- Gradient for Light Green -->
            <radialGradient id="GradientGreen" cx="50%" cy="50%" fx="0.441602%" fy="50%" r=".5">
                <animate attributeName="fx" dur="26s" values="0%;3%;0%" repeatCount="indefinite"></animate>
                <stop offset="0%" stop-color="rgba(144, 238, 144, 1)"></stop>
                <stop offset="100%" stop-color="rgba(144, 238, 144, 0)"></stop>
            </radialGradient>
        </defs>
        
        <!-- Animated Rects -->
        <rect x="13.744%" y="1.18473%" width="100%" height="100%" fill="url(#GradientYellow)" transform="rotate(334.41 50 50)">
            <animate attributeName="x" dur="20s" values="25%;0%;25%" repeatCount="indefinite"></animate>
            <animate attributeName="y" dur="21s" values="0%;25%;0%" repeatCount="indefinite"></animate>
            <animateTransform attributeName="transform" type="rotate" from="0 50 50" to="360 50 50" dur="7s" repeatCount="indefinite"></animateTransform>
        </rect>
        <rect x="0%" y="13.744%" width="100%" height="100%" fill="url(#GradientBlue)" transform="rotate(334.41 50 50)">
            <animate attributeName="x" dur="15s" values="0%;25%;0%" repeatCount="indefinite"></animate>
            <animate attributeName="y" dur="19s" values="25%;0%;25%" repeatCount="indefinite"></animate>
            <animateTransform attributeName="transform" type="rotate" from="0 50 50" to="360 50 50" dur="8s" repeatCount="indefinite"></animateTransform>
        </rect>
        <rect x="13.744%" y="0%" width="100%" height="100%" fill="url(#GradientGreen)" transform="rotate(334.41 50 50)">
            <animate attributeName="x" dur="18s" values="25%;0%;25%" repeatCount="indefinite"></animate>
            <animate attributeName="y" dur="23s" values="0%;25%;0%" repeatCount="indefinite"></animate>
            <animateTransform attributeName="transform" type="rotate" from="0 50 50" to="360 50 50" dur="6s" repeatCount="indefinite"></animateTransform>
        </rect>
    </svg>
</div>


<div class="container">
    <h2>Register</h2>

    <?php if (isset($success)): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success); ?></div>
    <?php endif; ?>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="form-group">
            <label for="username">Full Name</label>
            <input type="text" name="username" id="username" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>

    <div class="extra-links mt-3">
        <p>Already have an account? <a href="login.php">Login</a></p>
    </div>
</div>

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
