<?php

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "industryx_db"
);

if(!$conn){
    die("Database Connection Failed");
}

?>