<?php
require_once('DBconnect.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$phone_number = $_POST['phone_number'];
	$password = $_POST['password'];

	$sql = "SELECT * FROM donors WHERE phone_number = '$phone_number' AND password = '$password'";
	$query = mysqli_query($conn, $sql);


	if ($query && mysqli_num_rows($query) > 0) {
		$_SESSION['state'] = true;
		$_SESSION['current_user_phone_number'] = $phone_number;
		header("Location: home.php");
		exit();
	} else {
	    $error = "Incorrect phone number or password.";
	}
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
		    <a class="navbar-brand fw-bold fs-3" href="index.php">Red Connect</a>
		    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		      <span class="navbar-toggler-icon"></span>
		    </button>
		    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
		      <ul class="navbar-nav">
		        <li class="nav-item">
		          <a class="nav-link active fw-semibold" aria-current="page" href="index.php">Home</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link active fw-semibold" href="donate.php">Donate</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link active fw-semibold" href="donors.php">Donors</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link active fw-semibold" href="search.php">Search</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link active fw-semibold" href="sign_in.php">Sign in</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link active fw-semibold" href="about_us.php">About Us</a>
		        </li>
		      </ul>
		    </div>
		  </div>
		</nav>
	</header>

	<main>
		<!-- sign in form start -->
		<div class="container mt-5">
	        <div class="card shadow">
	            <div class="card-body">
	          
	                <h5 class="card-title  mb-4 fs-3 fw-bold text-danger">Sign in</h5>
	                
	                <form action="sign_in.php" method="post">
	                    <div class="row g-3">
	                        <!-- Phone Number -->
	                        <div class="col-md-6">
	                            <label for="city" class="form-label fw-bold text-danger">Phone Number</label>
	                            <input type="text" class="form-control fw-semibold" placeholder="01⨯⨯⨯⨯⨯⨯⨯⨯⨯" name="phone_number" required>
	                        </div>

	                        <!-- Password -->
	                        <div class="col-md-6">
	                            <label for="bloodGroup" class="form-label fw-bold text-danger">Password</label>
	                            <input type="password" class="form-control fw-semibold" placeholder="**************" name="password" required>
	                        </div>
	                    </div>

	                    <div class="d-flex mt-4">
	                        <button type="submit" class="btn btn-danger px-4">
	                        	<div class="fw-semibold">Sign in</div></button>
	                    </div>
	                </form>
	            
	            </div>
	        </div>
	    </div>
	    <!-- sign in form end -->

		<?php if (isset($error)){ ?>
            <br>
			<div class="alert alert-danger alert-dismissible fade show ps-3 pe-3 w-50 mx-auto" role="alert">
				    <div class ="fw-bold text-dark">
						<?php echo $error; ?>
					</div>
			</div>
        <?php } ?>


	</main>


	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>