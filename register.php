<?php

// Connect to the database
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "pbt2";
$conn = mysqli_connect($servername, $db_username, $db_password, $dbname);

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Get the values from the form
  $email = $_POST['email'];
  $username = $_POST['username'];
  $role = $_POST['role'];
  $password = $_POST['password'];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  // Insert the values into the database
// Insert the values into the database with the initial status as "pending"
    $sql = "INSERT INTO users (email, username, role, password, status) VALUES ('$email', '$username', '$role', '$hashed_password', 'pending')";


  if (mysqli_query($conn, $sql)) {

    // Data inserted successfully, redirect to thank you page
    header("Location: Register_Complete.php");

    exit(); // Make sure to exit after the redirect to prevent further execution of the script
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }

}

// Close connection
mysqli_close($conn);

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
  background-color: black;
}

* {
  box-sizing: border-box;
}

/* Add padding to containers */
.container {
  padding: 16px;
  background-color: white;
}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Overwrite default styles of hr */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for the submit button */
.registerbtn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.registerbtn:hover {
  opacity: 1;
}

/* Add a blue text color to links */
a {
  color: dodgerblue;
}

/* Set a grey background color and center the text of the "sign in" section */
.signin {
  background-color: #f1f1f1;
  text-align: center;
}

form  {
  width : 50%;
  margin-right : auto;
  margin-left : auto;
}

/* Full-width input fields */
input[type=text], select{
    width: 100%;
    padding: 15px;
    margin: 5px 0 22px 0;
    border: none;
    background: #f1f1f1;
}

input[type=text]:focus, select{
    background-color: #ddd;
    outline: none;
}
</style>
</head>
<body>

<form method="POST">
  <div class="container">
    <h1>Register</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>

    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" id="email" required>

    <label for="username"><b>Username</b></label>
    <input type="text" placeholder="username" name="username" id="username" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" id="password" required>

    <label for="role"><strong>Role</strong></label>
    <select name="role" id="role">
                <option value="" disabled selected hidden>Select Role</option>
                <option value="Admin">Admin</option>
                <option value="Student">Student</option>
                <option value="Staff">Staff</option>
              </select>
    <hr>
    <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>

    <button type="submit" class="registerbtn">Register</button>
  </div>
  
  <div class="container signin">
    <p>Already have an account? <a href="login.php">Sign in</a>.</p>
  </div>
</form>

</body>
</html>
