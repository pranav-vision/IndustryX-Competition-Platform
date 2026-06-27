<?php

session_start();

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

include 'includes/db.php';

$user_id = $_SESSION['user_id'];

$project_title = mysqli_real_escape_string($conn, $_POST['project_title']);
$description = mysqli_real_escape_string($conn, $_POST['description']);
$competition_id = $_POST['competition_id'];

/* File Upload */

$allowed_extensions = array(
    "pdf",
    "ppt",
    "pptx",
    "zip"
);

$file_name = $_FILES['project_file']['name'];
$temp_name = $_FILES['project_file']['tmp_name'];
$file_size = $_FILES['project_file']['size'];

$extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

/* Validate Extension */

if(!in_array($extension, $allowed_extensions))
{
    die("Only PDF, PPT, PPTX and ZIP files are allowed.");
}

/* Validate File Size (20 MB) */

if($file_size > 20 * 1024 * 1024)
{
    die("Maximum file size is 20 MB.");
}

/* Generate Unique File Name */

$newFileName = time() . "_" . basename($file_name);

/* Upload File */

if(!move_uploaded_file($temp_name, "uploads/" . $newFileName))
{
    die("File upload failed.");
}

/* Save to Database */

$sql = "INSERT INTO projects
(
    user_id,
    competition_id,
    project_title,
    description,
    file_name
)
VALUES
(
    '$user_id',
    '$competition_id',
    '$project_title',
    '$description',
    '$newFileName'
)";

if(mysqli_query($conn, $sql))
{
    header("Location: my_projects.php");
    exit();
}
else
{
    echo "Database Error: " . mysqli_error($conn);
}

?>