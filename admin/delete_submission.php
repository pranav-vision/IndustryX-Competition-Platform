<?php

session_start();

if(!isset($_SESSION['admin_id']))
{
    header("Location: login.php");
    exit();
}

include "../includes/db.php";

if(isset($_GET['id']))
{
    $id = intval($_GET['id']);

    // Get uploaded file name
    $result = mysqli_query(
        $conn,
        "SELECT file_name FROM projects WHERE id=$id"
    );

    if(mysqli_num_rows($result) > 0)
    {
        $project = mysqli_fetch_assoc($result);

        $file = "../uploads/" . $project['file_name'];

        if(file_exists($file))
        {
            unlink($file);
        }

        mysqli_query(
            $conn,
            "DELETE FROM projects WHERE id=$id"
        );
    }
}

header("Location: submissions.php");
exit();

?>