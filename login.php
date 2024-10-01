<?php
session_start();
include('includes/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $userType = 'user'; 
    $table = 'tblusers'; // User table

    if (empty($email) || empty($password)) {
        $error = "Please fill in both fields.";
    } else {
        // Prepare and execute SQL query
        $stmt = $con->prepare("SELECT * FROM $table WHERE emailID = ?");
        if ($stmt === false) {
            die('Prepare() failed: ' . htmlspecialchars($con->error));
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            
            // Verify password
            if (password_verify($password, $row['password'])) {
                $_SESSION['login'] = $email;
                $_SESSION['userType'] = $userType;
                header('location: feeds.php');
                exit();
            } else {
                $error = "Incorrect password.";
            }
        } else {
            $error = "No account found with that email.";
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
    <title>Login</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    
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
        <h2 class="mt-5">User Login</h2><br>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
                <div class="row mt-3">
                    <div class="col-xs-6 col-sm-6">
                        <p class="forgotPwd">
                            <a class="lnk-toggler" data-panel=".panel-forgot" href="passwordReset.php">Forgot password?</a>
                        </p>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
                <br>
            </div>
        </form>
        <p class="mt-3">Don't have an account? <a href="reg.php">Register here</a>.</p>
        <p class="mt-3">Log in as 👑<a href="admin/index.php">Admin</a>.</p>
    </div>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
