<?php
include 'db.php';  // Including the database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Insert user into the database
    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
    if ($conn->query($sql) === TRUE) {
        // Redirect to login page after successful registration
        header("Location: login.php");
        exit; // Ensure script stops after redirection
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff; /* Soft light blue background color */
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
            color: #007bff; /* Blue color for the heading */
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%; /* Full width for inputs */
            padding: 10px; /* Inner padding for inputs */
            margin: 10px 0; /* Margin above and below inputs */
            border: 1px solid #ccc; /* Light border */
            border-radius: 5px; /* Rounded corners for inputs */
            box-sizing: border-box; /* Include padding and border in element's total width */
        }

        button {
            background-color: #007bff; /* Blue background for button */
            color: white; /* White text for button */
            padding: 10px; /* Inner padding for button */
            border: none; /* Remove border */
            border-radius: 5px; /* Rounded corners for button */
            cursor: pointer; /* Pointer cursor on hover */
            width: 100%; /* Full width for button */
            transition: background-color 0.3s; /* Smooth background transition */
        }

        button:hover {
            background-color: #0056b3; /* Darker blue on hover */
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
        <h2>Register</h2>
        <form action="register.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Register</button>
        </form>
    </div>
    <footer>
        &copy; 2024 Bus Booking App. All rights reserved.
    </footer>
</body>
</html>
