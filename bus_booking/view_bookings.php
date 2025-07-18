<?php
session_start();
include 'db.php';  // Including the database connection

// Ensure the user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['user'];

// Fetch user details
$user_query = $conn->query("SELECT * FROM users WHERE email='$email'");
$user = $user_query->fetch_assoc();

// Fetch user's booking history
$booking_query = $conn->query("SELECT bookings.*, buses.bus_name, buses.source, buses.destination 
                                FROM bookings 
                                JOIN buses ON bookings.bus_id = buses.id 
                                WHERE bookings.user_id = '{$user['id']}'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Bookings</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4; /* Light background for contrast */
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            max-width: 800px; /* Max width for the content */
            margin: 30px auto; /* Centering the container */
            padding: 20px; /* Inner padding for the container */
            background-color: #fff; /* White background for content area */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Soft shadow */
        }

        h1 {
            text-align: center; /* Center the heading */
            color: #007BFF; /* Blue color for heading */
        }

        table {
            width: 100%; /* Full width for the table */
            border-collapse: collapse; /* Merge table borders */
            margin-top: 20px; /* Space above the table */
        }

        th, td {
            border: 1px solid #ddd; /* Light border for table cells */
            padding: 12px; /* Padding inside cells */
            text-align: left; /* Align text to the left */
        }

        th {
            background-color: #007BFF; /* Blue background for header */
            color: white; /* White text for header */
        }

        tr:nth-child(even) {
            background-color: #f9f9f9; /* Light gray background for even rows */
        }

        tr:hover {
            background-color: #f1f1f1; /* Light gray background on row hover */
        }

        .button {
            display: block; /* Block display for centering */
            width: 200px; /* Fixed width for button */
            margin: 20px auto; /* Centering button */
            padding: 10px; /* Padding for button */
            background-color: #007BFF; /* Blue background for button */
            color: white; /* White text for button */
            text-align: center; /* Center text */
            text-decoration: none; /* No underline */
            border-radius: 5px; /* Rounded corners */
            transition: background-color 0.3s; /* Transition effect */
        }

        .button:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }

        .no-bookings {
            text-align: center; /* Center the no bookings message */
            font-style: italic; /* Italics for emphasis */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Your Bookings</h1>

        <table>
            <tr>
                <th>Bus Name</th>
                <th>Source</th>
                <th>Destination</th>
                <th>Booking Time</th>
            </tr>
            <?php if ($booking_query->num_rows > 0): ?>
                <?php while ($booking = $booking_query->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $booking['bus_name']; ?></td>
                    <td><?php echo $booking['source']; ?></td>
                    <td><?php echo $booking['destination']; ?></td>
                    <td><?php echo $booking['created_at']; ?></td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="no-bookings">No bookings found.</td>
                </tr>
            <?php endif; ?>
        </table>

        <a href="user_dashboard.php" class="button">Back to Dashboard</a>
    </div>
</body>
</html>
