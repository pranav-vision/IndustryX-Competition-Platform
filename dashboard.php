<?php

session_start();

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html>

<head>

<title>User Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-dark text-white">

<div class="container mt-5">

<h1>
Welcome to IndustryX Dashboard
</h1>

<p>
You are successfully logged in.
</p>

<hr>

<a href="logout.php"
class="btn btn-danger me-2">
Logout
</a>

<a href="competitions.php"
class="btn btn-primary me-2">
View Competitions
</a>

<a href="my_competitions.php"
class="btn btn-success me-2">
My Competitions
</a>

<a href="submit_project.php"
class="btn btn-warning me-2">
Submit Project
</a>

<a href="my_projects.php"
class="btn btn-info">
My Projects
</a>

</div>
<script src="assets/js/script.js"></script>
</body>

</html>