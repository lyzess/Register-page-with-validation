<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate the login credentials (you should add your own validation logic here)
    $username = $_POST['username'];
    $password = $_POST['password'];

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

    // Prepare the SQL query
    $sql = "SELECT id, username, password, role, status FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);

    // Bind the parameters and execute the query
    $stmt->bind_param("s", $username);
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if a user with the given username exists
    if ($result->num_rows === 1) {
        // Fetch the user data
        $row = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $row['password'])) {
            // Check the account status
            $status = $row['status'];
            if ($status === 'approved') {
                // Password is correct and account is approved, set session variables
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['role'] = $row['role'];

                // Redirect based on the user's role
                if ($row['role'] === 'Admin') {
                    header("Location: Admin.php");
                } elseif ($row['role'] === 'Student') {
                    header("Location: student.php");
                } elseif ($row['role'] === 'Staff') {
                    header("Location: staffPage.php");
                }
                exit;
            } elseif ($status === 'pending') {
                // Account is pending approval, display a popup message and redirect to login.php
                echo '<script>alert("Your account is pending approval. Please wait for the admin to approve your account.");</script>';
                echo '<script>window.location.href = "login.php";</script>';
                exit;
            } elseif ($status === 'rejected') {
                // Account has been rejected, display a popup message and redirect to login.php
                echo '<script>alert("Your account has been rejected. Please contact the admin for more information.");</script>';
                echo '<script>window.location.href = "login.php";</script>';
                exit;
            }
        } else {
            // Password is incorrect, display a popup message and redirect to login.php
            echo '<script>alert("Invalid username or password.");</script>';
            echo '<script>window.location.href = "login.php";</script>';
            exit;
        }
    } else {
        // User does not exist, display a popup message and redirect to register.php
        echo '<script>alert("You are not registered yet. Please register an account first.");</script>';
        echo '<script>window.location.href = "register.php";</script>';
        exit;
    }
}
?>
