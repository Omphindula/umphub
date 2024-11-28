<?php
session_start();
include('includes/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emailIdOrFullName = isset($_POST['email']) ? $_POST['email'] : '';  // This can be email or full name
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $userType = 'user'; 
    $table = 'tblusers'; 

    if (empty($emailIdOrFullName) || empty($password)) {
        $error = "Please fill in both fields.";
    } else {
        // Query to fetch user data based on either emailId or fullName
        $stmt = $con->prepare("SELECT * FROM $table WHERE emailId = ? OR fullName = ?");
        if ($stmt === false) {
            die('Database error: ' . htmlspecialchars($con->error));
        }

        $stmt->bind_param("ss", $emailIdOrFullName, $emailIdOrFullName);  // Both params are $emailIdOrFullName
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            
            // Check if password is correct
            if (password_verify($password, $row['password'])) {
                // Set session variables
                $_SESSION['login'] = $emailIdOrFullName;
                $_SESSION['userType'] = $userType;
                $_SESSION['fullName'] = $row['fullName'];  // Store full name in session
                
                // Redirect to feeds.php
                header('location: feeds.php');
                exit();
            } else {
                $error = "Incorrect password.";
            }
        } else {
            $error = "No account found with that email or full name.";
        }

        $stmt->close();
    }
    $con->close();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #a8edea, #fed6e3);
            background-color: #f5f7fa;
            color: #333;
        }

        .container {
            background: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
            animation: fadeIn 1s ease-in-out;
            position: relative;
        }

        h2 {
            color: #007bff;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .extra-links a {
            color: #007bff;
            text-decoration: none;
        }

        .extra-links a:hover {
            text-decoration: underline;
        }

        /* Modify error message text to red */
        .alert {
            color: red;
            text-align: center;
            margin-bottom: 15px;
        }

        .form-group input {
            border: 1px solid #007bff;
            padding: 10px;
            border-radius: 5px;
        }

        /* Style for Forgot password link */
        .forgot-password-link {
            text-align: left;
            margin-top: 5px;
        }

        .forgot-password-link a {
            color: #007bff;
            text-decoration: none;
        }

        .forgot-password-link a:hover {
            text-decoration: underline;
        }

        /* Loader Styles */
        .loader {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #007bff;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 2s linear infinite;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: none; /* Hidden by default */
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

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
    </style>
</head>
<body>
    <div class="container">
        <h2>User Login</h2>
        <?php if (isset($error)): ?>
            <div class="alert"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form method="POST" action="" onsubmit="showLoader()">
            <div class="form-group">
             <label for="email">Email /Name</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
                <div class="forgot-password-link">
                    <a href="passwordReset.php">Forgot password?</a>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
        </form>
        <div class="mt-3 extra-links">
            <p style="text-align:center;">Don't have an account? <a href="reg.php">Register here</a></p>
        </div>
        <!-- Loader -->
        <div class="loader" id="loader"></div>
    </div>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script>
        // Function to show the loader
        function showLoader() {
            document.getElementById('loader').style.display = 'block';
        }
    </script>
</body>
</html>
