<?php
session_start();
include("includes/config.php");

// Unset all session variables and destroy the session
$_SESSION['login'] = "";
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logged Out</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .logout-container {
            text-align: center;
            background-color: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 500px;
        }

        h1 {
            color: #ff4d4d;
            font-size: 2rem;
            margin-bottom: 20px;
        }

        p {
            font-size: 1.2rem;
            margin-bottom: 10px;
        }

        .countdown {
            font-weight: bold;
            color: lightblue;
            font-size: 1.5rem;
        }

        a {
            color: #4d79ff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
    <script>
        // Countdown timer
        let seconds = 30; // Set the initial countdown value

        function countdown() {
            // Update the countdown text
            document.getElementById('countdown').textContent = seconds + " seconds";

            // Reduce the countdown value by 1 every second
            seconds--;

            // If the countdown reaches 0, redirect to login page
            if (seconds < 0) {
                window.location.href = 'login.php'; // Redirect after 30 seconds
            }
        }

        // Run the countdown every 1 second
        setInterval(countdown, 1000);
    </script>
</head>
<body>
    <div class="logout-container">
        <h1 style=color:lightblue;>You have been logged out</h1>
        <p>You will be redirected to the login page in <span id="countdown" class="countdown">30 seconds</span>.</p>
        <p>If you do not want to wait, <a href="login.php">click here</a> to log in immediately.</p>
    </div>
</body>
</html>
