<?php

include 'includes/db.php';

$name = trim($_POST['name']);
$email = trim($_POST['email']);
$phone = trim($_POST['phone']);
$department = trim($_POST['department']);

/*
Hash the password before storing it
*/
$password = password_hash(
    $_POST['password'],
    PASSWORD_DEFAULT
);

/*
Check if email already exists
*/
$check = mysqli_query(
    $conn,
    "SELECT * FROM users WHERE email='$email'"
);

if(mysqli_num_rows($check) > 0)
{
    echo "Email already registered.";
    exit();
}

/*
Insert user
*/
$sql = "INSERT INTO users
(
name,
email,
phone,
department,
password
)
VALUES
(
'$name',
'$email',
'$phone',
'$department',
'$password'
)";

if(mysqli_query($conn,$sql))
{
    header("Location: login.php");
    exit();
}
else
{
    echo "Registration Failed : " . mysqli_error($conn);
}

?>