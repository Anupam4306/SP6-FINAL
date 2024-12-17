<?php
session_start();  // Start the session

// Check if the admin is logged in, otherwise redirect to login page
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

include 'db.php';  // Include database connection

// Delete user if 'delete' button is clicked
if (isset($_GET['delete'])) {
    $user_id = $_GET['delete'];
    $delete_query = "DELETE FROM users WHERE id = $user_id";
    if ($conn->query($delete_query) === TRUE) {
        echo "User deleted successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Fetch all users from the database
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
            overflow: hidden;
        }

        h2 {
            text-align: center;
            font-size: 36px;
            color: #2C3E50;
            margin-top: 50px;
        }

        /* Table Styling */
        table {
            width: 80%;
            margin-top: 30px;
            border-collapse: collapse;
            background-color: #ffffff;
            box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        th, td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #3498db;
            color: white;
            font-size: 18px;
        }

        td {
            font-size: 16px;
            color: #333;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        /* Action Buttons Styling */
        a {
            color: #3498db;
            text-decoration: none;
            font-weight: bold;
            padding: 5px 10px;
            border: 2px solid #3498db;
            border-radius: 5px;
            margin: 5px;
            transition: all 0.3s ease;
        }

        a:hover {
            background-color: #3498db;
            color: white;
            border: 2px solid #2980b9;
        }

        a:active {
            background-color: #2980b9;
            transform: translateY(2px);
        }

        /* Welcome message and logout link */
        p {
            font-size: 18px;
            color: #2C3E50;
            text-align: center;
            margin-top: 20px;
        }

        p a {
            color: #3498db;
            text-decoration: none;
            font-weight: bold;
        }

        p a:hover {
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 800px) {
            table {
                width: 90%;
            }
        }
    </style>
</head>
<body>

    <h2>Admin Dashboard</h2>

    <p>Welcome, Admin! <a href="admin_logout.php">Logout</a></p>

    <h3>Registered Users</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Favorite Plant</th>
            <th>Actions</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            // Output each user's data
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['username']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['favorite_plant']}</td>
                        <td>
                            <a href='?delete={$row['id']}'>Delete</a> | 
                            <a href='edit_user.php?id={$row['id']}'>Edit</a>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No users found.</td></tr>";
        }
        ?>
    </table>

</body>
</html>
