<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Management System</title>
    <style>
        /* Basic reset for consistent look across browsers */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: url('https://images.pexels.com/photos/258154/pexels-photo-258154.jpeg?cs=srgb&dl=pexels-pixabay-258154.jpg&fm=jpg') no-repeat center center/cover; /* Replace with a hotel-related image */
            color: #333;
        }

        .container {
            text-align: center;
            background-color: rgba(255, 255, 255, 0.85); /* Semi-transparent background to make text stand out */
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            width: 50%;
        }

        h1 {
            font-size: 36px;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        .buttons {
            margin-top: 30px;
        }

        a {
            text-decoration: none;
            display: inline-block;
            margin: 10px;
            padding: 12px 25px;
            background-color: #3498db;
            color: white;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: #2980b9;
        }

        /* Mobile responsiveness */
        @media (max-width: 768px) {
            .container {
                width: 80%;
            }

            h1 {
                font-size: 28px;
            }

            a {
                font-size: 14px;
                padding: 10px 20px;
            }
        }

        /* Animation for better user interaction */
        a:active {
            transform: scale(0.98);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to Hotel Management System</h1>
        <div class="buttons">
            <a href="register.php">Register</a>
            <a href="login.php">Login</a>
        </div>
    </div>
</body>
</html>
