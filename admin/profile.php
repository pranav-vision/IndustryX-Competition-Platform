<?php

session_start();

if(!isset($_SESSION['admin_id']))
{
    header("Location: login.php");
    exit();
}

include "../includes/db.php";

$id = $_SESSION['admin_id'];

$sql = "SELECT * FROM admins WHERE id='$id'";

$result = mysqli_query($conn,$sql);

$admin = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html>

<head>

<title>Admin Profile</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-dark">

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-primary text-white">

<h3>Admin Profile</h3>

</div>

<div class="card-body">

<form action="update_profile.php" method="POST">

<div class="mb-3">

<label>Name</label>

<input
type="text"
name="name"
class="form-control"
value="<?php echo htmlspecialchars($admin['name']); ?>"
required>

</div>

<div class="mb-3">

<label>Email</label>

<input
type="email"
name="email"
class="form-control"
value="<?php echo htmlspecialchars($admin['email']); ?>"
required>

</div>

<div class="mb-3">

<label>New Password</label>

<input
type="password"
name="password"
class="form-control"
placeholder="Leave blank to keep current password">

</div>

<button
type="submit"
class="btn btn-success">

Update Profile

</button>

<a href="dashboard.php"
class="btn btn-secondary">

Back

</a>

</form>

</div>

</div>

</div>
<script src="../assets/js/script.js"></script>
</body>
</html>