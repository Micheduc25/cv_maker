<?php session_start();
if (isset($_SESSION['user_id'])) {
    $username = $_SESSION['username'];
} else {
    header('Location: login.html');
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Home Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" crossorigin="anonymous">
    <style>
        .create-cv-btn {
            display: block;
            margin: 0 auto;
            margin-top: 50px;
            font-size: 24px;
            padding: 20px 50px;
            border-radius: 10px;
            background-color: #007bff;
            color: #fff;
            text-align: center;
            cursor: pointer;
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease-in-out;
        }

        .create-cv-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">My CV Maker</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="home.php">Home</a>
                    </li>
                    <li class="nav-item">
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
        <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
        <p>This is the home page of My CV maker. You can create and modify your CV. click below to start</p>
        <a href="cv-creation.php" class="create-cv-btn">Create a CV</a>
    </div>
</body>

</html>