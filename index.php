<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UMP Connect</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* General Styles */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f7fa;
            color: #333;
            overflow-x: hidden;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* Header Styles */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 40px;
            background-color: #003366;
            color: white;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .logo {
            font-size: 28px;
            font-weight: bold;
        }

        .cta-buttons a {
            padding: 10px 20px;
            background-color: #0077cc;
            color: white;
            border-radius: 5px;
            margin-left: 15px;
            font-size: 14px;
            transition: all 0.3s ease-in-out;
        }

        .cta-buttons a:hover {
            background-color: #005fa3;
            transform: scale(1.1);
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(to bottom right, #003366, #005fa3);
            color: white;
            padding: 100px 20px 50px;
            text-align: center;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            animation: fadeIn 2s ease-in-out;
        }

        .hero h1 {
            font-size: 56px;
            margin: 0 0 20px;
            animation: slideInFromLeft 1.5s ease-in-out;
        }

        .hero p {
            font-size: 20px;
            margin-bottom: 30px;
            max-width: 600px;
            animation: slideInFromRight 1.5s ease-in-out;
        }

        .hero a {
            padding: 15px 30px;
            background-color: white;
            color: #003366;
            font-size: 18px;
            font-weight: bold;
            border-radius: 5px;
            text-transform: uppercase;
            margin: 10px;
            display: inline-block;
            transition: all 0.3s ease-in-out;
        }

        .hero a:hover {
            background-color: #f0f0f0;
            transform: scale(1.1);
        }

        /* Features Section */
        .features {
            padding: 60px 20px;
            background-color: #ffffff;
            text-align: center;
        }

        .features h2 {
            font-size: 36px;
            margin-bottom: 30px;
            color: #003366;
            position: relative;
            display: inline-block;
            animation: fadeIn 2s ease-in-out;
        }

        .features h2::after {
            content: '';
            position: absolute;
            width: 60%;
            height: 3px;
            background-color: #0077cc;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
        }

        .feature-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .feature-item {
            background-color: #f5f7fa;
            border-radius: 10px;
            padding: 30px;
            width: 300px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out, opacity 0.3s ease-in-out;
            animation: fadeIn 2s ease-in-out;
            display: block;
        }

        .feature-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            opacity: 0.8;
        }

        .feature-item i {
            font-size: 40px;
            color: #0077cc;
            margin-bottom: 15px;
        }

        .feature-item h3 {
            font-size: 20px;
            margin: 10px 0;
            color: #003366;
        }

        .feature-item p {
            font-size: 16px;
            color: #555;
        }

        /* Footer Styles */
        .footer {
            background-color: #003366;
            color: white;
            text-align: center;
            padding: 20px 0;
            margin-top: 50px;
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes slideInFromLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInFromRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 40px;
            }

            .hero p {
                font-size: 16px;
            }

            .feature-item {
                width: 80%;
                margin-bottom: 20px;
            }

            .cta-buttons a {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="logo">UMP Connect</div>
        <div class="cta-buttons" style="float: left;">
            <a href="login.php">Login</a>
            <a href="#features">Features</a>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <h1>Welcome to UMP Connect</h1>
        <p>Discover the ultimate platform for student life, collaboration, and campus updates. Dive into a seamless experience tailored just for you!</p>
        <a href="login.php">Get Started</a>
    </section>

    <!-- Features Section -->
    <section id="features" class="features">
        <h2>Why Choose UMP Connect?</h2>
        <div class="feature-grid">
            <a href="login.php" class="feature-item">
                <i class="fas fa-calendar-alt"></i>
                <h3>Upcoming Events</h3>
                <p>Stay up-to-date with the latest happenings on campus and never miss an event again!</p>
            </a>
            <a href="login.php" class="feature-item">
                <i class="fas fa-users"></i>
                <h3>Community</h3>
                <p>Engage with like-minded individuals and build your network with ease.</p>
            </a>
            <a href="login.php" class="feature-item">
                <i class="fas fa-chalkboard-teacher"></i>
                <h3>Resources</h3>
                <p>Access a wide array of educational resources and tools for your success.</p>
            </a>
            <a href="login.php" class="feature-item">
                <i class="fas fa-bullhorn"></i>
                <h3>Announcements</h3>
                <p>Get notified about important campus news and updates as they happen.</p>
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2024 UMPConnect. All Rights Reserved.</p>
    </footer>
</body>
</html>
