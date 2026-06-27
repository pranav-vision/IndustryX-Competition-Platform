<?php

session_start();

if(!isset($_SESSION['admin_id']))
{
    header("Location: login.php");
    exit();
}

include "../includes/db.php";

/* Search */

$search = "";

if(isset($_GET['search']))
{
    $search = mysqli_real_escape_string($conn, $_GET['search']);
}

/* Status Filter */

$status = "";

if(isset($_GET['status']))
{
    $status = mysqli_real_escape_string($conn, $_GET['status']);
}

/* SQL Query */

$sql = "SELECT

projects.id,
projects.project_title,
projects.description,
projects.file_name,
projects.submitted_at,
projects.status,
projects.score,
projects.remarks,

users.name,

competitions.title AS competition_name

FROM projects

INNER JOIN users
ON projects.user_id = users.id

INNER JOIN competitions
ON projects.competition_id = competitions.id

WHERE
(
users.name LIKE '%$search%'
OR
projects.project_title LIKE '%$search%'
)";

/* Apply Status Filter */

if($status != "")
{
    $sql .= " AND projects.status='$status'";
}

/* Sort */

$sql .= " ORDER BY projects.submitted_at DESC";

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

<?php

if(isset($_GET['success']))
{

?>

<div class="alert alert-success alert-dismissible fade show">

<strong>Success!</strong>

Project review updated successfully.

<button
type="button"
class="btn-close"
data-bs-dismiss="alert">
</button>

</div>

<?php

}

?>

<a href="dashboard.php" class="btn btn-secondary mb-3">
Dashboard
</a>

<!-- Search + Filter Form -->

<form method="GET" class="row mb-4">

<div class="col-md-6">

<input
type="text"
name="search"
class="form-control"
placeholder="Search Participant or Project"
value="<?php echo htmlspecialchars($search); ?>">

</div>

<div class="col-md-4">

<select
name="status"
class="form-select">

<option value="">All Status</option>

<option value="Pending"
<?php if($status=="Pending") echo "selected"; ?>>
Pending
</option>

<option value="Approved"
<?php if($status=="Approved") echo "selected"; ?>>
Approved
</option>

<option value="Rejected"
<?php if($status=="Rejected") echo "selected"; ?>>
Rejected
</option>

</select>

</div>

<div class="col-md-2">

<button
type="submit"
class="btn btn-primary w-100">

Filter

</button>

</div>

</form>

<table class="table table-bordered table-striped table-light">

<thead>

<tr>

<th>ID</th>

<th>Participant</th>

<th>Competition</th>

<th>Project</th>

<th>Status</th>

<th>Score</th>

<th>Remarks</th>

<th>Submitted</th>

<th>Download</th>

<th>Review</th>

<th>Delete</th>

</tr>

</thead>

<tbody>

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo htmlspecialchars($row['name']); ?></td>

<td><?php echo htmlspecialchars($row['competition_name']); ?></td>

<td><?php echo htmlspecialchars($row['project_title']); ?></td>

<td>

<?php echo htmlspecialchars($row['status']); ?>

</td>

<td>

<?php echo $row['score']; ?>/100

</td>

<td>

<?php echo !empty($row['remarks']) ? htmlspecialchars($row['remarks']) : "-"; ?>

</td>

<td>

<?php echo $row['submitted_at']; ?>

</td>

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

<td>

<a
href="delete_submission.php?id=<?php echo $row['id']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Are you sure you want to delete this project?');">

Delete

</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>