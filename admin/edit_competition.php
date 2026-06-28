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
    header("Location: competitions.php");
    exit();
}

$id = $_GET['id'];

$result = mysqli_query($conn,"SELECT * FROM competitions WHERE id='$id'");

$competition = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html>
<head>

<title>Edit Competition</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-dark">

<div class="container mt-5">

<div class="card p-4">

<h2>Edit Competition</h2>

<form action="update_competition.php" method="POST">

<input type="hidden" name="id" value="<?php echo $competition['id']; ?>">

<div class="mb-3">
<label>Competition Title</label>
<input
type="text"
name="title"
class="form-control"
value="<?php echo $competition['title']; ?>"
required>
</div>

<div class="mb-3">
<label>Description</label>
<textarea
name="description"
class="form-control"
rows="4"><?php echo $competition['description']; ?></textarea>
</div>

<div class="mb-3">
<label>Registration Deadline</label>
<input
type="date"
name="registration_deadline"
class="form-control"
value="<?php echo $competition['registration_deadline']; ?>">
</div>

<div class="mb-3">
<label>Start Date</label>
<input
type="date"
name="start_date"
class="form-control"
value="<?php echo $competition['start_date']; ?>">
</div>

<div class="mb-3">
<label>End Date</label>
<input
type="date"
name="end_date"
class="form-control"
value="<?php echo $competition['end_date']; ?>">
</div>

<div class="mb-3">
<label>Maximum Participants</label>
<input
type="number"
name="max_participants"
class="form-control"
value="<?php echo $competition['max_participants']; ?>">
</div>

<div class="mb-3">
<label>Prize</label>
<input
type="text"
name="prize"
class="form-control"
value="<?php echo $competition['prize']; ?>">
</div>

<div class="mb-3">
<label>Rules</label>
<textarea
name="rules"
class="form-control"
rows="5"><?php echo $competition['rules']; ?></textarea>
</div>

<button class="btn btn-success">
Update Competition
</button>

<a href="competitions.php" class="btn btn-secondary">
Cancel
</a>

</form>

</div>

</div>
<script src="../assets/js/script.js"></script>
</body>
</html>