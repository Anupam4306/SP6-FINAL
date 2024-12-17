<?php
session_start();  // Start the session

// Check if the admin is logged in, otherwise redirect to login page
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

include 'db.php';  // Include database connection

// Check if the user ID is provided in the URL
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Fetch the user's details from the database
    $sql = "SELECT * FROM users WHERE id = $user_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "User not found.";
        exit();
    }
} else {
    echo "No user ID provided.";
    exit();
}

// Update the user's details if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $favorite_plant = $_POST['favorite_plant'];

    // Update the user details in the database
    $update_query = "UPDATE users SET username='$username', email='$email', favorite_plant='$favorite_plant' WHERE id=$user_id";

    if ($conn->query($update_query) === TRUE) {
        echo "User details updated successfully!";
        header("Location: admin_dashboard.php");  // Redirect back to the dashboard after update
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <style>
        /* Global Body Styling */
        body {
            font-family: 'Roboto', sans-serif;
            background: #f1f1f1;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Container for the whole page */
        .container {
            width: 100%;
            max-width: 1200px; /* Max width for the page */
            padding: 0 20px;
            box-sizing: border-box;
            margin-top: 50px;
        }

        /* Heading Styling */
        h2 {
            text-align: center;
            font-size: 36px;
            color: #2C3E50;
        }

        /* Form Styling */
        form {
            width: 100%;
            max-width: 500px; /* Max width of the form */
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
        }

        /* Label Styling */
        label {
            font-size: 16px;
            color: #333;
            margin-bottom: 5px;
        }

        /* Input Field Styling */
        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
            color: #333;
        }

        /* Submit Button Styling */
        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #2980b9;
        }

        /* Link Styling */
        p {
            text-align: center;
            margin-top: 20px;
        }

        p a {
            font-size: 16px;
            color: #3498db;
            text-decoration: none;
        }

        p a:hover {
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 800px) {
            .container {
                padding: 0 10px; /* Add padding to the container for smaller screens */
            }

            form {
                width: 90%; /* Make form width responsive on smaller screens */
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Edit User</h2>

        <form action="edit_user.php?id=<?php echo $user_id; ?>" method="POST">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" value="<?php echo $user['username']; ?>" required><br><br>

            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required><br><br>

            <label for="favorite_plant">Favorite Plant:</label><br>
            <input type="text" id="favorite_plant" name="favorite_plant" value="<?php echo $user['favorite_plant']; ?>" required><br><br>

            <input type="submit" value="Update">
        </form>

        <p><a href="admin_dashboard.php">Back to Dashboard</a></p>
    </div>

</body>
</html>
