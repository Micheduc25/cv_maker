<?php // Start session
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
// Check if user already has a CV in the database
$sql = "SELECT * FROM cv WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    // User already has a CV, so pre-fill the form with their existing data
    $row = mysqli_fetch_assoc($result);
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $email = $row['email'];
    $phone = $row['phone'];
    $address = $row['address'];
    $city = $row['city'];
    $region = $row['region'];
    $postal_code = $row['postal_code'];
    $summary = $row['summary'];
    $education = $row['education'];
    $experience = $row['experience'];
    $skills = $row['skills'];
} else {
    // User does not have a CV, so set default values to empty strings
    $first_name = '';
    $last_name = '';
    $email = '';
    $phone = '';
    $address = '';
    $city = '';
    $region = '';
    $postal_code = '';
    $summary = '';
    $education = '';
    $experience = '';
    $skills = '';
}
// Close database connection
mysqli_close($conn);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Create CV</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" crossorigin="anonymous">

    <style>
        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        textarea {
            display: block;
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>

    <header class="mb-5">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="home.php">My CV Maker</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="home.php">Home</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="cv-creation.php">CV Maker</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="my-cv.php">My CV</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <div class="container mt-5">
        <h2>CV Modification Form</h2>
        <form action="submit-cv.php" method="post">
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $first_name; ?>" required>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $last_name; ?>" required>
            </div>
            <div class=" form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
            </div>
            <div class=" form-group">
                <label for="phone">Phone</label>
                <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo $phone; ?>" required>
            </div>
            <div class=" form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="<?php echo $address; ?>" required>
            </div>
            <div class=" form-group">
                <label for="city">City</label>
                <input type="text" class="form-control" id="city" name="city" value="<?php echo $city; ?>" required>
            </div>
            <div class=" form-group">
                <label for="province">Region</label>
                <select class="form-control" id="region" name="region" required>
                    <option value="">Select Region</option>
                    <option value=" Adamawa" selected="<?php $region == "Adamawa" ?>">Adamawa</option>
                    <option value="Centre" selected="<?php $region == "Centre" ?>">Centre</option>
                    <option value="East" selected="<?php $region == "East" ?>">East</option>
                    <option value="Far North" selected="<?php $region == "Far North" ?>">Far North</option>
                    <option value="Littoral" selected="<?php $region == "Littoral" ?>">Littoral</option>
                    <option value="North" selected="<?php $region == "North" ?>">North</option>
                    <option value="North-West" selected="<?php $region == "North-West" ?>">North-West</option>
                    <option value="South" selected="<?php $region == "South" ?>">South</option>
                    <option value="South-West" selected="<?php $region == "South-West" ?>">South-West</option>
                    <option value="West" selected="<?php $region == "West" ?>">West</option>

                </select>
            </div>
            <div class="form-group">
                <label for="postal_code">Postal Code</label>
                <input type="text" class="form-control" id="postal_code" name="postal_code" value="<?php echo $postal_code; ?>" required>
            </div>
            <div class=" form-group">
                <label for="summary">Summary</label>
                <textarea class="form-control" id="summary" name="summary" rows="5" value="<?php echo $summary; ?>" required><?php
                                                                                                                                echo $summary;
                                                                                                                                ?></textarea>
            </div>
            <div class=" form-group">
                <label for="education">Education</label>
                <textarea class="form-control" id="education" name="education" rows="5" value="<?php echo $education; ?>" required><?php
                                                                                                                                    echo $education;
                                                                                                                                    ?></textarea>
            </div>
            <div class="form-group">
                <label for="experience">Experience</label>
                <textarea class="form-control" id="experience" name="experience" rows="5" value="<?php echo $experience; ?>" required><?php
                                                                                                                                        echo $experience;
                                                                                                                                        ?></textarea>
            </div>
            <div class=" form-group">
                <label for="skills">Skills</label>
                <textarea class="form-control" id="skills" name="skills" rows="5" value="<?php echo $skills; ?>" required><?php
                                                                                                                            echo $skills;
                                                                                                                            ?></textarea>
            </div>
            <button style="margin-bottom: 20px;" type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>

</body>

</html>