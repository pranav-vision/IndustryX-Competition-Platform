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

<div class="row">

<div class="col-md-3">

<div class="card p-3">

<h4>Total Users</h4>

<p>Coming Soon</p>

</div>

</div>

<div class="col-md-3">

<div class="card p-3">

<h4>Competitions</h4>

<p>Coming Soon</p>

</div>

</div>

<div class="col-md-3">

<div class="card p-3">

<h4>Projects</h4>

<p>Coming Soon</p>

</div>

</div>

<div class="col-md-3">

<div class="card p-3">

<h4>Participants</h4>

<p>Coming Soon</p>

</div>

</div>

</div>

<br>

<a
href="logout.php"
class="btn btn-danger">

Logout

</a>

</div>

</body>

</html>