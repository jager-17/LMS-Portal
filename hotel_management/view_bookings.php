<?php
session_start();
require('db_connection.php');

if (!isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit();
}

// Fetch user bookings
$user_email = $_SESSION['user_email'];
$query = "SELECT b.id, h.name, h.room_type, h.price FROM bookings b JOIN hotels h ON b.hotel_id = h.id WHERE b.user_email = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();
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
            margin: 0;
            padding: 0;
            background-image: url('hotel_background.jpg'); /* Add your background image here */
            background-size: cover;
            background-position: center;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.9); /* Slightly transparent white */
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
            width: 90%;
            max-width: 800px;
            text-align: center;
        }

        h1 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #4CAF50; /* Green color */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50; /* Green background */
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2; /* Light gray for even rows */
        }

        tr:hover {
            background-color: #ddd; /* Light gray on hover */
        }

        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4CAF50; /* Green button */
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        a:hover {
            background-color: #45a049; /* Darker green on hover */
        }

        @media (max-width: 600px) {
            h1 {
                font-size: 24px; /* Smaller font on small screens */
            }

            th, td {
                padding: 10px; /* Adjust padding for smaller screens */
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Your Bookings</h1>
        <table>
            <tr>
                <th>Booking ID</th>
                <th>Hotel Name</th>
                <th>Room Type</th>
                <th>Price</th>
            </tr>
            <?php while ($booking = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $booking['id']; ?></td>
                    <td><?php echo $booking['name']; ?></td>
                    <td><?php echo $booking['room_type']; ?></td>
                    <td>$<?php echo number_format($booking['price'], 2); ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
        <a href="user_dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>
