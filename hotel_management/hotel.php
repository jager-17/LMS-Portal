<?php
// hotel.php

// Include the database connection
require 'db_connection.php';

// Fetch all hotels from the database
$result = $conn->query("SELECT * FROM hotels");

// Fetch hotels into an associative array
$hotels = $result->fetch_all(MYSQLI_ASSOC);

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Hotels</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('https://e0.pxfuel.com/wallpapers/662/265/desktop-wallpaper-luxury-hotel-room-hotels.jpg'); /* Add your background image here */
            background-size: cover;
            background-position: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            color: #333;
        }

        h1 {
            text-align: center;
            font-size: 36px;
            margin-bottom: 20px;
            text-transform: uppercase;
            color: #fff;
            background-color: rgba(0, 0, 0, 0.7); /* Background for contrast */
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.5);
        }

        .container {
            background-color: rgba(255, 255, 255, 0.9); /* Slightly transparent white */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            width: 80%;
            max-width: 900px;
            margin: 20px auto; /* Centering the container */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: center;
        }

        table th {
            background-color: #4CAF50; /* Green header */
            color: white;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2; /* Light grey for even rows */
        }

        table tr:hover {
            background-color: #d1e7dd; /* Light green on hover */
        }

        a {
            color: #007BFF;
            text-decoration: none;
            font-weight: bold;
            padding: 5px 10px;
            border: 1px solid #007BFF;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        a:hover {
            background-color: #007BFF;
            color: white;
        }

        @media (max-width: 600px) {
            h1 {
                font-size: 28px; /* Smaller font on small screens */
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Available Hotels</h1>
        <table>
            <thead>
                <tr>
                    <th>Hotel Name</th>
                    <th>Room Types</th>
                    <th>Prices</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($hotels as $hotel): ?>
                    <tr>
                        <td><?php echo $hotel['name']; ?></td>
                        <td><?php echo $hotel['room_type']; ?></td>
                        <td><?php echo '$' . number_format($hotel['price'], 2); ?></td>
                        <td>
                            <a href="book.php?hotel_id=<?php echo $hotel['id']; ?>">Book Now</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
