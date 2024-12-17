<?php
session_start();  // Start a session to keep track of the admin's logged-in status

// Predefined admin credentials
$admin_username = "anupam";
$admin_password = "1234";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the credentials match
    if ($username == $admin_username && $password == $admin_password) {
        $_SESSION['admin_logged_in'] = true;  // Set session variable
        header("Location: admin_dashboard.php");  // Redirect to the admin dashboard
        exit();
    } else {
        $error_message = "Invalid credentials.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        /* Global Styling */
        body {
            font-family: 'Arial', sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #e3f2fd;
        }

        .container {
            width: 100%;
            max-width: 400px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.1);
            padding: 40px;
            text-align: center;
        }

        h2 {
            margin-bottom: 30px;
            color: #007BFF;
            font-size: 28px;
        }

        p {
            color: red;
            font-size: 16px;
            font-weight: bold;
        }

        form {
            width: 100%;
        }

        label {
            font-size: 16px;
            color: #333;
            margin-bottom: 8px;
            display: block;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
            color: #333;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            padding: 14px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }
            h2 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Admin Login</h2>

        <?php if (isset($error_message)) { echo "<p>$error_message</p>"; } ?>

        <form action="admin_login.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Login">
        </form>
    </div>

</body>
</html>
