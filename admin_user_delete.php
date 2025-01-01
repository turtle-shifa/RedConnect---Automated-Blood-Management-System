<?php
require_once('DBconnect.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$selected_phone_number = $_SESSION['$selected_phone_number'];
	$delete_sql = "DELETE FROM donors WHERE phone_number = '$selected_phone_number'";
	mysqli_query($conn,$delete_sql);
	unset($_SESSION['$selected_phone_number']);
	header("Location: admin_donors.php");
	exit();
}

$selected_phone_number = $_GET['phone_number'];
$_SESSION['$selected_phone_number'] = $selected_phone_number;
$sql = "SELECT * FROM donors WHERE phone_number = '$selected_phone_number'";
$query = mysqli_query($conn,$sql);
$result = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Red Connect</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
	        <div class="card shadow">
	            <div class="card-body">
	          
	                <h5 class="card-title  mb-4 fs-3 fw-bold text-danger">Do you really want to delete the user where the phone number is <?php echo $result['phone_number'] ?> and the user name is <?php echo 
	                $result['name']?>?</h5>
	                
	                <form action="admin_user_delete.php" method="post">
	                    <div class="d-flex mt-4">
	                        <button type="submit" class="btn btn-danger px-4">
	                        	<div class="fw-semibold">Delete</div></button>
	                    </div>
	                </form>
	            
	            </div>
	        </div>
	    </div>
	</main>
</body>
</html>