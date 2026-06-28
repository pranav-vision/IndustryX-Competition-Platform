<?php

include 'includes/db.php';

$sql = "SELECT
users.name,
competitions.title AS competition,
projects.project_title,
projects.score,
projects.status

FROM projects

INNER JOIN users
ON projects.user_id = users.id

INNER JOIN competitions
ON projects.competition_id = competitions.id

WHERE projects.status='Approved'

ORDER BY projects.score DESC";

$result = mysqli_query($conn,$sql);

?>

<!DOCTYPE html>

<html>

<head>

<title>Leaderboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
background:#0f172a;
color:white;
}

.rank{
font-size:22px;
font-weight:bold;
}

</style>

</head>

<body>

<div class="container mt-5">

<h1 class="text-center mb-4">
🏆 IndustryX Leaderboard
</h1>

<table class="table table-bordered table-hover table-light">

<thead>

<tr>

<th>Rank</th>

<th>Participant</th>

<th>Competition</th>

<th>Project</th>

<th>Score</th>

<th>Status</th>

</tr>

</thead>

<tbody>

<?php

$rank=1;

while($row=mysqli_fetch_assoc($result))
{

?>

<tr>

<td class="rank">

<?php

if($rank==1)
echo "🥇";

elseif($rank==2)
echo "🥈";

elseif($rank==3)
echo "🥉";

else
echo $rank;

?>

</td>

<td>

<?php echo htmlspecialchars($row['name']); ?>

</td>

<td>

<?php echo htmlspecialchars($row['competition']); ?>

</td>

<td>

<?php echo htmlspecialchars($row['project_title']); ?>

</td>

<td>

<?php echo $row['score']; ?>/100

</td>

<td>

<?php echo $row['status']; ?>

</td>

</tr>

<?php

$rank++;

}

?>

</tbody>

</table>

</div>
<script src="assets/js/script.js"></script>
</body>

</html>