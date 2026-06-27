<?php

session_start();

if(!isset($_SESSION['admin_id']))
{
    header("Location: login.php");
    exit();
}

include "../includes/db.php";

$result = mysqli_query($conn,"
SELECT * FROM admin_logs
ORDER BY created_at DESC
");

?>

<!DOCTYPE html>
<html>

<head>

<title>Admin Activity Logs</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-dark">

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-primary text-white">

<h3>Admin Activity Logs</h3>

</div>

<div class="card-body">

<table class="table table-striped">

<thead>

<tr>

<th>ID</th>
<th>Admin</th>
<th>Action</th>
<th>Date & Time</th>

</tr>

</thead>

<tbody>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo htmlspecialchars($row['admin_name']); ?></td>

<td><?php echo htmlspecialchars($row['action']); ?></td>

<td><?php echo $row['created_at']; ?></td>

</tr>

<?php } ?>

</tbody>

</table>

<a href="dashboard.php" class="btn btn-secondary">
Back to Dashboard
</a>

</div>

</div>

</div>

</body>

</html>