<?php

session_start();

include 'includes/db.php';

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email='$email'";

$result = mysqli_query($conn,$sql);

$user = mysqli_fetch_assoc($result);

if($user && password_verify($password,$user['password']))
{
    $_SESSION['user_id'] = $user['id'];

    header("Location: dashboard.php");
}
else
{
    echo "Invalid Email or Password";
}

?>