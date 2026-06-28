<?php

session_start();
include 'includes/db.php';

$user_id = $_SESSION['user_id'];

$sql = "
SELECT competitions.*
FROM competition_registrations
JOIN competitions
ON competition_registrations.competition_id = competitions.id
WHERE competition_registrations.user_id = '$user_id'
";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>My Competitions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark text-white">

<div class="container mt-5">

    <h1 class="mb-4">My Competitions</h1>

    <div class="row">

        <?php while($row = mysqli_fetch_assoc($result)) { ?>

        <div class="col-md-4 mb-4">

            <div class="card p-4 bg-secondary text-dark">

                <h3><?php echo $row['title']; ?></h3>

                <p><?php echo $row['description']; ?></p>

                <p>
                    Deadline:
                    <?php echo $row['registration_deadline']; ?>
                </p>

            </div>

        </div>

        <?php } ?>

    </div>

</div>
<script src="assets/js/script.js"></script>
</body>
</html>