<?php

function logActivity($conn, $admin_name, $action)
{
    $admin_name = mysqli_real_escape_string($conn, $admin_name);
    $action = mysqli_real_escape_string($conn, $action);

    mysqli_query($conn,"
        INSERT INTO admin_logs(admin_name, action)
        VALUES('$admin_name','$action')
    ");
}

?>