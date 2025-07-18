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

// Fetch available buses
$bus_query = $conn->query("SELECT * FROM buses");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffecb3; /* Soft pastel yellow background */
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start; /* Align items to the top */
            height: 100vh; /* Full height of the viewport */
            color: #333; /* Dark text color for contrast */
            overflow-x: hidden; /* Prevent horizontal scrolling */
        }

        .welcome-container {
            position: sticky; /* Sticky position for the welcome message */
            top: 0; /* Stick to the top */
            background-color: #ff9800; /* Orange background */
            color: white; /* White text */
            width: 100%; /* Full width */
            padding: 20px; /* Padding for the welcome box */
            text-align: center; /* Center the text */
            z-index: 100; /* Ensure it's above other content */
        }

        .content-container {
            flex: 1; /* Take remaining space */
            display: flex;
            flex-direction: column; /* Column layout for content */
            overflow-y: auto; /* Allow vertical scrolling */
            padding: 20px; /* Padding for content */
            box-sizing: border-box; /* Include padding in width calculation */
            width: 100%; /* Full width for content */
            max-width: 800px; /* Maximum width for larger screens */
        }

        .container {
            background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent white background */
            padding: 20px; /* Inner padding */
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Soft shadow */
            width: 100%; /* Full width for inner container */
            margin-bottom: 20px; /* Space below the container */
        }

        h1 {
            margin: 0; /* Remove default margin */
        }

        h2 {
            margin-top: 20px; /* Add margin to headings */
            text-align: center; /* Center the text */
        }

        .buses-container {
            max-height: 300px; /* Fixed height for the buses section */
            overflow-y: auto; /* Enable vertical scrolling */
            margin-top: 20px; /* Space above the buses container */
        }

        table {
            width: 100%; /* Full width for the table */
            border-collapse: collapse; /* Remove space between borders */
        }

        th, td {
            padding: 12px; /* Inner padding for table cells */
            border: 1px solid #ccc; /* Light border for cells */
            text-align: left; /* Left align text in cells */
        }

        th {
            background-color: #ff9800; /* Orange background for table header */
            color: white; /* White text for table header */
        }

        tr:nth-child(even) {
            background-color: #f2f2f2; /* Light gray for even rows */
        }

        tr:hover {
            background-color: #ddd; /* Darker gray on row hover */
        }

        .view-bookings {
            background-color: #cfd8dc; /* Light gray-blue background for bookings box */
            padding: 20px; /* Inner padding */
            border-radius: 10px; /* Rounded corners */
            margin-top: 20px; /* Space above bookings box */
            display: flex; /* Use flexbox to center content */
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
        }

        a {
            text-decoration: none; /* Remove underline from links */
            color: #ff9800; /* Orange color for links */
            font-weight: bold; /* Bold font for links */
        }

        a:hover {
            text-decoration: underline; /* Underline on hover */
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
    <div class="welcome-container">
        <h1>Welcome, <?php echo htmlspecialchars($user['username']); ?></h1>
    </div>

    <div class="content-container">
        <div class="container">
            <h2>Available Buses</h2>
            <div class="buses-container">
                <table>
                    <tr>
                        <th>Bus Name</th>
                        <th>Source</th>
                        <th>Destination</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                    <?php while ($bus = $bus_query->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($bus['bus_name']); ?></td>
                        <td><?php echo htmlspecialchars($bus['source']); ?></td>
                        <td><?php echo htmlspecialchars($bus['destination']); ?></td>
                        <td><?php echo htmlspecialchars($bus['price']); ?></td>
                        <td><a href="book_bus.php?bus_id=<?php echo $bus['id']; ?>">Book</a></td>
                    </tr>
                    <?php endwhile; ?>
                </table>
            </div>
        </div>

        <div class="container view-bookings">
            <h2>Your Bookings</h2>
            <p><a href="view_bookings.php">View your bookings</a></p>
        </div>
    </div>
    
    <footer>
        &copy; 2024 Bus Booking App. All rights reserved.
    </footer>
</body>
</html>
