<?php
// book.php

session_start();
require 'db_connection.php'; // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get hotel details from the form
    $hotel_id = $_POST['hotel_id'];
    $room_type = $_POST['room_type'];
    $price = $_POST['price'];
    $user_id = $_SESSION['user_id']; // Assuming you store user ID in session
    $user_email = $_SESSION['user_email']; // Assuming you store user email in session

    // Insert booking into the database
    $stmt = $conn->prepare("INSERT INTO bookings (user_id, hotel_id, room_type, price, booking_date, user_email) VALUES (?, ?, ?, ?, NOW(), ?)");
    $stmt->bind_param("iisss", $user_id, $hotel_id, $room_type, $price, $user_email);

    // Execute the statement
    if ($stmt->execute()) {
        $booking_message = "Booking successful!";
    } else {
        $booking_message = "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
    
    // Display booking message and options
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Booking Confirmation</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-image: url('https://e0.pxfuel.com/wallpapers/283/288/desktop-wallpaper-stunning-sunset-in-thailand-across-ocean-island-tropical-sun-set-indonesia-dusk-beach-lodge-sun-ocean-sunset-sea-thailand-luxury-exotic-hotel-paradise-lagoon-retreat-apartment-asia.jpg');
                background-size: cover;
                background-position: center;
                display: flex;
                align-items: center;
                justify-content: center;
                min-height: 100vh;
                color: #333;
            }

            .confirmation-container {
                background-color: rgba(255, 255, 255, 0.9); /* Slightly transparent white */
                padding: 40px;
                border-radius: 15px;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
                width: 90%;
                max-width: 600px;
                text-align: center;
            }

            h1 {
                font-size: 28px;
                margin-bottom: 20px;
                color: #4CAF50; /* Green color */
            }

            p {
                font-size: 18px;
                margin: 10px 0;
            }

            a {
                color: #4CAF50;
                text-decoration: none;
                font-weight: bold;
            }

            a:hover {
                text-decoration: underline;
            }

            @media (max-width: 600px) {
                h1 {
                    font-size: 24px; /* Smaller font on small screens */
                }

                p {
                    font-size: 16px; /* Adjust paragraph font size */
                }
            }
        </style>
    </head>
    <body>
        <div class='confirmation-container'>
            <h1>$booking_message</h1>
            <p><a href='user_dashboard.php'>Return to Dashboard</a></p>
            <p><a href='hotel.php'>View Available Hotels</a></p>
        </div>
    </body>
    </html>";
    
    exit();
}

// Fetch hotel information to show in the booking form
if (isset($_GET['hotel_id'])) {
    $hotel_id = $_GET['hotel_id'];
    $stmt = $conn->prepare("SELECT * FROM hotels WHERE id = ?");
    $stmt->bind_param("i", $hotel_id);
    $stmt->execute();
    $hotel = $stmt->get_result()->fetch_assoc();
    $stmt->close();
} else {
    // Handle error: hotel_id not provided
    die("Invalid hotel selected.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Hotel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('https://e0.pxfuel.com/wallpapers/283/288/desktop-wallpaper-stunning-sunset-in-thailand-across-ocean-island-tropical-sun-set-indonesia-dusk-beach-lodge-sun-ocean-sunset-sea-thailand-luxury-exotic-hotel-paradise-lagoon-retreat-apartment-asia.jpg');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            color: #333;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.9); /* Slightly transparent white */
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
            width: 90%;
            max-width: 600px;
            text-align: center;
        }

        h1 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #4CAF50; /* Green color */
        }

        p {
            font-size: 18px;
            margin: 10px 0;
        }

        input[type="submit"] {
            background-color: #4CAF50; /* Green background */
            color: white;
            border: none;
            padding: 15px 25px;
            font-size: 18px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #45a049; /* Darker green on hover */
        }

        @media (max-width: 600px) {
            h1 {
                font-size: 24px; /* Smaller font on small screens */
            }

            p {
                font-size: 16px; /* Adjust paragraph font size */
            }

            input[type="submit"] {
                font-size: 16px; /* Adjust button font size */
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Booking Details for <?php echo $hotel['name']; ?></h1>
        <form action="" method="POST">
            <input type="hidden" name="hotel_id" value="<?php echo $hotel['id']; ?>">
            <input type="hidden" name="room_type" value="<?php echo $hotel['room_type']; ?>">
            <input type="hidden" name="price" value="<?php echo $hotel['price']; ?>">
            <p>Room Type: <?php echo $hotel['room_type']; ?></p>
            <p>Price: $<?php echo number_format($hotel['price'], 2); ?></p>
            <input type="submit" value="Confirm Booking">
        </form>
    </div>
</body>
</html>
