<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['newpassword']);
    $query = mysqli_query($con, "SELECT id FROM tbladmin WHERE AdminEmailId='$email' AND AdminUserName='$username'");
    
    $ret = mysqli_num_rows($query);
    if ($ret > 0) {
        $query1 = mysqli_query($con, "UPDATE tbladmin SET AdminPassword='$password' WHERE AdminEmailId='$email' AND AdminUserName='$username'");
        if ($query1) {
            echo "<script>alert('Password successfully changed');</script>";
            echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
        }
    } else {
        echo "<script>alert('Invalid Details. Please try again.');</script>";
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

    <title>UMPHub | Reset Password</title>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />

    <script src="assets/js/modernizr.min.js"></script>

    <style>
        body {
            background: linear-gradient(to right, #C9D994 0%, #5B8EBA 100%);
            font-family: 'Arial', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh; /* Full viewport height */
            margin: 0; /* Remove default margin */
            
        }
        .wrapper-page {
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 80px 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 100%; /* Responsive width */
            max-width: 400px; /* Maximum width for the container */
        }
        .account-logo-box {
            margin-bottom: 20px;
            background-color: Lightblue;
            text-align: center;
            padding: 10px; /* Padding for logo box */
            border-radius: 5px; /* Rounded corners */
        }
        h4 {
            margin-bottom: 10px;
            font-weight: bold;
            color: #333;
        }
        label {
            font-weight: 500;
            color: #555;
        }
        input {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            width: 100%; /* Full width for inputs */
            box-sizing: border-box; /* Include padding in width */
            transition: border 0.3s;
        }
        input:focus {
            border-color: #4facfe;
            outline: none;
        }
        button {
            background-color: #4facfe;
            border: none;
            color: white;
            padding: 12px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%; /* Full width for button */
        }
        button:hover {
            background-color: #00f2fe;
        }
        .link {
            display: inline-block;
            margin-top: 10px;
            color: #4facfe;
            text-decoration: none;
            transition: color 0.3s;
        }
        .link:hover {
            color: #00f2fe;
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="wrapper-page">
        <div class="account-logo-box">
            <h4>Reset Password</h4>
        </div>
        <div class="account-content">
            <form class="space-y-4" method="post">
                <div class="space-y-2">
                    <label for="username">Username</label>
                    <input id="username" name="username" type="text" placeholder="Enter your username" required />
                </div>
                <div class="space-y-2">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" placeholder="Enter your email" required />
                </div>
                <div class="space-y-2">
                    <label for="newpassword">New Password</label>
                    <input id="newpassword" name="newpassword" type="password" placeholder="Enter new password" required />
                </div>
                <div class="space-y-2">
                    <label for="confirmpassword">Confirm Password</label>
                    <input id="confirmpassword" name="confirmpassword" type="password" placeholder="Confirm new password" required />
                </div><br>
                <button type="submit" name="submit">Reset</button>
            </form><br>
            <div class="flex justify-center mt-4">
                <a href="index.php" class="link">Admin</a>
            </div>
        </div>
    </div>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/detect.js"></script>
    <script src="assets/js/fastclick.js"></script>
    <script src="assets/js/jquery.blockUI.js"></script>
    <script src="assets/js/waves.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.core.js"></script>
    <script src="assets/js/jquery.app.js"></script>

</body>
</html>
