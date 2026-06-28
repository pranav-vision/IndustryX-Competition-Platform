<?php

session_start();

if(!isset($_SESSION['admin_id']))
{
    header("Location: login.php");
    exit();
}

include "../includes/db.php";

if(!isset($_GET['id']))
{
    die("Project ID Missing");
}

$id = $_GET['id'];

$sql = "SELECT
projects.*,
users.name,
competitions.title AS competition_name

FROM projects

INNER JOIN users
ON projects.user_id = users.id

INNER JOIN competitions
ON projects.competition_id = competitions.id

WHERE projects.id='$id'";

$result = mysqli_query($conn,$sql);

$project = mysqli_fetch_assoc($result);

if(!$project)
{
    die("Project Not Found");
}

?>

<!DOCTYPE html>

<html>

<head>

<title>Review Submission</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-dark text-white">

<div class="container mt-5">

<h2>Review Project</h2>

<a href="submissions.php" class="btn btn-secondary mb-3">
Back
</a>

<div class="card p-4 text-dark">

<p><strong>Participant:</strong> <?php echo htmlspecialchars($project['name']); ?></p>

<p><strong>Competition:</strong> <?php echo htmlspecialchars($project['competition_name']); ?></p>

<p><strong>Project Title:</strong> <?php echo htmlspecialchars($project['project_title']); ?></p>

<p><strong>Description:</strong></p>

<p><?php echo nl2br(htmlspecialchars($project['description'])); ?></p>

<p>

<strong>Project File:</strong>

<a href="../uploads/<?php echo urlencode($project['file_name']); ?>" target="_blank">

Download File

</a>

</p>

<hr>

<form action="update_submission.php" method="POST">

<input
type="hidden"
name="project_id"
value="<?php echo $project['id']; ?>">

<div class="mb-3">

<label>Status</label>

<select
name="status"
class="form-control">

<option value="Pending"
<?php if($project['status']=="Pending") echo "selected"; ?>>

Pending

</option>

<option value="Approved"
<?php if($project['status']=="Approved") echo "selected"; ?>>

Approved

</option>

<option value="Rejected"
<?php if($project['status']=="Rejected") echo "selected"; ?>>

Rejected

</option>

</select>

</div>

<div class="mb-3">

<label>Project Score (0 - 100)</label>

<input
type="number"
name="score"
class="form-control"
min="0"
max="100"
value="<?php echo $project['score']; ?>"
required>

</div>


<div class="mb-3">

<label>Remarks</label>

<textarea
name="remarks"
rows="5"
class="form-control"><?php echo htmlspecialchars($project['remarks']); ?></textarea>

</div>

<button
class="btn btn-success">

Save Review

</button>

</form>

</div>

</div>
<script src="../assets/js/script.js"></script>
</body>

</html>