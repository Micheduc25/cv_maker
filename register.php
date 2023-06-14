<?php
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
$fullname = $_POST['fullname'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
// validate form data
$errors = array();
if (empty($username)) {
    $errors[] = "Username is required.";
}
if (empty($fullname)) {
    $errors[] = "Full name is required.";
}
if (empty($password)) {
    $errors[] = "Password is required.";
} elseif (strlen($password) < 8) {
    $errors[] = "Password must be at least 8 characters long.";
}
if ($password !== $confirm_password) {
    $errors[] = "Passwords do not match.";
}
if (count($errors) > 0) {
    // display errors and exit script
    foreach ($errors as $error) {
        echo $error . "<br>";
    }
    exit();
}
// hash password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
// prepare and bind statement
$stmt = $conn->prepare("INSERT INTO users (username, fullname, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $fullname, $hashed_password);
// execute statement
if ($stmt->execute()) {
    echo "Registration successful!";
    header("Location: login.html");
} else {
    echo "Error: " . $stmt->error;
}
// close statement and connection
$stmt->close();
$conn->close();
