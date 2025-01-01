<?php
require_once('DBconnect.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$search_phone_number = $_POST['search_phone_number'];
	
	$sql = "SELECT * FROM donors WHERE phone_number = '$search_phone_number'";
	$query = mysqli_query($conn, $sql);

	if ($query && mysqli_num_rows($query) > 0) {
		$results = $query->fetch_all(MYSQLI_ASSOC);
	} else {
		$error = "Empty records.";
	}
}else{
	$sql = "SELECT * FROM donors";
	$query = mysqli_query($conn, $sql);

	if ($query && mysqli_num_rows($query) > 0) {
		$results = $query->fetch_all(MYSQLI_ASSOC);
	} else {
		$error = "Empty records.";
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
	          
	                <h5 class="card-title  mb-4 fs-3 fw-bold text-danger">All Registered Donors</h5>
	                
	                <form action="admin_donors.php" method="post">
	                    <div class="row g-3">
	                        <!-- Phone Number -->
	                        <div class="col-md-6 d-flex justify-content-center">
	                            <label for="city" class="form-label fw-bold text-danger"></label>
	                            <input type="text" class="form-control fw-semibold" placeholder="Search using a phone number." name="search_phone_number" required>
	                        </div>
	                    </div>

	                    <div class="d-flex mt-4">
	                        <button type="submit" class="btn btn-danger px-4">
	                        	<div class="fw-semibold">Search</div></button>
	                    </div>
	                </form>
	            
	            </div>
	        </div>
	    </div>

	    <?php if (!empty($results)){?>
			<div class="table-responsive mt-4">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-dark">
                    	<tr>
		                    <th>Name</th>
		                    <th>Gender</th>
		                    <th>DOB</th>
		                    <th>Blood Group</th>
		                    <th>Phone Number</th>
		                    <th>Password</th>
		                    <th>City</th>
		                    <th>Last Donation Date</th>
		                    <th>Availability Status</th>
		                    <th>Total Donation</th>
		                    <th>Eligibility Status</th>
		                    <th>Update</th>
		                    <th>Delete</th>
				        </tr>
				    </thead>
				    <tbody>
				    	<?php
		                foreach ($results as $row){ ?>
		                    <tr>
		                        <td><?php echo htmlspecialchars($row['name']); ?></td>
		                        <td><?php echo htmlspecialchars($row['gender']); ?></td>
		                        <td><?php echo htmlspecialchars($row['date_of_birth']); ?></td>
		                        <td><?php echo htmlspecialchars($row['blood_group']); ?></td>
		                        <td><?php echo htmlspecialchars($row['phone_number']); ?></td>
		                        <td><?php echo htmlspecialchars($row['password']); ?></td>
		                        <td><?php echo htmlspecialchars($row['city']); ?></td>
		                        <td><?php echo htmlspecialchars($row['last_donation_date']); ?></td>
		                        <td><?php echo htmlspecialchars($row['availability_status']); ?></td>
		                        <td><?php echo htmlspecialchars($row['total_donation']); ?></td>
		                        <td><?php echo htmlspecialchars($row['eligible']); ?></td>
		                        <td>
		                        	<?php echo '<a href="admin_user_update.php?phone_number=' . $row['phone_number'] . '">
		                        	<img width="20" height="20" src="icons8-pen-32.png"></a>' ?>
		                        </td>
		                        
		                        <td>
		                        	<?php echo '<a href="admin_user_delete.php?phone_number=' . $row['phone_number'] . '">
		                        		<img width="20" height="20" src="icons8-delete-16.png"></a>' ?>
		                        </td>
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