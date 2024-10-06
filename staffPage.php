<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
    // User is logged in
    $username = $_SESSION['username'];
    $role = $_SESSION['role'];
    
} else {
    // User is not logged in, redirect to the login page
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Homepage</title>
</head>
<body>

    <h1>Welcome to the Lecturer Homepage</h1>
    <p>Logged in as: <?php echo $_SESSION['username']; ?></p>
    <p>Role: <?php echo $_SESSION['role']; ?></p>

    <a href="logout.php">Logout</a>
</body>
</html>
