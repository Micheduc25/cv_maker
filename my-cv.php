<!DOCTYPE html>
<html>

<head>
    <title>My CV</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="cv.css">

</head>

<body>

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
    // Get user's CV data from database
    $sql = "SELECT * FROM cv WHERE user_id = '$user_id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {

        $has_cv = true;

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
    }
    // Close database connection
    mysqli_close($conn);
    ?>
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
                    <li class="nav-item">
                        <a class="nav-link" href="cv-creation.php">CV Maker</a>
                    </li>
                    <li class="nav-item active">
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

    <?php if (!isset($has_cv)) {
        echo '<div style="text-align:center;" class="label">' . "You have no CV for now. Create one by clicking below" . '</div>';

        echo ' <a href="cv-creation.php" class="create-cv-btn">Create a CV</a>';
        exit();
    }

    ?>

    <div class="cv-body container">
        <div class="cv-body__left">
            <div class="side-info">
                <div class="address-info">
                    <p>
                        <?php echo $postal_code . ",  " . $address . ",  " . $city   ?>
                    </p>
                    <p>
                        <?php echo $phone ?>
                    </p>

                    <h2>Skills</h2>
                    <ul>
                        <?php
                        // Convert skills string to array
                        $skills_arr = explode("\n", $skills);
                        foreach ($skills_arr as $skill) {
                            echo '<li>' . $skill . '</li>';
                        }
                        ?>
                    </ul>

                </div>
                <div class="skills-info"></div>
            </div>
        </div>
        <div class="cv-body__right">
            <h2 class="fullname"> <?php echo $first_name . " " . $last_name ?> </h2>

            <p class="main-item">
            <h2 class="label">Professional Summary</h2>
            <p>
                <?php echo $summary ?>
            </p>
            </p>

            <p class="main-item">
            <h2 class="label">Experience</h2>
            <ul>
                <?php
                // Convert experience string to array
                $experience_arr = explode("\n", $experience);
                foreach ($experience_arr as $exp) {
                    echo '<li>' . $exp . '</li>';
                }
                ?>
            </ul>
            </p>


            <p class="main-item">
            <h2 class="label">Education</h2>
            <p>
            <ul>
                <?php
                // Convert experience string to array
                $education_arr = explode("\n", $education);
                foreach ($education_arr as $exp) {
                    echo '<li>' . $exp . '</li>';
                }
                ?>
            </ul>
            </p>
            </p>
        </div>
    </div>
</body>

</html>