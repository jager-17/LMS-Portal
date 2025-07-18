<?php
include 'db.php';  // Including the database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fetch user from the database
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        session_start();
        $_SESSION['user'] = $email;  // Set session
        header("Location: user_dashboard.php");  // Redirect to user dashboard
        exit; // Ensure script stops after redirection
    } else {
        echo "<p style='color: red;'>Invalid login credentials</p>"; // Display error message
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffecb3; /* Soft pastel yellow background */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Full height of the viewport */
            color: #333; /* Dark text color for contrast */
        }

        .container {
            background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent white background */
            padding: 40px; /* Inner padding */
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Soft shadow */
            width: 400px; /* Fixed width for the card */
            text-align: center; /* Center text inside the container */
        }

        h2 {
            margin-bottom: 20px; /* Space below the heading */
            color: #ff9800; /* Orange color for the heading */
        }

        input[type="email"],
        input[type="password"] {
            width: 100%; /* Full width for inputs */
            padding: 12px; /* Inner padding for inputs */
            margin: 10px 0; /* Margin above and below inputs */
            border: 1px solid #ccc; /* Light border */
            border-radius: 5px; /* Rounded corners for inputs */
            box-sizing: border-box; /* Include padding and border in element's total width */
        }

        button {
            background-color: #ff9800; /* Orange background for button */
            color: white; /* White text for button */
            padding: 12px; /* Inner padding for button */
            border: none; /* Remove border */
            border-radius: 5px; /* Rounded corners for button */
            cursor: pointer; /* Pointer cursor on hover */
            width: 100%; /* Full width for button */
            transition: background-color 0.3s; /* Smooth background transition */
            font-size: 16px; /* Increase button text size */
        }

        button:hover {
            background-color: #e68900; /* Darker orange on hover */
        }

        footer {
            position: absolute; /* Position footer at the bottom */
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 12px; /* Smaller text for footer */
            color: #777; /* Light gray text for footer */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form action="login.php" method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
    <footer>
        &copy; 2024 Bus Booking App. All rights reserved.
    </footer>
</body>
</html>
