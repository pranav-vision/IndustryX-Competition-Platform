<?php
session_start();

if(isset($_SESSION['admin_id']))
{
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Admin Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
background:#1b1f27;
display:flex;
justify-content:center;
align-items:center;
height:100vh;
}

.card{
width:420px;
padding:30px;
border-radius:15px;
}

</style>

</head>

<body>

<div class="card shadow">

<h2 class="text-center mb-4">
Admin Login
</h2>

<form action="login_process.php" method="POST">

<div class="mb-3">

<label>Email</label>

<input
type="email"
name="email"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Password</label>

<input
type="password"
name="password"
class="form-control"
required>

</div>

<button
type="submit"
class="btn btn-primary w-100">

Login

</button>

</form>

</div>
<script src="../assets/js/script.js"></script>
</body>
</html>