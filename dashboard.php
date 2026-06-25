
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
    <title>Dashboard</title>
</head>
<body>

<h1>Welcome to IndustryX Dashboard</h1>

<p>You are successfully logged in.</p>

<a href="logout.php"
   class="btn btn-danger">
   Logout
</a>

<a href="competitions.php" class="btn btn-primary">
    View Competitions
</a>
</body>
</html>