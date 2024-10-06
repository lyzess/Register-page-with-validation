<?php
// Connect to the database
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "pbt2";
$conn = mysqli_connect($servername, $db_username, $db_password, $dbname);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve the form data
$user_id = $_POST['user_id'];
$status = $_POST['status'];

// Update the account status in the database
$sql = "UPDATE users SET status = '$status' WHERE id = '$user_id'";
if (mysqli_query($conn, $sql)) {
    // Account status updated successfully
    header("Location: admin.php");
    exit;
} else {
    echo "Error updating account status: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
