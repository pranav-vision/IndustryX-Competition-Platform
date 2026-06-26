<?php

session_start();

if(!isset($_SESSION['admin_id']))
{
    header("Location: login.php");
    exit();
}

include "../includes/db.php";

$sql = "SELECT
projects.id,
projects.project_title,
projects.description,
projects.file_name,
projects.submitted_at,
projects.status,
projects.remarks,
users.name,
competitions.title AS competition_name

FROM projects

INNER JOIN users
ON projects.user_id = users.id

INNER JOIN competitions
ON projects.competition_id = competitions.id

ORDER BY projects.submitted_at DESC";

$result = mysqli_query($conn,$sql);

?>

<!DOCTYPE html>

<html>

<head>

<title>Project Submissions</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-dark text-white">

<div class="container mt-5">

<h2 class="mb-4">
Project Submissions
</h2>

<a href="dashboard.php" class="btn btn-secondary mb-3">
Dashboard
</a>

<table class="table table-bordered table-striped table-light">

<thead>

<tr>

<th>ID</th>

<th>Participant</th>

<th>Competition</th>

<th>Project</th>

<th>Status</th>

<th>Remarks</th>

<th>Submitted</th>

<th>Download</th>

<th>Review</th>

</tr>

</thead>

<tbody>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo htmlspecialchars($row['name']); ?></td>

<td><?php echo htmlspecialchars($row['competition_name']); ?></td>

<td><?php echo htmlspecialchars($row['project_title']); ?></td>

<td>
<?php echo htmlspecialchars($row['status']); ?>
</td>

<td>
<?php echo !empty($row['remarks']) ? htmlspecialchars($row['remarks']) : "-"; ?>
</td>

<td><?php echo $row['submitted_at']; ?></td>

<td>

<a
href="../uploads/<?php echo urlencode($row['file_name']); ?>"
class="btn btn-success btn-sm"
target="_blank">

Download

</a>

</td>

<td>

<a
href="review_submission.php?id=<?php echo $row['id']; ?>"
class="btn btn-primary btn-sm">

Review

</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</body>

</html>