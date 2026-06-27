<?php

session_start();

if(!isset($_SESSION['admin_id']))
{
    header("Location: login.php");
    exit();
}

include "../includes/db.php";

$id = $_SESSION['admin_id'];

$name = mysqli_real_escape_string($conn,$_POST['name']);
$email = mysqli_real_escape_string($conn,$_POST['email']);
$password = $_POST['password'];

if(!empty($password))
{
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "UPDATE admins
            SET
            name='$name',
            email='$email',
            password='$hash'
            WHERE id='$id'";
}
else
{
    $sql = "UPDATE admins
            SET
            name='$name',
            email='$email'
            WHERE id='$id'";
}

if(mysqli_query($conn,$sql))
{
    $_SESSION['admin_name'] = $name;

    header("Location: profile.php");
    exit();
}
else
{
    echo "Error: " . mysqli_error($conn);
}

?>