<?php
require_once('DBconnect.php');
session_start();

$a_pos_sql = "SELECT count(*) AS count FROM donors WHERE blood_group = 'A+' AND eligible = 'Yes'";
$a_neg_sql = "SELECT count(*) AS count FROM donors WHERE blood_group = 'A-' AND eligible = 'Yes'";
$b_pos_sql = "SELECT count(*) AS count FROM donors WHERE blood_group = 'B+' AND eligible = 'Yes'";
$b_neg_sql = "SELECT count(*) AS count FROM donors WHERE blood_group = 'B-' AND eligible = 'Yes'";
$o_pos_sql = "SELECT count(*) AS count FROM donors WHERE blood_group = 'O+' AND eligible = 'Yes'";
$o_neg_sql = "SELECT count(*) AS count FROM donors WHERE blood_group = 'O-' AND eligible = 'Yes'";
$ab_pos_sql = "SELECT count(*) AS count FROM donors WHERE blood_group = 'AB+' AND eligible = 'Yes'";
$ab_neg_sql = "SELECT count(*) AS count FROM donors WHERE blood_group = 'AB-' AND eligible = 'Yes'";


$a_pos_query = mysqli_query($conn,$a_pos_sql);
$a_neg_query = mysqli_query($conn,$a_neg_sql);
$b_pos_query = mysqli_query($conn,$b_pos_sql);
$b_neg_query = mysqli_query($conn,$b_neg_sql);
$o_pos_query = mysqli_query($conn,$o_pos_sql);
$o_neg_query = mysqli_query($conn,$o_neg_sql);
$ab_pos_query = mysqli_query($conn,$ab_pos_sql);
$ab_neg_query = mysqli_query($conn,$ab_neg_sql);


$count_a_pos = mysqli_fetch_assoc($a_pos_query);
$count_a_neg = mysqli_fetch_assoc($a_neg_query);
$count_b_pos = mysqli_fetch_assoc($b_pos_query);
$count_b_neg = mysqli_fetch_assoc($b_neg_query);
$count_o_pos = mysqli_fetch_assoc($o_pos_query);
$count_o_neg = mysqli_fetch_assoc($o_neg_query);
$count_ab_pos = mysqli_fetch_assoc($ab_pos_query);
$count_ab_neg = mysqli_fetch_assoc($ab_neg_query);


?>




<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Red Connect</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<style>
    	
  	.rounded-box {
            padding: 20px;
            border-radius: 15px;
            border: 2px solid white; 
            color: white;
            font-size: 1.5rem;
    }.box-green {
            background-color: #28a745; /* Green color */
    }.box-red {
            background-color: #dc3545; /* Red color */
    }
	</style>
</head>
<body>
	<header>
		<nav class="navbar navbar-expand-lg bg-danger border-body" data-bs-theme="dark">
		  <div class="container-fluid">
		    <a class="navbar-brand fw-bold fs-3" href="admin_dashboard.php">Admin Dashboard</a>
		    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		      <span class="navbar-toggler-icon"></span>
		    </button>
		    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
		      <ul class="navbar-nav">
		        <li class="nav-item">
		          <a class="nav-link active fw-semibold" aria-current="page" href="admin_dashboard.php">Dashboard</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link active fw-semibold" href="admin_donate.php">Donate</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link active fw-semibold" href="admin_donors.php">Donors</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link active fw-semibold" href="admin_search.php">Search</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link active fw-semibold" href="index.php">Logout</a>
		        </li>
		      </ul>
		    </div>
		  </div>
		</nav>
	</header>

	<main>
		<div class="container mt-5">
			<div class="row g-3">
				<div class="col-md-3">
		            <div class="rounded-box box-red">
		                <h3 class="fw-semibold-light">A+</h3>
		                    <h1 class="fw-bold fs-1"><?php echo $count_a_pos['count'] ?></h1>
		            </div>
		        </div>

		        <div class="col-md-3">
		            <div class="rounded-box box-red">
		                <h3 class="fw-semibold-light">A-</h3>
		                    <h1 class="fw-bold fs-1"><?php echo $count_a_neg['count'] ?></h1>
		            </div>
		        </div>

		        <div class="col-md-3">
		            <div class="rounded-box box-red">
		                <h3 class="fw-semibold-light">B+</h3>
		                    <h1 class="fw-bold fs-1"><?php echo $count_b_pos['count'] ?></h1>
		            </div>
		        </div>
		        <div class="col-md-3">
		            <div class="rounded-box box-red">
		                <h3 class="fw-semibold-light">B-</h3>
		                    <h1 class="fw-bold fs-1"><?php echo $count_b_neg['count'] ?></h1>
		            </div>
		        </div>
		    </div>
		</div>

		<div class="container mt-4">
			<div class="row g-3">
				<div class="col-md-3">
		            <div class="rounded-box box-red">
		                <h3 class="fw-semibold-light">O+</h3>
		                    <h1 class="fw-bold fs-1"><?php echo $count_o_pos['count'] ?></h1>
		            </div>
		        </div>

		        <div class="col-md-3">
		            <div class="rounded-box box-red">
		                <h3 class="fw-semibold-light">O-</h3>
		                    <h1 class="fw-bold fs-1"><?php echo $count_o_neg['count'] ?></h1>
		            </div>
		        </div>

		        <div class="col-md-3">
		            <div class="rounded-box box-red">
		                <h3 class="fw-semibold-light">AB+</h3>
		                    <h1 class="fw-bold fs-1"><?php echo $count_ab_pos['count'] ?></h1>
		            </div>
		        </div>
		        <div class="col-md-3">
		            <div class="rounded-box box-red">
		                <h3 class="fw-semibold-light">AB-</h3>
		                    <h1 class="fw-bold fs-1"><?php echo $count_ab_neg['count'] ?></h1>
		            </div>
		        </div>
		    </div>
		</div>

	</main>


	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>