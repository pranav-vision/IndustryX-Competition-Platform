<?php

session_start();

include "../includes/db.php";

$title = $_POST['title'];

$description = $_POST['description'];

$deadline = $_POST['registration_deadline'];

$start = $_POST['start_date'];

$end = $_POST['end_date'];

$max = $_POST['max_participants'];

$prize = $_POST['prize'];

$rules = $_POST['rules'];

$sql = "INSERT INTO competitions
(title,description,registration_deadline,start_date,end_date,max_participants,prize,rules)

VALUES

('$title','$description','$deadline','$start','$end','$max','$prize','$rules')";

if(mysqli_query($conn,$sql))
{

    // Log Admin Activity
    include "log_activity.php";

    logActivity(
        $conn,
        $_SESSION['admin_name'],
        "Created a new competition"
    );

    header("Location: competitions.php");
    exit();

}
else
{

    echo "Error : " . mysqli_error($conn);

}

?>