<?php
    session_start();

    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        header('Location: ./index.php');
        exit;
    }

    session_destroy(); // Destroy the session to log the user out
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UNAUTHORIZED ACCESS!</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #021526;
            color: #6EACDA;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            text-align: center;
            flex-direction: column;
        }

        .container {
            padding: 20px;
            border: 1px solid #6EACDA;
            background-color: #021526;
            border-radius: 5px;
            max-width: 400px;
            width: 100%;
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        p {
            font-size: 1.25rem;
        }

        .redirect-message {
            margin-top: 20px;
            font-size: 1rem;
            color: #E2E2B6;
        }

        .redirect-message a {
            color: #E2E2B6;
            text-decoration: none;
        }

        /* Spinner Styling */
        .spinner-container {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }

        .spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #6EACDA;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 2s linear infinite;
        }

        /* Spinner animation */
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Unauthorized Access!</h1>
        <p>Your session has expired or you do not have permission to access this page.</p>
        
        <!-- Countdown message -->
        <div class="redirect-message">
            <p>You will be redirected to the homepage in <span id="countdown">5</span> seconds. If not, click <a href="../../index.php">here</a>.</p>
        </div>

        <!-- Spinner -->
        <div class="spinner-container">
            <div class="spinner"></div>
        </div>
    </div>

    <!-- Countdown Timer and Redirect -->
    <script>
        var countdownElement = document.getElementById("countdown");
        var countdownTime = 5; // Countdown in seconds

        // Update countdown every second
        var countdownInterval = setInterval(function() {
            countdownElement.innerHTML = countdownTime;
            countdownTime--;

            if (countdownTime < 0) {
                clearInterval(countdownInterval); // Clear the interval once the countdown is complete
                window.location.href = "./index.php";  // Redirect to homepage
            }
        }, 1000); // Update every second (1000ms)
    </script>

</body>
</html>
