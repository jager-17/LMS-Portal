<?php
session_start();
include 'db.php';  // Including the database connection

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['user'];

// Fetch user details
$user_query = $conn->query("SELECT * FROM users WHERE email='$email'");
$user = $user_query->fetch_assoc();

// Get the bus ID from the URL
$bus_id = $_GET['bus_id'];

// Insert booking into the database
$sql = "INSERT INTO bookings (user_id, bus_id) VALUES ('{$user['id']}', '$bus_id')";
if ($conn->query($sql)) {
    // Redirect back to the dashboard after booking
    header("Location: user_dashboard.php");
} else {
    echo "Error booking the bus: " . $conn->error;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Booking Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9; /* Light gray background */
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh; /* Full height of viewport */
            color: #333; /* Dark text color */
        }

        .container {
            background-color: #ffffff; /* White background for container */
            padding: 40px; /* Padding inside the container */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); /* Soft shadow */
            width: 100%;
            max-width: 500px; /* Max width for larger screens */
            text-align: center; /* Center align text */
        }

        h1 {
            margin-bottom: 20px; /* Space below heading */
            font-size: 24px; /* Larger font size for heading */
            color: #007BFF; /* Blue color for heading */
        }

        p {
            margin: 10px 0; /* Margin above and below paragraphs */
            font-size: 18px; /* Font size for paragraphs */
            color: #555; /* Darker gray for text */
        }

        .button {
            background-color: #007BFF; /* Blue background for button */
            color: white; /* White text */
            padding: 10px 20px; /* Padding inside button */
            border: none; /* No border */
            border-radius: 5px; /* Rounded corners */
            cursor: pointer; /* Pointer cursor on hover */
            font-size: 16px; /* Font size for button */
            text-decoration: none; /* No underline */
            transition: background-color 0.3s; /* Transition effect */
        }

        .button:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }

        footer {
            margin-top: 20px; /* Space above footer */
            font-size: 12px; /* Smaller font for footer */
            color: #777; /* Light gray for footer */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Booking Confirmation</h1>
        <p>Thank you for booking your bus!</p>
        <p>You will receive a confirmation email shortly.</p>
        <a href="user_dashboard.php" class="button">Back to Dashboard</a>
    </div>

    <footer>
        &copy; 2024 Bus Booking App. All rights reserved.
    </footer>
</body>
</html>
