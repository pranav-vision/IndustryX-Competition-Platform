<?php

session_start();

if(!isset($_SESSION['admin_id']))
{
    header("Location: login.php");
    exit();
}

include "../includes/db.php";

/* Dashboard Statistics */

$user_count = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM users"))['total'];

$competition_count = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM competitions"))['total'];

$participant_count = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM competition_registrations"))['total'];

$project_count = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM projects"))['total'];

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Admin Dashboard | IndustryX</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#1f2937;
}

.card{
    border:none;
    border-radius:15px;
}

</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

<div class="container mt-5">

<div class="d-flex justify-content-between align-items-center mb-4">

<div>

<h2 class="text-white">
Welcome,
<?php echo $_SESSION['admin_name']; ?>
</h2>

<p class="text-light">
IndustryX Competition Management System
</p>

</div>

<a href="logout.php" class="btn btn-danger">
Logout
</a>

</div>

<hr class="text-light">

<!-- Navigation -->

<div class="mb-4">

<a href="create_competition.php" class="btn btn-primary me-2">
➕ Create Competition
</a>

<a href="competitions.php" class="btn btn-success me-2">
📋 Manage Competitions
</a>

<a href="participants.php" class="btn btn-warning me-2">
👥 Participants
</a>

<a href="submissions.php" class="btn btn-info text-white me-2">
📁 Project Submissions
</a>

<a href="../dashboard.php" class="btn btn-secondary">
🏠 User Dashboard
</a>



</div>

<!-- Statistics -->

<div class="row">

<div class="col-md-3 mb-4">

<div class="card shadow text-center p-4">

<h5>Total Users</h5>

<h1 class="text-primary">

<?php echo $user_count; ?>

</h1>

</div>

</div>

<div class="col-md-3 mb-4">

<div class="card shadow text-center p-4">

<h5>Competitions</h5>

<h1 class="text-success">

<?php echo $competition_count; ?>

</h1>

</div>

</div>

<div class="col-md-3 mb-4">

<div class="card shadow text-center p-4">

<h5>Participants</h5>

<h1 class="text-warning">

<?php echo $participant_count; ?>

</h1>

</div>

</div>

<div class="col-md-3 mb-4">

<div class="card shadow text-center p-4">

<h5>Projects</h5>

<h1 class="text-danger">

<?php echo $project_count; ?>

</h1>

</div>

</div>

</div>

<!-- Quick Information -->

<div class="card mt-3 shadow">

<div class="card-body">

<h4>
Quick Actions
</h4>

<p>

✔ Create and manage competitions.<br>

✔ View registered participants.<br>

✔ Monitor uploaded projects.<br>

✔ Manage the complete IndustryX competition platform.

</p>

</div>

</div>

</div>


<div class="card mt-5 shadow">

<div class="card-body">

<h3 class="text-center mb-4">

Platform Statistics

</h3>

<canvas id="dashboardChart"></canvas>

</div>

</div>

<script>

const ctx = document.getElementById('dashboardChart');

new Chart(ctx, {

type: 'bar',

data: {

labels: [

'Users',

'Competitions',

'Participants',

'Projects'

],

datasets: [{

label: 'IndustryX Statistics',

data: [

<?php echo $user_count; ?>,

<?php echo $competition_count; ?>,

<?php echo $participant_count; ?>,

<?php echo $project_count; ?>

]

}]

}

});

</script>

</body>

</html>