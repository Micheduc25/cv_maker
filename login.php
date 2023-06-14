<?php
// start session
session_start();
// connect to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cv_maker";
$conn = new mysqli($servername, $username, $password, $dbname);
// check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// retrieve form data
$username = $_POST['username'];
$password = $_POST['password'];
// prepare and bind statement
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
// execute statement
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows == 1) {
    // user found, check password
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        // password is correct, set session variables and redirect to home page
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['fullname'] = $row['fullname'];
        header('Location: home.php');
    } else {
        // password is incorrect, display error message
        echo "Incorrect password.";
    }
} else {
    // user not found, display error message
    echo "User not found.";
}
// close statement and connection
$stmt->close();
$conn->close();
