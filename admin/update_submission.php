<?php

session_start();

if(!isset($_SESSION['admin_id']))
{
    header("Location: login.php");
    exit();
}

include "../includes/db.php";

$project_id = $_POST['project_id'];
$status = $_POST['status'];
$remarks = $_POST['remarks'];

$sql = "UPDATE projects
SET
status='$status',
remarks='$remarks'
WHERE id='$project_id'";

if(mysqli_query($conn,$sql))
{
    header("Location: submissions.php");
    exit();
}
else
{
    echo "Error: " . mysqli_error($conn);
}

?>