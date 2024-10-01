<?php
session_start();
//Database Configuration File
include('includes/config.php');

if (isset($_POST['login'])) {
    // Getting username/email and password
    $uname = $_POST['username'];
    $password = md5($_POST['password']);
    
    // Fetch data from database based on username/email and password
    $sql = mysqli_query($con, "SELECT AdminUserName, AdminEmailId, AdminPassword, userType FROM tbladmin WHERE (AdminUserName='$uname' && AdminPassword='$password')");
    $num = mysqli_fetch_array($sql);

    if ($num > 0) {
        $_SESSION['login'] = $_POST['username'];
        $_SESSION['utype'] = $num['userType'];
        echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
    } else {
        echo "<script>alert('Invalid Details');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="UMPHub.">
    <meta name="author" content="UMPHacker">

    <!-- App title -->
    <title>UMPHub | Admin Panel</title>

    <!-- App css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/admin.css" rel="stylesheet" type="text/css">

    <script src="assets/js/modernizr.min.js"></script>
    <style>
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

        /* Container styling */
        /* Container styling */
/* Container styling */
        .container {
            background-color: #F0F0F0;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px #4862CB;
            max-width: 400px;
            width: 100%;
            text-align: center;
            min-height: 350px; /* Set a minimum height */
            display: flex;
            flex-direction: column; /* Stack children vertically */
            justify-content: center; /* Center vertically */
        }


        /* Heading styling */
        h2 {
            text-align: center;
            font-size: 30px;
            letter-spacing: 2px;
            font-weight: bold;
            color: #7bace7;
            margin-bottom: 20px;
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

<body class="bg-transparent">
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
        <h2>UMPHub Admin</h2>
        <form method="post">
            <div class="form-group">
                <label for="username">Username/Email</label>
                <input type="text" name="username" class="form-control" placeholder="Enter Username/Email" required />
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter Password" required />
            </div>
            <button type="submit" name="login" class="btn btn-primary">Login</button>
        </form>
        <div class="extra-links">
            <br>
            <a href="forgot-password.php">Forgot Password?</a>
        </div>
    </div>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
