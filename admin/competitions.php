<?php

session_start();

if(!isset($_SESSION['admin_id']))
{
header("Location: login.php");
exit();
}

include "../includes/db.php";

$result=mysqli_query($conn,"SELECT * FROM competitions");

?>

<!DOCTYPE html>

<html>

<head>

<title>Manage Competitions</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-dark text-white">

<div class="container mt-5">

<h2 class="mb-4">

Manage Competitions

</h2>

<a href="create_competition.php"
class="btn btn-success mb-3">

Add Competition

</a>

<table class="table table-bordered table-striped table-light">

<thead>

<tr>

<th>ID</th>

<th>Title</th>

<th>Deadline</th>

<th>Prize</th>

<th>Action</th>

</tr>

</thead>

<tbody>

<?php

while($row=mysqli_fetch_assoc($result))
{

?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['title']; ?></td>

<td><?php echo $row['registration_deadline']; ?></td>

<td><?php echo $row['prize']; ?></td>

<td>

<a
href="edit_competition.php?id=<?php echo $row['id']; ?>"
class="btn btn-warning btn-sm">

Edit

</a>

<a
href="delete_competition.php?id=<?php echo $row['id']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Are you sure you want to delete this competition?');">

Delete

</a>

</td>

</tr>

<?php

}

?>

</tbody>

</table>

</div>
<script src="../assets/js/script.js"></script>
</body>

</html>