<?php

include 'includes/db.php';

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$department = $_POST['department'];
$password = password_hash(
    $_POST['password'],
    PASSWORD_DEFAULT
);

$sql = "INSERT INTO users
(name,email,phone,department,password)
VALUES
('$name','$email','$phone','$department','$password')";

if(mysqli_query($conn,$sql))
{
    header("Location: login.php");
    exit();
}
else
{
    echo "Error: " . mysqli_error($conn);
}

?>