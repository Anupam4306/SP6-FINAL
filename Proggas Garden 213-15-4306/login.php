<?php
include 'db.php';  // Include database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username_or_email = $_POST['username_or_email'];
    $password = $_POST['password'];

    // Check if the input is a username or email
    $query = "SELECT * FROM users WHERE username='$username_or_email' OR email='$username_or_email'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            echo "Login successful!";
            // Redirect to the user's dashboard or home page
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with that username or email.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        /* Global Body Styling */
        body {
            font-family: 'Roboto', sans-serif;
            background: #f1f1f1; /* Light background for a clean look */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            overflow: hidden;
        }

        /* Form Container Styling */
        .form-container {
            width: 100%;
            max-width: 480px;
            padding: 40px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0px 20px 40px rgba(0, 0, 0, 0.1);
            position: relative;
            animation: slideIn 0.8s ease-out;
            box-sizing: border-box;
        }

        /* Animation for form */
        @keyframes slideIn {
            0% {
                transform: translateY(-50px);
                opacity: 0;
            }
            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        h2 {
            text-align: center;
            font-size: 30px;
            color: #2C3E50;
            margin-bottom: 30px;
        }

        /* Input fields styling */
        input[type="text"],
        input[type="password"],
        input[type="email"],
        input[type="text"] {
            width: 100%;
            padding: 14px;
            margin-bottom: 20px;
            border-radius: 10px;
            border: 2px solid #ccc;
            font-size: 16px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            box-sizing: border-box;
        }

        input[type="text"]:focus,
        input[type="password"]:focus,
        input[type="email"]:focus {
            border-color: #3498db;
            box-shadow: 0 0 8px rgba(52, 152, 219, 0.4);
            outline: none;
        }

        /* Button Styling */
        button {
            width: 100%;
            padding: 15px;
            background: linear-gradient(45deg, #3498db, #8e44ad);
            border: none;
            color: white;
            font-size: 18px;
            font-weight: bold;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.1);
        }

        button:hover {
            background: linear-gradient(45deg, #2980b9, #9b59b6);
            box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.15);
            transform: translateY(-2px);
        }

        button:active {
            background: linear-gradient(45deg, #2980b9, #9b59b6);
            transform: translateY(2px);
        }

        /* Success and Error Messages */
        .error-message,
        .success-message {
            padding: 10px;
            text-align: center;
            margin-top: 20px;
            border-radius: 8px;
            font-weight: bold;
        }

        .error-message {
            background-color: #f8d7da;
            color: #721c24;
        }

        .success-message {
            background-color: #d4edda;
            color: #155724;
        }

        /* Styling for the 'Don't have an account?' text */
        p {
            font-size: 16px;
            margin-top: 15px;
            text-align: center;
            color: #555;
        }

        a {
            color: #3498db;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #2980b9;
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            .form-container {
                padding: 20px;
                max-width: 90%;
            }
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h2>Login</h2>

        <!-- Login Form -->
        <form action="login.php" method="POST">
            <input type="text" name="username_or_email" placeholder="Enter your username or email" required>
            <input type="password" name="password" placeholder="Enter your password" required>

            <button type="submit">Login</button>
        </form>

        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </div>

</body>
</html>
