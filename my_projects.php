<?php

session_start();

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

include 'includes/db.php';

$user_id = $_SESSION['user_id'];

$sql = "SELECT
projects.project_title,
projects.status,
projects.score,
projects.remarks,
projects.submitted_at,
competitions.title AS competition

FROM projects

INNER JOIN competitions
ON projects.competition_id = competitions.id

WHERE projects.user_id='$user_id'

ORDER BY projects.submitted_at DESC";

$result = mysqli_query($conn,$sql);

?>

<!DOCTYPE html>
<html>

<head>

<title>My Projects</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-dark text-white">

<div class="container mt-5">

<h2 class="mb-4">
My Submitted Projects
</h2>

<a href="dashboard.php" class="btn btn-secondary mb-3">
Dashboard
</a>

<table class="table table-bordered table-striped table-light">

<thead>

<tr>

<th>Project</th>

<th>Competition</th>

<th>Status</th>

<th>Score</th>

<th>Remarks</th>

<th>Submitted</th>

</tr>

</thead>

<tbody>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?php echo htmlspecialchars($row['project_title']); ?></td>

<td><?php echo htmlspecialchars($row['competition']); ?></td>

<td><?php echo htmlspecialchars($row['status']); ?></td>

<td><?php echo $row['score']; ?>/100</td>

<td>
<?php echo !empty($row['remarks']) ? htmlspecialchars($row['remarks']) : "-"; ?>
</td>

<td><?php echo $row['submitted_at']; ?></td>

</tr>

<?php } ?>

</tbody>

</table>

</div>
<script src="assets/js/script.js"></script>
</body>

</html>