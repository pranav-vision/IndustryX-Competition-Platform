<?php

session_start();

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

include 'includes/db.php';

$user_id = $_SESSION['user_id'];

if(!isset($_GET['id']))
{
    header("Location: competitions.php");
    exit();
}

$competition_id = $_GET['id'];

/*
    Check if user already registered
*/
$check_query = mysqli_query(
    $conn,
    "SELECT * FROM competition_registrations
     WHERE user_id='$user_id'
     AND competition_id='$competition_id'"
);

if(mysqli_num_rows($check_query) == 0)
{
    $insert_query = mysqli_query(
        $conn,
        "INSERT INTO competition_registrations
        (user_id, competition_id)
        VALUES
        ('$user_id', '$competition_id')"
    );
}

/*
    Redirect to My Competitions page
*/
header("Location: my_competitions.php");
exit();

?>