<?php
session_start();
require 'db_connection.php'; // Include your database connection

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login if not logged in
    exit();
}

// Fetch user bookings
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT b.id, h.name AS hotel_name, b.room_type, b.price, b.booking_date 
                         FROM bookings b 
                         JOIN hotels h ON b.hotel_id = h.id 
                         WHERE b.user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Fetch bookings
$bookings = [];
while ($row = $result->fetch_assoc()) {
    $bookings[] = $row;
}

// Close the statement
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Profile</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            display: flex;
            flex-direction: column;
            align-items: center; /* Centering items in the column */
            justify-content: flex-start;
            min-height: 100vh;
            background-image: url('https://images.pexels.com/photos/53464/sheraton-palace-hotel-lobby-architecture-san-francisco-53464.jpeg?cs=srgb&dl=pexels-pixabay-53464.jpg&fm=jpg'); /* Add your hotel background image */
            background-size: cover;
            background-position: center;
        }

        .profile-box {
            width: 100%;
            background-color: #333;
            color: white;
            text-align: center;
            padding: 20px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        .profile-box h1 {
            margin: 0;
            font-size: 36px;
            letter-spacing: 3px;
            text-transform: uppercase;
        }

        .container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 800px;
            text-align: center;
            margin-top: 40px; /* Spacing from the top heading */
        }

        h2 {
            font-size: 24px;
            color: #555;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 auto; /* Centering the table */
        }

        table th, table td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: center;
            font-size: 16px;
        }

        table th {
            background-color: #333;
            color: white;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        p {
            font-size: 18px;
            margin-top: 20px;
        }

        a {
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            color: white;
            background-color: #28a745;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-transform: uppercase;
            font-size: 16px;
        }

        .btn:hover {
            background-color: #218838;
        }

        .btn-logout {
            background-color: #dc3545;
        }

        .btn-logout:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <!-- Profile Header -->
    <div class="profile-box">
        <h1>Your Profile</h1>
    </div>

    <!-- Main Container with User Booking Details -->
    <div class="container">
        <h2>Your Bookings</h2>

        <?php if (count($bookings) > 0): ?>
            <table>
                <tr>
                    <th>Booking ID</th>
                    <th>Hotel Name</th>
                    <th>Room Type</th>
                    <th>Total Price</th>
                    <th>Booking Date</th>
                </tr>
                <?php foreach ($bookings as $booking): ?>
                    <tr>
                        <td><?php echo $booking['id']; ?></td>
                        <td><?php echo $booking['hotel_name']; ?></td>
                        <td><?php echo $booking['room_type']; ?></td>
                        <td><?php echo '$' . number_format($booking['price'], 2); ?></td>
                        <td><?php echo $booking['booking_date']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>No bookings found.</p>
        <?php endif; ?>

        <a href="hotel.php" class="btn">View Available Hotels</a>
        <a href="logout.php" class="btn btn-logout">Logout</a>
    </div>
</body>
</html>

<?php
// Close the database connection at the end of the script
$conn->close();
?>
