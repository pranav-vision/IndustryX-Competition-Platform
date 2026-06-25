<?php

session_start();

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

include 'includes/db.php';

$result = mysqli_query(
    $conn,
    "SELECT * FROM competitions"
);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Competitions - IndustryX</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark text-white">

<nav class="navbar navbar-expand-lg navbar-dark bg-black">
    <div class="container">
        <a class="navbar-brand" href="dashboard.php">
            IndustryX
        </a>

        <div>
            <a href="dashboard.php" class="btn btn-outline-light me-2">
                Dashboard
            </a>

            <a href="my_competitions.php" class="btn btn-success me-2">
                My Competitions
            </a>

            <a href="logout.php" class="btn btn-danger">
                Logout
            </a>
        </div>
    </div>
</nav>

<div class="container mt-5">

    <h1 class="text-center mb-5">
        Available Competitions
    </h1>

    <div class="row">

        <?php while($row = mysqli_fetch_assoc($result)) { ?>

        <div class="col-md-4 mb-4">

            <div class="card bg-secondary text-dark h-100 shadow">

                <div class="card-body">

                    <h3 class="card-title">
                        <?php echo $row['title']; ?>
                    </h3>

                    <p class="card-text">
                        <?php echo $row['description']; ?>
                    </p>

                    <p>
                        <strong>Registration Deadline:</strong><br>
                        <?php echo $row['registration_deadline']; ?>
                    </p>

                </div>

                <div class="card-footer bg-transparent border-0">

                    <a
                        href="register_competition.php?id=<?php echo $row['id']; ?>"
                        class="btn btn-primary w-100">

                        Register Now

                    </a>

                </div>

            </div>

        </div>

        <?php } ?>

    </div>

</div>

</body>
</html>