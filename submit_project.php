<?php
session_start();

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

include 'includes/db.php';

$competitions = mysqli_query(
    $conn,
    "SELECT * FROM competitions"
);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Submit Project</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark text-white">

<div class="container mt-5">

<h1>Submit Project</h1>

<form action="submit_project_process.php"
      method="POST"
      enctype="multipart/form-data">

    <div class="mb-3">

        <label>Project Title</label>

        <input type="text"
               name="project_title"
               class="form-control"
               required>

    </div>

    <div class="mb-3">

        <label>Description</label>

        <textarea name="description"
                  class="form-control"
                  rows="4"
                  required></textarea>

    </div>

    <div class="mb-3">

        <label>Competition</label>

        <select name="competition_id"
                class="form-control"
                required>

            <?php while($c = mysqli_fetch_assoc($competitions)) { ?>

                <option value="<?php echo $c['id']; ?>">
                    <?php echo $c['title']; ?>
                </option>

            <?php } ?>

        </select>

    </div>

    <div class="mb-3">

        <label>Upload PDF/PPT/ZIP</label>

        <input type="file"
               name="project_file"
               class="form-control"
               required>

    </div>

    <button class="btn btn-success">
        Submit Project
    </button>

</form>

</div>
<script src="assets/js/script.js"></script>
</body>
</html>