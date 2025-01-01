<?php
require_once('DBconnect.php');
session_start();
$sql = "SELECT name, gender, blood_group, phone_number, city FROM donors WHERE eligible = 'Yes'";
$query = mysqli_query($conn, $sql);

if ($query && mysqli_num_rows($query) > 0) {
	$results = $query->fetch_all(MYSQLI_ASSOC);
} else {
	$error = "Empty records.";
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
          			<a class="nav-link dropdown-toggle active fw-semibold" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?php echo $_SESSION['name'] ?></a>
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

		<div class="text-center mt-4 mb-4">
			<h2 class="fw-bold text-white">All Registered Donors</h2>
		</div>

	    <?php if (!empty($results)){?>
			<div class="table-responsive mt-4">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-dark">
                    	<tr>
		                    <th>Name</th>
		                    <th>Gender</th>
		                    <th>Blood Group</th>
		                    <th>Phone Number</th>
		                    <th>City</th>
				        </tr>
				    </thead>
				    <tbody>
				    	<?php
		                foreach ($results as $row){?>
		                    <tr>
		                        <td><?php echo htmlspecialchars($row['name']); ?></td>
		                        <td><?php echo htmlspecialchars($row['gender']); ?></td>
		                        <td><?php echo htmlspecialchars($row['blood_group']); ?></td>
		                        <td><?php echo htmlspecialchars($row['phone_number']); ?></td>
		                        <td><?php echo htmlspecialchars($row['city']); ?></td>
		                    </tr>
		                <?php } ?>
		            </tbody>
		        </table>
		    </div>

		<?php } elseif (isset($error)){ ?>
            <div class="alert alert-warning mt-4"><?php echo $error; ?></div>
        <?php } ?>


	</main>


	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>