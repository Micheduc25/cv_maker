<?php
// Start session
session_start();
// Connect to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cv_maker";
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// Get user ID from session
$user_id = $_SESSION['user_id'];
// Collect form data
$first_name = test_input($_POST["first_name"]);
$last_name = test_input($_POST["last_name"]);
$email = test_input($_POST["email"]);
$phone = test_input($_POST["phone"]);
$address = test_input($_POST["address"]);
$city = test_input($_POST["city"]);
$region = test_input($_POST["region"]);
$postal_code = test_input($_POST["postal_code"]);
$summary = test_input($_POST["summary"]);
$education = test_input($_POST["education"]);
$experience = test_input($_POST["experience"]);
$skills = test_input($_POST["skills"]);
// Update data in database
$sql = "UPDATE cv SET first_name='$first_name', last_name='$last_name', email='$email', phone='$phone', address='$address', city='$city', region='$region', postal_code='$postal_code', summary='$summary', education='$education', experience='$experience', skills='$skills' WHERE user_id='$user_id'";
if (mysqli_query($conn, $sql)) {
    echo "CV updated successfully";
    header("Location: my-cv.php");
} else {
    echo "Error updating CV: " . mysqli_error($conn);
}
// Close database connection
mysqli_close($conn);
// Function to sanitize form data
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
