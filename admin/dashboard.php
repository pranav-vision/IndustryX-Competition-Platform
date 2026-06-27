<?php

session_start();

if(!isset($_SESSION['admin_id']))
{
    header("Location: login.php");
    exit();
}

include "../includes/db.php";

/* Dashboard Statistics */

$user_count = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM users"))['total'];

$competition_count = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM competitions"))['total'];

$participant_count = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM competition_registrations"))['total'];

$project_count = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM projects"))['total'];

$pending_count = mysqli_fetch_assoc(
mysqli_query($conn,"SELECT COUNT(*) AS total FROM projects WHERE status='Pending'")
)['total'];

$approved_count = mysqli_fetch_assoc(
mysqli_query($conn,"SELECT COUNT(*) AS total FROM projects WHERE status='Approved'")
)['total'];

$rejected_count = mysqli_fetch_assoc(
mysqli_query($conn,"SELECT COUNT(*) AS total FROM projects WHERE status='Rejected'")
)['total'];

$competition_stats = mysqli_query($conn,"
SELECT

competitions.title,

COUNT(DISTINCT competition_registrations.user_id) AS participants,

COUNT(DISTINCT projects.id) AS projects

FROM competitions

LEFT JOIN competition_registrations
ON competitions.id = competition_registrations.competition_id

LEFT JOIN projects
ON competitions.id = projects.competition_id

GROUP BY competitions.id

ORDER BY competitions.title
");

$monthly_projects = mysqli_query($conn,"
SELECT

MONTHNAME(submitted_at) AS month,

COUNT(*) AS total

FROM projects

GROUP BY MONTH(submitted_at)

ORDER BY MONTH(submitted_at)
");

$months = [];
$totals = [];

while($row = mysqli_fetch_assoc($monthly_projects))
{
    $months[] = $row['month'];
    $totals[] = $row['total'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Admin Dashboard | IndustryX</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#1f2937;
}

.card{
    border:none;
    border-radius:15px;
}


</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

<div class="container mt-5">

<div class="d-flex justify-content-between align-items-center mb-4">

<div>

<h2 class="text-white">
Welcome,
<?php echo $_SESSION['admin_name']; ?>
</h2>

<p class="text-light">
IndustryX Competition Management System
</p>

</div>

<a href="logout.php" class="btn btn-danger">
Logout
</a>

</div>

<hr class="text-light">

<div class="row mb-4">

<div class="col-md-4">

<div class="alert alert-warning">

<h5>🔔 Pending Reviews</h5>

<h2><?php echo $pending_count; ?></h2>

</div>

</div>

<div class="col-md-4">

<div class="alert alert-success">

<h5>✅ Approved Projects</h5>

<h2><?php echo $approved_count; ?></h2>

</div>

</div>

<div class="col-md-4">

<div class="alert alert-danger">

<h5>❌ Rejected Projects</h5>

<h2><?php echo $rejected_count; ?></h2>

</div>

</div>

</div>

<!-- Navigation -->

<div class="mb-4">

<a href="create_competition.php" class="btn btn-primary me-2">
➕ Create Competition
</a>

<a href="competitions.php" class="btn btn-success me-2">
📋 Manage Competitions
</a>

<a href="participants.php" class="btn btn-warning me-2">
👥 Participants
</a>

<a href="submissions.php" class="btn btn-info text-white me-2">
📁 Project Submissions
</a>

<a href="export_projects.php"
class="btn btn-success me-2">

📥 Export CSV

</a>

<a href="../dashboard.php" class="btn btn-secondary">
🏠 User Dashboard
</a>


</div>

<!-- Statistics -->

<div class="row">

<div class="col-md-3 mb-4">

<div class="card shadow text-center p-4">

<h5>Total Users</h5>

<h1 class="text-primary">

<?php echo $user_count; ?>

</h1>

</div>

</div>

<div class="col-md-3 mb-4">

<div class="card shadow text-center p-4">

<h5>Competitions</h5>

<h1 class="text-success">

<?php echo $competition_count; ?>

</h1>

</div>

</div>

<div class="col-md-3 mb-4">

<div class="card shadow text-center p-4">

<h5>Participants</h5>

<h1 class="text-warning">

<?php echo $participant_count; ?>

</h1>

</div>

</div>

<div class="col-md-3 mb-4">

<div class="card shadow text-center p-4">

<h5>Projects</h5>

<h1 class="text-danger">

<?php echo $project_count; ?>

</h1>

</div>

</div>

</div>

<!-- Quick Information -->

<div class="card mt-3 shadow">

<div class="card-body">

<h4>
Quick Actions
</h4>

<p>

✔ Create and manage competitions.<br>

✔ View registered participants.<br>

✔ Monitor uploaded projects.<br>

✔ Manage the complete IndustryX competition platform.

</p>

</div>

</div>

</div>


<!-- Platform Statistics -->


<div class="card mt-5 shadow mx-auto" style="width:1300px;">

    <div class="card-body">


        <h3 class="text-center mb-4">
            Platform Statistics
        </h3>
        <div style="width:700px; height:350px; margin:auto;">

            <canvas id="dashboardChart"></canvas>

  
        </div>

    </div>

</div>


<script>

const ctx = document.getElementById('dashboardChart');

new Chart(ctx, {

    type: 'bar',

    data: {

        labels: [

            'Users',
            'Competitions',
            'Participants',
            'Projects'

        ],

        datasets: [{

            label: 'IndustryX Statistics',

            data: [

                <?php echo $user_count; ?>,
                <?php echo $competition_count; ?>,
                <?php echo $participant_count; ?>,
                <?php echo $project_count; ?>

            ],

            backgroundColor: [

                '#0d6efd',
                '#198754',
                '#ffc107',
                '#dc3545'

            ],

            borderColor: [

                '#0d6efd',
                '#198754',
                '#ffc107',
                '#dc3545'

            ],

            borderWidth: 5,

            borderRadius: 16,

            barThickness: 60

        }]

    },

    options: {

        responsive: true,

        maintainAspectRatio: false,

        plugins: {

            legend: {

                display: false

            }

        },

        scales: {

            y: {

                beginAtZero: true,

                ticks: {

                    stepSize: 1

                }

            }

        }

    }

});

</script>

<div class="container mt-5">

<div class="card shadow">

<div class="card-header">

<h3>
Competition Statistics
</h3>

</div>

<div class="card-body">

<table class="table table-striped">

<thead>

<tr>

<th>Competition</th>

<th>Participants</th>

<th>Projects</th>

</tr>

</thead>

<tbody>

<?php while($row = mysqli_fetch_assoc($competition_stats)){ ?>

<tr>

<td>

<?php echo htmlspecialchars($row['title']); ?>

</td>

<td>

<?php echo $row['participants']; ?>

</td>

<td>

<?php echo $row['projects']; ?>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</div>

<!-- Project Status Distribution -->

<div class="container mt-5">

<div class="card shadow mt-5">

<div class="card-body">

<h3 class="text-center mb-4">

🥧 Project Status Distribution

</h3>

<div style="width:350px; height:350px; margin:auto;">

<canvas id="statusChart"></canvas>

</div>

</div>

</div>

</div>
<script>

const statusCtx = document.getElementById('statusChart');

new Chart(statusCtx, {

type: 'pie',

data: {

labels: [

'Pending',

'Approved',

'Rejected'

],

datasets: [{

data: [

<?php echo $pending_count; ?>,

<?php echo $approved_count; ?>,

<?php echo $rejected_count; ?>



]

}]



},

options: {

responsive: true,

maintainAspectRatio: false,

plugins: {

legend: {

position: 'bottom'

}


}

}

});

</script>

<div class="card mt-5 shadow mx-auto" style="width:1300px;">

<div class="card shadow mt-5">

<div class="card-body">

<h3 class="text-center mb-4">

Monthly Project Submissions

</h3>

<canvas id="monthlyChart"></canvas>

</div>

</div>

<script>

const monthlyCtx = document.getElementById('monthlyChart');

new Chart(monthlyCtx,{

type:'line',

data:{

labels:<?php echo json_encode($months); ?>,

datasets:[{

label:'Projects Submitted',

data:<?php echo json_encode($totals); ?>,

fill:false,

tension:0.3,

pointRadius:8,

pointHoverRadius:12,

pointBorderWidth:2

}]


}

});

</script>

</body>

</html>