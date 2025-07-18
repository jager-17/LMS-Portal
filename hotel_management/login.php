<?php
session_start();

// Include the database connection
require 'db_connection.php'; // Ensure this path is correct

// Error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);

    // Execute the statement
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists
    if ($result->num_rows > 0) {
        // User found, start the session
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        header("Location: user_dashboard.php");
        exit();
    } else {
        echo "Invalid email or password.";
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        /* Basic reset for consistent look across browsers */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: url('https://images.pexels.com/photos/1001965/pexels-photo-1001965.jpeg?cs=srgb&dl=pexels-osho-1001965.jpg&fm=jpg') no-repeat center center/cover; /* Add your background image path */
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-size: cover;
        }

        .login-container {
            background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent background */
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        h1 {
            font-size: 28px;
            color: #333;
            margin-bottom: 20px;
            text-shadow: 1px 1px 2px #ccc;
        }

        label {
            display: block;
            text-align: left;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            background-color: #f9f9f9;
        }

        input[type="email"]:focus, input[type="password"]:focus {
            border-color: #3498db;
            outline: none;
            box-shadow: 0 0 8px rgba(52, 152, 219, 0.2);
        }

        button[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #2980b9;
        }

        a {
            display: block;
            margin-top: 20px;
            text-decoration: none;
            color: #3498db;
            font-size: 14px;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Responsive design for mobile */
        @media (max-width: 768px) {
            .login-container {
                padding: 20px;
                max-width: 90%;
            }

            h1 {
                font-size: 24px;
            }

            input[type="email"], input[type="password"], button[type="submit"] {
                font-size: 14px;
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>
        <form action="" method="POST">
            <label for="email">Email:</label>
            <input type="email" name="email" placeholder="Enter your email" required>
            
            <label for="password">Password:</label>
            <input type="password" name="password" placeholder="Enter your password" required>
            
            <button type="submit">Login</button>
        </form>
        <a href="register.php">Don't have an account? Register</a>
    </div>
</body>
</html>
