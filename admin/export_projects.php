<?php

session_start();

if(!isset($_SESSION['admin_id']))
{
    header("Location: login.php");
    exit();
}

include "../includes/db.php";

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="IndustryX_Projects.csv"');

$output = fopen("php://output", "w");

fputcsv($output, array(
    "Project ID",
    "Participant",
    "Competition",
    "Project Title",
    "Status",
    "Score",
    "Submitted At"
));

$sql = "
SELECT

projects.id,
projects.project_title,
projects.status,
projects.score,
projects.submitted_at,

users.name,

competitions.title AS competition_name

FROM projects

INNER JOIN users
ON projects.user_id = users.id

INNER JOIN competitions
ON projects.competition_id = competitions.id

ORDER BY projects.submitted_at DESC
";

$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($result))
{
    fputcsv($output, array(
        $row['id'],
        $row['name'],
        $row['competition_name'],
        $row['project_title'],
        $row['status'],
        $row['score'],
        $row['submitted_at']
    ));
}

fclose($output);
exit();

?>