<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Booking App</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('https://static.vecteezy.com/system/resources/previews/029/305/778/non_2x/moving-forward-bus-travels-on-road-embracing-travel-time-ambiance-ai-generated-photo.jpg'); /* Background image */
            background-size: cover; /* Cover the entire viewport */
            background-position: center; /* Center the background image */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Full height of the viewport */
            color: white; /* White text color for contrast */
        }

        .container {
            text-align: center; /* Centered text */
            background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white background for better readability */
            padding: 40px; /* Inner padding */
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Soft shadow */
            width: 400px; /* Fixed width for the card */
        }

        h1 {
            color: #333; /* Darker text color */
            margin-bottom: 20px; /* Space below the heading */
        }

        a {
            text-decoration: none; /* Remove underline from links */
            color: #007bff; /* Link color */
            margin: 0 10px; /* Margins on left and right */
            font-weight: bold; /* Bold links */
            transition: color 0.3s; /* Smooth color transition */
        }

        a:hover {
            color: #0056b3; /* Darker blue on hover */
        }

        footer {
            position: absolute; /* Position footer at the bottom */
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 12px; /* Smaller text for footer */
            color: #fff; /* Light gray text for footer */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to the Bus Booking App</h1>
        <a href="register.php">Register</a> | <a href="login.php">Login</a>
    </div>
    <footer>
        &copy; 2024 Bus Booking App. All rights reserved.
    </footer>
</body>
</html>
