<?php
include 'db.php';  // Include database connection

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);  // Hash the password
    $email = $_POST['email'];
    $favorite_plant = $_POST['favorite_plant'];

    // Check if the username or email already exists
    $check_query = "SELECT * FROM users WHERE username='$username' OR email='$email'";
    $result = $conn->query($check_query);

    if ($result->num_rows > 0) {
        $error_message = "Username or email already exists.";
    } else {
        // Insert user data into the database
        $query = "INSERT INTO users (username, password, email, favorite_plant) 
                  VALUES ('$username', '$password', '$email', '$favorite_plant')";
        if ($conn->query($query) === TRUE) {
            $success_message = "Registration successful!";
        } else {
            $error_message = "Error: " . $query . "<br>" . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - My Website</title>
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

        /* Styling for the 'Already have an account?' text */
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
    <script>
        // Show pop-up message after registration
        <?php if (isset($success_message)): ?>
            alert("<?php echo $success_message; ?>");
        <?php endif; ?>
        
        <?php if (isset($error_message)): ?>
            alert("<?php echo $error_message; ?>");
        <?php endif; ?>
    </script>
</head>
<body>

    <div class="form-container">
        <h2>Register</h2>

        <!-- Registration Form -->
        <form action="register.php" method="POST">
            <input type="text" name="username" placeholder="Enter your username" required>
            <input type="password" name="password" placeholder="Enter your password" required>
            <input type="email" name="email" placeholder="Enter your email" required>
            <input type="text" name="favorite_plant" placeholder="Enter your favorite plant" required>

            <button type="submit">Register</button>
        </form>

        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>

</body>
</html>
