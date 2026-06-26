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
    $id=$_GET['id'];

    mysqli_query(
        $conn,
        "DELETE FROM competition_registrations
        WHERE id='$id'"
    );
}

header("Location: participants.php");

exit();

?>