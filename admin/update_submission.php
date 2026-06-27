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
$score = $_POST['score'];

$sql = "UPDATE projects
SET
status='$status',
score='$score',
remarks='$remarks'
WHERE id='$project_id'";

if(mysqli_query($conn,$sql))
{
    // Include activity logger
    include "log_activity.php";

    // Save admin activity
    logActivity(
        $conn,
        $_SESSION['admin_name'],
        "Reviewed Project ID: " . $project_id
    );

    header("Location: submissions.php?success=review");
    exit();
}
else
{
    echo "Error: " . mysqli_error($conn);
}

?>