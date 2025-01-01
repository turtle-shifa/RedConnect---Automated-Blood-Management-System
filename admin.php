<?php
require_once('DBconnect.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$user_name = $_POST['username'];
	$password = $_POST['password'];

	if ($user_name == 'team_redconnect' && $password == 'redconnect@'){
		header("Location: admin_dashboard.php");
		exit();
	} else {
	    $error = "Incorrect username or password.";
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
</head>
<body>
	<main>
		<!-- sign in form start -->
		<div class="container mt-5">
	        <div class="card shadow">
	            <div class="card-body">
	          
	                <h5 class="card-title  mb-4 fs-3 fw-bold text-danger">Admin</h5>
	                
	                <form action="admin.php" method="post">
	                    <div class="row g-3">
	                        <!-- Phone Number -->
	                        <div class="col-md-6">
	                            <label for="city" class="form-label fw-bold text-danger">Username</label>
	                            <input type="text" class="form-control fw-semibold" placeholder="Secret username" name="username" required>
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


        <div class="container mt-5">
	        <div class="card shadow">
	            <div class="card-body">	          
	                <h5>
	                	<a href="index.php" style="text-decoration: none;"> 
	                		<div class="card-title fs-3 fw-bold text-danger text-center">
	                			Return to the home page -->
	                		</div>
	                	</a>		
	                </h5>	  
	            </div>
	        </div>
	    </div>

	</main>


	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>