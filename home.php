<?php
require_once('DBconnect.php');
session_start();

if (isset($_SESSION['current_user_phone_number'])){
	$current_user_phone_number = $_SESSION['current_user_phone_number'];
	$sql = "SELECT * FROM donors WHERE phone_number = '$current_user_phone_number'";
	$query = mysqli_query($conn, $sql);

	if (mysqli_num_rows($query) > 0) {
    	$user = mysqli_fetch_assoc($query);

    	$name = $user['name'];
    	$_SESSION['name'] = $name;
	}

} else{
	header("Location: sign_in.php");
	exit();
}
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Red Connect</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<style>
    	body {
	      margin: 0;
	      padding: 0;
	      background-image: url('index_banner_image.jpg');
	      backdrop-filter: blur(3px);
	      background-size: cover;
	      background-repeat: no-repeat;
	      background-position: center;
	      height: 100vh;
  	}
	</style>
</head>
<body>
	<header>
		<nav class="navbar navbar-expand-lg bg-danger border-body" data-bs-theme="dark">
		  <div class="container-fluid">
		    <a class="navbar-brand fw-bold fs-3" href="home.php">Red Connect</a>
		    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		      <span class="navbar-toggler-icon"></span>
		    </button>
		    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
		      <ul class="navbar-nav">
		        <li class="nav-item">
		          <a class="nav-link active fw-semibold" aria-current="page" href="home.php">Home</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link active fw-semibold" href="donors_signin.php">Donors</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link active fw-semibold" href="search_signin.php">Search</a>
		        </li>
		        <li class="nav-item dropdown">
          			<a class="nav-link dropdown-toggle active fw-semibold" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?php echo $name ?></a>
          			<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
			            <li><a class="dropdown-item" href="user_dashboard.php">Dashboard</a></li>
			            <li><a class="dropdown-item" href="user_update_profile.php">Update Profile</a></li>
			            <li><a class="dropdown-item" href="user_change_password.php">Change Password</a></li>
			            <li><hr class="dropdown-divider"></li>
			            <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
          			</ul>
        		</li>
		        <li class="nav-item">
		          <a class="nav-link active fw-semibold" href="about_us_signin.php">About Us</a>
		        </li>
		      </ul>
		    </div>
		  </div>
		</nav>
	</header>

	<main>
		<br>
		<div class="container">
		  <div class="row justify-content-center">
		    <div class="col-md-8">
		      <blockquote class="blockquote text-center bg-light p-4 border rounded">
		        <p class="mb-0 fw-bold text-danger fs-3"><?php echo "Welcome, $name"; ?>
		        <br><br><div class="fw-semibold fs-3">
		    		"Your little effort can give others a second chance to live life."</div></p>
		      </blockquote>
		    </div>
		  </div>
		</div>

	</main>


	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>