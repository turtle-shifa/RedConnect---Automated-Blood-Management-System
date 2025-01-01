<?php
require_once('DBconnect.php');
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