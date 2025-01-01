<?php
require_once('DBconnect.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$city = $_POST['city'];
	$blood_group = $_POST['blood_group'];

	$sql = "SELECT name, city, blood_group, phone_number FROM donors WHERE city = '$city' AND blood_group = '$blood_group' AND eligible = 'Yes'";
	$query = mysqli_query($conn, $sql);


	if ($query && mysqli_num_rows($query) > 0) {
		$results = $query->fetch_all(MYSQLI_ASSOC);
	} else {
	    $error = "No records found.";
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
		<!-- Search box and its all staffs start -->
		<div class="container mt-5">
	        <div class="card shadow">
	            <div class="card-body">
	          
	                <h5 class="card-title text-center mb-4 fs-5 fw-semi-light text-danger">Search for Heroes by <b>City</b> and <b>Blood Type</b></h5>
	                
	                <form action="search.php" method="post">
	                    <div class="row g-3">
	                        <!-- City -->
	                        <div class="col-md-6">
	                            <label for="city" class="form-label fw-semibold text-danger">City</label>
	                            <select id="city" name="city" class="form-select" required>
						            <option value="" selected disabled>Choose...</option>
			              			<option value="Bagerhat">Bagerhat</option>
						            <option value="Bandarban">Bandarban</option>
				                    <option value="Barguna">Barguna</option>
				                    <option value="Barisal">Barisal</option>
				                    <option value="Bhola">Bhola</option>
				                    <option value="Bogra">Bogra</option>
				                    <option value="Brahmanbaria">Brahmanbaria</option>
				                    <option value="Chandpur">Chandpur</option>
				                    <option value="Chittagong">Chittagong</option>
				                    <option value="Chuadanga">Chuadanga</option>
				                    <option value="Comilla">Comilla</option>
				                    <option value="Cox's Bazar">Cox's Bazar</option>
				                    <option value="Dhaka">Dhaka</option>
				                    <option value="Dinajpur">Dinajpur</option>
				                    <option value="Faridpur">Faridpur</option>
				                    <option value="Feni">Feni</option>
				                    <option value="Gaibandha">Gaibandha</option>
				                    <option value="Gazipur">Gazipur</option>
				                    <option value="Gopalganj">Gopalganj</option>
				                    <option value="Habiganj">Habiganj</option>
				                    <option value="Jamalpur">Jamalpur</option>
				                    <option value="Jessore">Jessore</option>
				                    <option value="Jhalokati">Jhalokati</option>
				                    <option value="Jhenaidah">Jhenaidah</option>
				                    <option value="Joypurhat">Joypurhat</option>
				                    <option value="Khagrachari">Khagrachari</option>
				                    <option value="Khulna">Khulna</option>
				                    <option value="Kishoreganj">Kishoreganj</option>
				                    <option value="Kurigram">Kurigram</option>
				                    <option value="Kushtia">Kushtia</option>
				                    <option value="Lakshmipur">Lakshmipur</option>
				                    <option value="Lalmonirhat">Lalmonirhat</option>
				                    <option value="Madaripur">Madaripur</option>
				                    <option value="Magura">Magura</option>
				                    <option value="Manikganj">Manikganj</option>
				                    <option value="Meherpur">Meherpur</option>
				                    <option value="Moulvibazar">Moulvibazar</option>
				                    <option value="Munshiganj">Munshiganj</option>
				                    <option value="Mymensingh">Mymensingh</option>
				                    <option value="Naogaon">Naogaon</option>
				                    <option value="Narail">Narail</option>
				                    <option value="Narayanganj">Narayanganj</option>
				                    <option value="Narsingdi">Narsingdi</option>
				                    <option value="Natore">Natore</option>
				                    <option value="Netrokona">Netrokona</option>
				                    <option value="Nilphamari">Nilphamari</option>
				                    <option value="Noakhali">Noakhali</option>
				                    <option value="Pabna">Pabna</option>
				                    <option value="Panchagarh">Panchagarh</option>
				                    <option value="Patuakhali">Patuakhali</option>
				                    <option value="Pirojpur">Pirojpur</option>
				                    <option value="Rajbari">Rajbari</option>
				                    <option value="Rajshahi">Rajshahi</option>
				                    <option value="Rangamati">Rangamati</option>
				                    <option value="Rangpur">Rangpur</option>
				                    <option value="Satkhira">Satkhira</option>
				                    <option value="Shariatpur">Shariatpur</option>
				                    <option value="Sherpur">Sherpur</option>
				                    <option value="Sirajganj">Sirajganj</option>
				                    <option value="Sunamganj">Sunamganj</option>
				                    <option value="Sylhet">Sylhet</option>
				                    <option value="Tangail">Tangail</option>
				                    <option value="Thakurgaon">Thakurgaon</option>
			        			</select>
	                        </div>

	                        <!-- Blood Group -->
	                        <div class="col-md-6">
	                            <label for="bloodGroup" class="form-label fw-semibold text-danger">Blood Group</label>
	                            <select class="form-select" id="bloodGroup" name="blood_group" required>
	                                <option value="" selected disabled>Select blood group</option>
	                                <option value="A+">A+</option>
	                                <option value="A-">A-</option>
	                                <option value="B+">B+</option>
	                                <option value="B-">B-</option>
	                                <option value="O+">O+</option>
	                                <option value="O-">O-</option>
	                                <option value="AB+">AB+</option>
	                                <option value="AB-">AB-</option>
	                            </select>
	                        </div>
	                    </div>

	                    <div class="d-flex justify-content-center mt-4">
	                        <button type="submit" class="btn btn-danger px-4">
	                        	<div class="fw-semibold">Search</div></button>
	                    </div>
	                </form>
	            
	            </div>
	        </div>
	    </div>
	    <!-- Search box and its all staffs end -->

	    <?php if (!empty($results)){?>
			<div class="table-responsive mt-4">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-dark">
                    	<tr>
		                    <th>Name</th>
		                    <th>City</th>
		                    <th>Blood Group</th>
		                    <th>Phone Number</th>
				        </tr>
				    </thead>
				    <tbody>
		                <?php foreach ($results as $row){?>
		                    <tr>
		                        <td><?php echo htmlspecialchars($row['name']); ?></td>
		                        <td><?php echo htmlspecialchars($row['city']); ?></td>
		                        <td><?php echo htmlspecialchars($row['blood_group']); ?></td>
		                        <td><?php echo htmlspecialchars($row['phone_number']); ?></td>
		                    </tr>
		                <?php } ?>
		            </tbody>
		        </table>
		    </div>

		<?php } elseif (isset($error)){ ?>
			<br>
			<div class="alert alert-warning alert-dismissible fade show ps-3 pe-3 w-50 mx-auto" role="alert">
				    <div class ="fw-semibold text-dark">
						<?php echo $error; ?>
					</div>
			</div>
        <?php } ?>

	</main>


	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>