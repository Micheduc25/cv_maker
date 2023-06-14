
<?php
session_start();

$_SESSION['user_id'];
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

// Check if form submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $user_id = test_input($_SESSION['user_id']);
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

    // Validate form data
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
    } else {
        // Insert data into database
        $sql = "INSERT INTO cv (user_id, first_name, last_name, email, phone, address, city, region, postal_code, summary, education, experience, skills)
        VALUES ('$user_id', '$first_name', '$last_name', '$email', '$phone', '$address', '$city', '$region', '$postal_code', '$summary', '$education', '$experience', '$skills')";

        if (mysqli_query($conn, $sql)) {
            echo "CV created successfully";
            header("Location: my-cv.php");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
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
?>