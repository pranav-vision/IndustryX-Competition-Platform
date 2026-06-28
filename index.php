<?php

include 'includes/db.php';

$user_count = mysqli_fetch_assoc(
mysqli_query($conn,"SELECT COUNT(*) AS total FROM users")
)['total'];

$competition_count = mysqli_fetch_assoc(
mysqli_query($conn,"SELECT COUNT(*) AS total FROM competitions")
)['total'];

$project_count = mysqli_fetch_assoc(
mysqli_query($conn,"SELECT COUNT(*) AS total FROM projects")
)['total'];

$winner_count = mysqli_fetch_assoc(
mysqli_query($conn,"SELECT COUNT(*) AS total FROM projects WHERE status='Approved'")
)['total'];

$top_winners = mysqli_query($conn,"
SELECT
users.name,
projects.score

FROM projects

INNER JOIN users
ON projects.user_id = users.id

WHERE projects.status='Approved'

ORDER BY projects.score DESC

LIMIT 3
");

$leaderboard = mysqli_query($conn,"
SELECT
users.name,
projects.score

FROM projects

INNER JOIN users
ON projects.user_id = users.id

WHERE projects.status='Approved'

ORDER BY projects.score DESC

LIMIT 5
");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IndustryX</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">

        <a class="navbar-brand" href="index.php">
            IndustryX
        </a>

        <div>

            <a class="btn btn-outline-light me-2" href="login.php">
                Login
            </a>

            <a class="btn btn-primary" href="register.php">
                Register
            </a>

        </div>

    </div>
</nav>

<div class="container text-center mt-5">

    <h1 class="display-3 fw-bold">
        IndustryX 2026
    </h1>

    <p class="lead mt-3">
        Industry Readiness Competition Platform
    </p>

    <p>
        Compete • Submit Projects • Track Rankings • Explore Results
    </p>

    <div class="mt-4">

        <a href="register.php" class="btn btn-primary btn-lg me-3">
            Register Now
        </a>

        <a href="leaderboard.php" class="btn btn-warning btn-lg me-3">
            🏆 Leaderboard
        </a>

        <a href="competitions.php" class="btn btn-outline-light btn-lg">
            View Competitions
        </a>

    </div>

</div>

<div class="container mt-5">

    <div class="row">

        <div class="col-md-3">
            <div class="card text-center p-4">
                <h2><?php echo $user_count; ?></h2>
                <p>Participants</p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center p-4">
                <h2><?php echo $project_count; ?></h2>
                <p>Projects</p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center p-4">
                <h2><?php echo $competition_count; ?></h2>
                <p>Competitions</p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center p-4">
                <h2><?php echo $winner_count; ?></h2>
                <p>Approved Projects</p>
            </div>
        </div>

    </div>

</div>

<div class="container mt-5">

    <h2 class="text-center mb-4">
        Platform Features
    </h2>

    <div class="row">

        <div class="col-md-4 mb-4">
            <div class="card p-4">
                <h4>Competition Registration</h4>
                <p>Join industry competitions.</p>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card p-4">
                <h4>Project Submission</h4>
                <p>Upload projects and reports.</p>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card p-4">
                <h4>Leaderboard</h4>
                <p>Track rankings and performance.</p>
            </div>
        </div>

    </div>

</div>

<div class="container mt-5">

    <h2 class="text-center mb-5">
        Competition Timeline
    </h2>

    <div class="row text-center">

        <div class="col-md-3">
            <div class="card p-4">
                <h4>Phase 1</h4>
                <h5>Registration</h5>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-4">
                <h4>Phase 2</h4>
                <h5>Project Submission</h5>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-4">
                <h4>Phase 3</h4>
                <h5>Evaluation</h5>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-4">
                <h4>Phase 4</h4>
                <h5>Results</h5>
            </div>
        </div>

    </div>

</div>

<div class="container mt-5">

    <h2 class="text-center mb-4">
        Top Winners
    </h2>

    <div class="row">

        <?php

        $medals = ["🥇","🥈","🥉"];

        $i = 0;

        while($winner = mysqli_fetch_assoc($top_winners))
        {

        ?>

        <div class="col-md-4 mb-4">

            <div class="card p-4 text-center shadow h-100">

                <h1>

                    <?php echo $medals[$i]; ?>

                </h1>

                <h4>

                    <?php echo htmlspecialchars($winner['name']); ?>

                </h4>

                <p class="fs-5">

                    <strong>Score :</strong>

                    <?php echo $winner['score']; ?>/100

                </p>

            </div>

        </div>

        <?php

        $i++;

        }

        ?>

    </div>

</div>

<div class="container mt-5">

    <h2 class="text-center mb-4">
        Leaderboard Preview
    </h2>

    <table class="table table-dark table-striped">

        <thead>
            <tr>
                <th>Rank</th>
                <th>Name</th>
                <th>Score</th>
            </tr>
        </thead>

        <tbody>

<?php

$rank = 1;

while($row = mysqli_fetch_assoc($leaderboard))
{

?>

<tr>

<td>

<?php

if($rank==1)
echo "🥇";

elseif($rank==2)
echo "🥈";

elseif($rank==3)
echo "🥉";

else
echo $rank;

?>

</td>

<td>

<?php echo htmlspecialchars($row['name']); ?>

</td>

<td>

<?php echo $row['score']; ?>/100

</td>

</tr>

<?php

$rank++;

}

?>

</tbody>

    </table>

    <div class="text-center mt-4">

        <a href="leaderboard.php" class="btn btn-warning btn-lg">
            🏆 View Full Leaderboard
        </a>

    </div>

</div>

<footer class="text-center mt-5 mb-3">

    <hr>

    <p>
        IndustryX 2026
    </p>

    <p>
        Built with PHP • MySQL • Bootstrap
    </p>

</footer>
<script src="assets/js/script.js"></script>
</body>
</html>