<?php

session_start();

if(!isset($_SESSION['admin_id']))
{
    header("Location: login.php");
    exit();
}

include "../includes/db.php";

$sql = "SELECT
competition_registrations.id,
users.name,
users.email,
competitions.title,
competition_registrations.registered_at

FROM competition_registrations

INNER JOIN users
ON competition_registrations.user_id = users.id

INNER JOIN competitions
ON competition_registrations.competition_id = competitions.id

ORDER BY competition_registrations.registered_at DESC";

$result = mysqli_query($conn,$sql);

?>

<!DOCTYPE html>
<html>
<head>

<title>Participants</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-dark text-white">

<div class="container mt-5">

<h2 class="mb-4">Competition Participants</h2>

<a href="dashboard.php" class="btn btn-secondary mb-3">
Dashboard
</a>

<table class="table table-bordered table-striped table-light">

<thead>

<tr>

<th>ID</th>

<th>Name</th>

<th>Email</th>

<th>Competition</th>

<th>Registered On</th>

<th>Action</th>

</tr>

</thead>

<tbody>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo htmlspecialchars($row['name']); ?></td>

<td><?php echo htmlspecialchars($row['email']); ?></td>

<td><?php echo htmlspecialchars($row['title']); ?></td>

<td><?php echo $row['registered_at']; ?></td>

<td>

<a
href="remove_participant.php?id=<?php echo $row['id']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Remove this participant?')">

Remove

</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>
<script src="../assets/js/script.js"></script>
</body>
</html>