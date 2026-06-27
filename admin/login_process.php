<?php

session_start();

include "../includes/db.php";

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM admins WHERE email='$email'";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) == 1)
{
    $admin = mysqli_fetch_assoc($result);

    // Compare the password stored in the database
    if($password == $admin['password'])
    {
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_name'] = $admin['name'];
        include "log_activity.php";

logActivity(
    $conn,
    $admin['name'],
    "Logged into the admin dashboard"
);

        header("Location: dashboard.php");
        exit();
    }
    else
    {
        echo "Invalid Password";
    }
}
else
{
    echo "Admin Not Found";
}

?>