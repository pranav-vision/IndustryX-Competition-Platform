<?php

session_start();

if(!isset($_SESSION['admin_id']))
{
    header("Location: login.php");
    exit();
}

include "../includes/db.php";

$id=$_POST['id'];
$title=$_POST['title'];
$description=$_POST['description'];
$deadline=$_POST['registration_deadline'];
$start=$_POST['start_date'];
$end=$_POST['end_date'];
$max=$_POST['max_participants'];
$prize=$_POST['prize'];
$rules=$_POST['rules'];

$sql="UPDATE competitions SET

title='$title',
description='$description',
registration_deadline='$deadline',
start_date='$start',
end_date='$end',
max_participants='$max',
prize='$prize',
rules='$rules'

WHERE id='$id'";

mysqli_query($conn,$sql);

header("Location: competitions.php");

exit();

?>