<?php

session_start();

if(!isset($_SESSION['admin_id']))
{
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Admin Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-dark text-white">

<div class="container mt-5">

<h1>
Welcome,
<?php echo $_SESSION['admin_name']; ?>
</h1>

<hr>

<!-- Navigation Buttons -->

<div class="mb-4">

    <a href="create_competition.php" class="btn btn-primary">
        ➕ Create Competition
    </a>

    <a href="competitions.php" class="btn btn-success">
        📋 Manage Competitions
    </a>

    <a href="participants.php" class="btn btn-warning">
        👥 Participants
    </a>

    <a href="submissions.php" class="btn btn-info text-white">
        📁 Project Submissions
    </a>

    <a href="logout.php" class="btn btn-danger">
        🚪 Logout
    </a>

</div>

<!-- Dashboard Cards -->

<div class="row">

<div class="col-md-3">

<div class="card p-3 text-center">

<h4>Total Users</h4>

<p class="fs-4">Coming Soon</p>

</div>

</div>

<div class="col-md-3">

<div class="card p-3 text-center">

<h4>Competitions</h4>

<p class="fs-4">Coming Soon</p>

</div>

</div>

<div class="col-md-3">

<div class="card p-3 text-center">

<h4>Projects</h4>

<p class="fs-4">Coming Soon</p>

</div>

</div>

<div class="col-md-3">

<div class="card p-3 text-center">

<h4>Participants</h4>

<p class="fs-4">Coming Soon</p>

</div>

</div>

</div>

</div>

</body>

</html>