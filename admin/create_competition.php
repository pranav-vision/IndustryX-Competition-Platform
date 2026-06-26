<?php

session_start();

if(!isset($_SESSION['admin_id']))
{
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Create Competition</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-dark">

<div class="container mt-5">

<div class="card p-4 shadow">

<h2 class="mb-4">
Create Competition
</h2>

<form action="create_competition_process.php" method="POST">

<div class="mb-3">

<label class="form-label">
Competition Title
</label>

<input
type="text"
name="title"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Description</label>

<textarea
name="description"
class="form-control"
rows="4"
required></textarea>

</div>

<div class="mb-3">

<label>Registration Deadline</label>

<input
type="date"
name="registration_deadline"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Start Date</label>

<input
type="date"
name="start_date"
class="form-control">

</div>

<div class="mb-3">

<label>End Date</label>

<input
type="date"
name="end_date"
class="form-control">

</div>

<div class="mb-3">

<label>Maximum Participants</label>

<input
type="number"
name="max_participants"
class="form-control">

</div>

<div class="mb-3">

<label>Prize</label>

<input
type="text"
name="prize"
class="form-control">

</div>

<div class="mb-3">

<label>Rules</label>

<textarea
name="rules"
class="form-control"
rows="5"></textarea>

</div>

<button
type="submit"
class="btn btn-success">

Create Competition

</button>

<a href="dashboard.php"
class="btn btn-secondary">

Back

</a>

</form>

</div>

</div>

</body>

</html>