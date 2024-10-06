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

// Retrieve all user accounts from the database
$sql = "SELECT id, email, username, role, status FROM users";
$result = mysqli_query($conn, $sql);

// Close the database connection
mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
</head>
<body>
    <h1>Admin Panel</h1>

    

    <table>
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Username</th>
            <th>Role</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['role']; ?></td>
            <td><?php echo $row['status']; ?></td>
            <td>
                <?php if ($row['status'] === 'pending') { ?>
                    <form action="update_status.php" method="POST">
                        <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
                        <input type="hidden" name="status" value="approved">
                        <button type="submit">Approve</button>
                    </form>
                    <form action="update_status.php" method="POST">
                        <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
                        <input type="hidden" name="status" value="rejected">
                        <button type="submit">Reject</button>
                    </form>
                <?php } ?>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
