<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database connection
include 'db_connection.php';

// Initialize variables
$name = $email = $password = $confirm_password = '';
$errors = [];

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Validate input
    if (empty($name)) {
        $errors[] = "Name is required.";
    }
    if (empty($email)) {
        $errors[] = "Email is required.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }
    if (empty($password)) {
        $errors[] = "Password is required.";
    }
    if ($password != $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    // Check if there are no errors
    if (empty($errors)) {
        // Prepare SQL query
        $sql = "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, 'user')";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            // Bind parameters
            $stmt->bind_param("sss", $name, $email, $password); // Use hashed password if hashed
            
            // Execute the statement
            if ($stmt->execute()) {
                // Redirect to the login page after successful registration
                header("Location: login.php");
                exit(); // Always exit after a header redirect
            } else {
                echo "<div class='error-msg'>Error: " . $stmt->error . "</div>";
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "<div class='error-msg'>Error: " . $conn->error . "</div>";
        }
    } else {
        // Show errors
        foreach ($errors as $error) {
            echo "<div class='error-msg'>$error</div>";
        }
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
        /* Basic reset for consistent look across browsers */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-image: url('https://images8.alphacoders.com/359/thumb-1920-359907.jpg'); /* Add your background image here */
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
            position: relative;
        }

        .container {
            width: 40%;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9); /* Slightly transparent white */
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            z-index: 1;
        }

        .form-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-header h2 {
            font-size: 28px;
            color: #4CAF50; /* Green color */
        }

        table {
            width: 100%;
        }

        table tr td {
            padding: 10px;
        }

        table tr td:first-child {
            text-align: right;
            padding-right: 20px;
        }

        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error-msg {
            color: #ff6b6b;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .success-msg {
            color: #4CAF50;
            margin-bottom: 15px;
            font-size: 16px;
        }

        @media (max-width: 768px) {
            .container {
                width: 80%;
            }
        }

        /* Add a slight overlay for better text visibility */
        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.4);
            z-index: 0; /* Set behind the container */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-header">
            <h2>Register</h2>
        </div>

        <form action="register.php" method="post">
            <table>
                <tr>
                    <td><label for="name">Name:</label></td>
                    <td><input type="text" name="name" id="name" value="<?php echo htmlspecialchars($name); ?>" required></td>
                </tr>
                <tr>
                    <td><label for="email">Email:</label></td>
                    <td><input type="email" name="email" id="email" value="<?php echo htmlspecialchars($email); ?>" required></td>
                </tr>
                <tr>
                    <td><label for="password">Password:</label></td>
                    <td><input type="password" name="password" id="password" required></td>
                </tr>
                <tr>
                    <td><label for="confirm_password">Confirm Password:</label></td>
                    <td><input type="password" name="confirm_password" id="confirm_password" required></td>
                </tr>
            </table>
            <input type="submit" value="Register">
        </form>
    </div>
</body>
</html>
