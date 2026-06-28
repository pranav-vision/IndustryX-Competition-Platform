<?php

session_start();

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

include "includes/db.php";

$user_id = $_SESSION['user_id'];

$competition_count = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT COUNT(*) AS total FROM competition_registrations WHERE user_id='$user_id'")
)['total'];

$project_count = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT COUNT(*) AS total FROM projects WHERE user_id='$user_id'")
)['total'];

$approved_count = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT COUNT(*) AS total FROM projects WHERE user_id='$user_id' AND status='Approved'")
)['total'];

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>User Dashboard | IndustryX</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>

body{
    background:linear-gradient(135deg,#0f172a,#1e3a8a);
    min-height:100vh;
    color:white;
}

.dashboard-card{
    border:none;
    border-radius:18px;
    transition:0.3s;
    box-shadow:0 8px 20px rgba(0,0,0,.25);
}

.dashboard-card:hover{
    transform:translateY(-8px);
}

.action-card{
    text-decoration:none;
    color:white;
}

.action-card .card{
    border-radius:18px;
    transition:.3s;
    border:none;
}

.action-card .card:hover{
    transform:scale(1.05);
}

.icon{
    font-size:45px;
}

.progress{
    height:25px;
}

.quote{
    font-style:italic;
}

</style>

</head>

<body>

<div class="container py-5">

<!-- Welcome -->

<div class="card dashboard-card bg-dark text-white mb-4">

<div class="card-body">

<h2 class="fw-bold">
    👋 Welcome,
    <?php echo htmlspecialchars($_SESSION['user_name']); ?>
</h2>

<p class="mb-2">
    <i class="bi bi-envelope-fill"></i>
    <?php echo htmlspecialchars($_SESSION['user_email']); ?>
</p>

<p class="mb-0">
    Welcome back,
    <strong><?php echo htmlspecialchars($_SESSION['user_name']); ?></strong>!
    We're glad to have you on <strong>IndustryX</strong>.
    Participate in competitions, submit innovative projects, and track your progress.
</p>

</div>

</div>

<!-- Statistics -->

<div class="row g-4 mb-4">

<div class="col-md-4">

<div class="card dashboard-card text-center">

<div class="card-body">

<h1 class="text-primary">

<?php echo $competition_count; ?>

</h1>

<h5>Registered Competitions</h5>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card dashboard-card text-center">

<div class="card-body">

<h1 class="text-success">

<?php echo $project_count; ?>

</h1>

<h5>Projects Submitted</h5>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card dashboard-card text-center">

<div class="card-body">

<h1 class="text-warning">

<?php echo $approved_count; ?>

</h1>

<h5>Approved Projects</h5>

</div>

</div>

</div>

</div>

<!-- Quick Actions -->

<h3 class="mb-4">

🚀 Quick Actions

</h3>

<div class="row g-4">

<div class="col-md-4">

<a href="competitions.php" class="action-card">

<div class="card bg-primary text-center p-4">

<div class="icon">

🏆

</div>

<h4 class="mt-3">

View Competitions

</h4>

</div>

</a>

</div>

<div class="col-md-4">

<a href="submit_project.php" class="action-card">

<div class="card bg-warning text-dark text-center p-4">

<div class="icon">

📁

</div>

<h4 class="mt-3">

Submit Project

</h4>

</div>

</a>

</div>

<div class="col-md-4">

<a href="my_projects.php" class="action-card">

<div class="card bg-success text-center p-4">

<div class="icon">

📂

</div>

<h4 class="mt-3">

My Projects

</h4>

</div>

</a>

</div>

<div class="col-md-4">

<a href="my_competitions.php" class="action-card">

<div class="card bg-info text-white text-center p-4">

<div class="icon">

📝

</div>

<h4 class="mt-3">

My Competitions

</h4>

</div>

</a>

</div>

<div class="col-md-4">

<a href="leaderboard.php" class="action-card">

<div class="card bg-danger text-center p-4">

<div class="icon">

🥇

</div>

<h4 class="mt-3">

Leaderboard

</h4>

</div>

</a>

</div>

<div class="col-md-4">

<a href="logout.php" class="action-card">

<div class="card bg-secondary text-center p-4">

<div class="icon">

🚪

</div>

<h4 class="mt-3">

Logout

</h4>

</div>

</a>

</div>

</div>

<!-- Progress -->

<div class="card dashboard-card mt-5">

<div class="card-body">

<h4>

📈 Competition Journey

</h4>

<div class="progress mt-3">

<div
class="progress-bar progress-bar-striped progress-bar-animated bg-success"
style="width:70%;">

70% Completed

</div>

</div>

</div>

</div>

<!-- Quote -->

<div class="card dashboard-card mt-4">

<div class="card-body text-center">

<h4>

💡 Quote of the Day

</h4>

<p class="quote">

"Success is where preparation and opportunity meet."

</p>

<h6>

— Bobby Unser

</h6>

</div>

</div>

<!-- Footer -->

<div class="text-center mt-5">

<hr class="text-light">

<p>

IndustryX 2026 • Industry Readiness Competition Platform

</p>

<p>

Built with PHP • MySQL • Bootstrap • JavaScript

</p>

</div>

</div>

<script src="assets/js/script.js"></script>

</body>

</html>