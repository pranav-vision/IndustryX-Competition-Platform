<?php

session_start();
include 'includes/db.php';

$user_id = $_SESSION['user_id'];

$project_title = $_POST['project_title'];
$description = $_POST['description'];
$competition_id = $_POST['competition_id'];

$file_name = $_FILES['project_file']['name'];
$temp_name = $_FILES['project_file']['tmp_name'];

move_uploaded_file(
    $temp_name,
    "uploads/" . $file_name
);

mysqli_query(
    $conn,
    "INSERT INTO projects
    (user_id, competition_id, project_title, description, file_name)
    VALUES
    ('$user_id',
     '$competition_id',
     '$project_title',
     '$description',
     '$file_name')"
);

header("Location: my_projects.php");
exit();

?>