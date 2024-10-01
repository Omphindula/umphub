<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Splash Screen with Animation</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@700&display=swap">

    <style>
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: ;
            overflow: hidden;
        }

        #bg-wrap {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .splash-screen {
            text-align: center;
            padding: 20px;
          
            border-radius: 10px;
            z-index: 10;
        }

        .splash-screen img {
            max-width: 100%;
            height: auto;
            border-radius: 12px;
        }

        .loader {
            --s: 28px;
            height: var(--s);
            aspect-ratio: 2.5;
            --_g: #000 90%, #0000;
            --_g0: no-repeat radial-gradient(farthest-side, var(--_g));
            --_g1: no-repeat radial-gradient(farthest-side at top, var(--_g));
            --_g2: no-repeat radial-gradient(farthest-side at bottom, var(--_g));
            background: var(--_g0), var(--_g1), var(--_g2), var(--_g0), var(--_g1), var(--_g2);
            background-size: 20% 50%, 20% 25%, 20% 25%;
            animation: l45 1s infinite;
            margin-top: 20px;
        }

        @keyframes l45 {
            0%   {background-position:calc(0*100%/3) 50%, calc(1*100%/3) calc(50% + calc(var(--s)/8)), calc(1*100%/3) calc(50% - calc(var(--s)/8)), calc(3*100%/3) 50%, calc(2*100%/3) calc(50% + calc(var(--s)/8)), calc(2*100%/3) calc(50% - calc(var(--s)/8))}
            33%  {background-position:calc(0*100%/3) 50%, calc(1*100%/3) 100%, calc(1*100%/3) 0, calc(3*100%/3) 50%, calc(2*100%/3) 100%, calc(2*100%/3) 0}
            66%  {background-position:calc(1*100%/3) 50%, calc(0*100%/3) 100%, calc(0*100%/3) 0, calc(2*100%/3) 50%, calc(3*100%/3) 100%, calc(3*100%/3) 0}
            90%, 100% {background-position:calc(1*100%/3) 50%, calc(0*100%/3) calc(50% + calc(var(--s)/8)), calc(0*100%/3) calc(50% - calc(var(--s)/8)), calc(2*100%/3) 50%, calc(3*100%/3) calc(50% + calc(var(--s)/8)), calc(3*100%/3) calc(50% - calc(var(--s)/8))}
        }

        /* Removed the large blue background and adjusted the font size */
        .ump-hub-text {
            color: white;
            font-size: 100px;
            font-weight: bold;
            color:#172B4E;
            width: 300px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div id="bg-wrap">
        <svg viewBox="0 0 100 100" preserveAspectRatio="xMidYMid slice">
            <defs>
                <radialGradient id="Gradient1" cx="50%" cy="50%" fx="0.441602%" fy="50%" r=".5">
                    <animate attributeName="fx" dur="34s" values="0%;3%;0%" repeatCount="indefinite"></animate>
                    <stop offset="0%" stop-color="rgba(255, 255, 0, 1)"></stop> <!-- Yellow -->
                    <stop offset="100%" stop-color="rgba(255, 255, 0, 0)"></stop>
                </radialGradient>
                <radialGradient id="Gradient2" cx="50%" cy="50%" fx="2.68147%" fy="50%" r=".5">
                    <animate attributeName="fx" dur="23.5s" values="0%;3%;0%" repeatCount="indefinite"></animate>
                    <stop offset="0%" stop-color="rgba(0, 0, 255, 1)"></stop> <!-- Blue -->
                    <stop offset="100%" stop-color="rgba(0, 0, 255, 0)"></stop>
                </radialGradient>
                <radialGradient id="Gradient3" cx="50%" cy="50%" fx="0.836536%" fy="50%" r=".5">
                    <animate attributeName="fx" dur="21.5s" values="0%;3%;0%" repeatCount="indefinite"></animate>
                    <stop offset="0%" stop-color="rgba(255, 255, 255, 1)"></stop> <!-- White -->
                    <stop offset="100%" stop-color="rgba(255, 255, 255, 0)"></stop>
                </radialGradient>
            </defs>
            <rect x="13.744%" y="1.18473%" width="100%" height="100%" fill="url(#Gradient1)" transform="rotate(334.41 50 50)">
                <animate attributeName="x" dur="20s" values="25%;0%;25%" repeatCount="indefinite"></animate>
                <animate attributeName="y" dur="21s" values="0%;25%;0%" repeatCount="indefinite"></animate>
                <animateTransform attributeName="transform" type="rotate" from="0 50 50" to="360 50 50" dur="7s" repeatCount="indefinite"></animateTransform>
            </rect>
            <rect x="-2.17916%" y="35.4267%" width="100%" height="100%" fill="url(#Gradient2)" transform="rotate(255.072 50 50)">
                <animate attributeName="x" dur="23s" values="-25%;0%;-25%" repeatCount="indefinite"></animate>
                <animate attributeName="y" dur="24s" values="0%;50%;0%" repeatCount="indefinite"></animate>
                <animateTransform attributeName="transform" type="rotate" from="0 50 50" to="360 50 50" dur="12s" repeatCount="indefinite"></animateTransform>
            </rect>
            <rect x="9.00483%" y="14.5733%" width="100%" height="100%" fill="url(#Gradient3)" transform="rotate(139.903 50 50)">
                <animate attributeName="x" dur="25s" values="0%;25%;0%" repeatCount="indefinite"></animate>
                <animate attributeName="y" dur="12s" values="0%;25%;0%" repeatCount="indefinite"></animate>
                <animateTransform attributeName="transform" type="rotate" from="360 50 50" to="0 50 50" dur="9s" repeatCount="indefinite"></animateTransform>
            </rect>
        </svg>
    </div>

    <div class="splash-screen">
        <img src="images/logo.jpg" alt="Logo">
        <br>
       
        <br>
        <!-- Adjusted Ump Hub text -->
        <span class="ump-hub-text" ;  >Ump Hub</span>
    </div>

    <script>
        // Redirect to login page after a delay
        setTimeout(function() {
            window.location.href = 'login.php'; // Adjust to your login page path
        }, 3000); // 3 seconds delay
    </script>
</body>
</html>
