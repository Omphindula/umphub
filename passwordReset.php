<?php
session_start();
include('includes/config.php'); // Include your database configuration file

$loaderVisible = false;
$error = ''; // Initialize error message
$success = ''; // Initialize success message

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $loaderVisible = true; // Show loader when form is submitted

    $fullName = trim($_POST['username']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    $emailId = trim($_POST['email']);

    // Validation
    if (strlen($password) < 6) {
        $error = "Password must be at least 6 characters long.";
        $loaderVisible = false; // Hide loader on error
    } elseif ($password !== $confirmPassword) {
        $error = "Passwords do not match.";
        $loaderVisible = false; // Hide loader on error
    } elseif (!filter_var($emailId, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
        $loaderVisible = false; // Hide loader on error
    } else {
        // Check if fullName or email already exists
        $checkStmt = $con->prepare("SELECT userId FROM tblusers WHERE fullName = ? OR emailId = ?");
        if ($checkStmt === false) {
            die('Prepare() failed: ' . htmlspecialchars($con->error));
        }
        $checkStmt->bind_param("ss", $fullName, $emailId);
        $checkStmt->execute();
        $checkStmt->store_result();

        if ($checkStmt->num_rows > 0) {
            $error = "Full Name or Email already exists. Please choose a different one.";
            $loaderVisible = false; // Hide loader on error
        } else {
            // Insert new user into the database
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $con->prepare("INSERT INTO tblusers (fullName, password, emailId) VALUES (?, ?, ?)");
            if ($stmt === false) {
                die('Prepare() failed: ' . htmlspecialchars($con->error));
            }

            $stmt->bind_param("sss", $fullName, $hashedPassword, $emailId);

            if ($stmt->execute()) {
                $success = "Registration successful! You can now sign in.";
            } else {
                $error = "Error: " . $stmt->error;
            }

            $stmt->close();
        }

        $checkStmt->close();
        $loaderVisible = false; // Hide loader after process
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #a8edea, #fed6e3);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: sans-serif;
        }
        .container {
            background: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
        }
        .loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            visibility: hidden;
        }
        .loader.visible {
            visibility: visible;
        }
        .spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #3498db;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 2s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .form-label, .form-control {
            margin-bottom: 15px;
        }
        .text-success, .text-danger {
            margin-bottom: 15px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="loader <?= $loaderVisible ? 'visible' : ''; ?>">
        <div class="spinner"></div>
    </div>

    <div class="container">
        <h2 class="text-center text-primary mb-4">Register</h2>

        <!-- Success or Error Messages -->
        <?php if (!empty($success)): ?>
            <div class="text-success text-center"><?= htmlspecialchars($success); ?></div>
        <?php endif; ?>
        <?php if (!empty($error)): ?>
            <div class="text-danger text-center"><?= htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="POST" onsubmit="return validateForm();" novalidate>
            <label for="username" class="form-label">Full Name</label>
            <input type="text" name="username" id="username" class="form-control" required>

            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>

            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>

            <label for="confirm_password" class="form-label">Confirm Password</label>
            <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
            <small id="password-match-feedback" class="text-danger"></small>

            <button type="submit" class="btn btn-primary w-100">Register</button>
        </form>

        <div class="mt-3 text-center">
            <p>Already have an account? <a href="login.php">Sign In</a></p>
        </div>
    </div>

    <script>
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('confirm_password');
        const passwordMatchFeedback = document.getElementById('password-match-feedback');

        // Password validation
        function validateForm() {
            if (passwordInput.value.length < 6) {
                alert("Password must be at least 6 characters long.");
                return false;
            }
            if (passwordInput.value !== confirmPasswordInput.value) {
                alert("Passwords do not match.");
                return false;
            }
            return true;
        }

        confirmPasswordInput.addEventListener('input', () => {
            if (confirmPasswordInput.value !== passwordInput.value) {
                passwordMatchFeedback.textContent = "Passwords do not match.";
            } else {
                passwordMatchFeedback.textContent = "";
            }
        });
    </script>
</body>
</html>
