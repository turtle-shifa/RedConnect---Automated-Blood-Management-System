<?php
require_once('DBconnect.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$fullName = $_POST['fullName'];
	$gender = $_POST['gender'];
	$dob = $_POST['dob'];
	$bloodGroup = $_POST['bloodGroup'];
	$phoneNumber = $_POST['phoneNumber'];
	$city = $_POST['city'];
	$lastDonationDate = $_POST['lastDonationDate'];
	$availabilityStatus = $_POST['availabilityStatus'];
	$password = $_POST['password'];
	$terms = $_POST['terms'];

	$todayDate = date("Y-m-d");
	$todayObj = new DateTime($todayDate);
	$birthDateObj = new DateTime($dob);
	$lastDonationDateObj = new DateTime($lastDonationDate);

	// eligibility_check
	if ($lastDonationDate == "") {
    	$date_remain = 0;
    } else {
    	$difference = $todayObj->diff($lastDonationDateObj);
    	$total_days = $difference->days;

    	if ($total_days < 90) {
        	$date_remain = 90 - $total_days;
    	} else {
        	$date_remain = 0;
    	}
    }


	$interval = $todayObj->diff($birthDateObj);
	$years = $interval->y;


	$checkPhoneSql = "SELECT * FROM donors WHERE phone_number = '$phoneNumber'";
	$checkPhoneSqlResult = mysqli_query($conn, $checkPhoneSql);
	$affectedRow = mysqli_num_rows($checkPhoneSqlResult);



	if ($years>=18 and $affectedRow==0){
		$_SESSION['status'] = "Your details have been successfully saved in our database.";
		

		if (0<$date_remain && $date_remain<90) {
			$eligible = "No";
		} elseif ($date_remain>=90 or $date_remain==0) { 
			// etto aghe dichi
			if ($availabilityStatus == 'Yes'){
    			$eligible = "Yes";
    		}else{
    			$eligible = "Yes_No";
    		}
		}

		$eligible_after_days = $date_remain;
		$sql = "INSERT INTO donors VALUES ('$fullName', '$gender', '$dob', '$bloodGroup', '$phoneNumber', '$city', 
			'$lastDonationDate', '$availabilityStatus', '$password',0,'$eligible')";
		$result = mysqli_query($conn, $sql);
	}
	elseif ($affectedRow>0) {
		$_SESSION['status'] = "Your phone number is already registered.";
	}
	elseif ($years<18) {
		$_SESSION['status'] = "You are ineligible to donate blood as you are under 18.";
	}
}?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Red Connect</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<style>
		/*donor form additional css*/
	    .form-container {
	      border: 2px solid #FF0000;
	      border-radius: 10px;
	      padding: 15px;
	      background-color: #ffffff;
	      width: 100%;
	      max-width: 1000px;
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
		<br>
		<!-- From heading text added -->
		<div class="text-center">
			<h2 class="fw-bold text-danger">"Be a hero, give the gift of life-donate blood today!"</h2>
			<h5 class="text-decoration-none fw-light">Complete the form to begin!</h5>
		</div>

		<!-- Error section handling -->
		<?php 
		if (isset($_SESSION['status'])) {
		    if ($_SESSION['status'] == "Your details have been successfully saved in our database.") {?>
		    	
		    	<br>
				<div class="alert alert-success alert-dismissible fade show ps-3 pe-3 w-50 mx-auto" role="alert">
				    <div class ="fw-semibold">
						Your details have been successfully saved in our database.
					</div>
				</div>
				<?php
		        unset($_SESSION['status']);

		    }elseif ($_SESSION['status'] == "Your phone number is already registered.") {?>

		    	<br>
				<div class="alert alert-danger alert-dismissible fade show ps-3 pe-3 w-50 mx-auto" role="alert">
				    <div class ="fw-semibold">
						Your phone number is already registered.
					</div>
				</div>
				<?php
				unset($_SESSION['status']);
		    
		    } elseif ($_SESSION['status'] == "You are ineligible to donate blood as you are under 18."){?>
		    	<br>
				<div class="alert alert-danger alert-dismissible fade show ps-3 pe-3 w-50 mx-auto" role="alert">
				    <div class ="fw-semibold">
						You are ineligible to donate blood as you are under 18.
					</div>
				</div>
				<?php
				unset($_SESSION['status']);
			}
		}
		?>

		<!-- Full Form -->
		<div class="d-flex justify-content-center">
		    <div class="form-container">
		        <form action="admin_donate.php" method="post">
		            <div class="row">
		                <div class="col-md-6">
		                    
		                    <!-- Full Name -->
		                    <div class="mb-3 text-start">
		                        <label for="fullName" class="form-label fw-semibold">Full Name</label>
		                        <input type="text" class="form-control" id="fullName" name="fullName" placeholder="Enter your full name" required>
		                    </div>

		                    <!-- Gender -->
		                    <div class="mb-3 text-start">
		                        <label for="gender" class="form-label fw-semibold">Gender</label>
		                        <select class="form-select" id="gender" name="gender" required>
		                            <option value="" selected disabled>Choose...</option>
		                            <option value="Male">Male</option>
		                            <option value="Female">Female</option>
		                            <option value="Other">Other</option>
		                        </select>
		                    </div>

		                    <!-- Blood Group -->
		                    <div class="mb-3 text-start">
		                        <label for="bloodGroup" class="form-label fw-semibold">Blood Group</label>
		                        <select class="form-select" id="bloodGroup" name="bloodGroup" required>
		                            <option value="" selected disabled>Choose...</option>
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

		                    <!-- Phone Number -->
		                    <div class="mb-3 text-start">
		                        <label for="phoneNumber" class="form-label fw-semibold">Phone Number</label>
		                        <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="Enter your phone number" required>
		                    </div>

		                    <!-- Last Donation Date -->
		                    <div class="mb-3 text-start">
		                        <label for="lastDonationDate" class="form-label fw-semibold">Last Donation Date</label>
		                        <input type="date" class="form-control" id="lastDonationDate" name="lastDonationDate">
		                    </div>
		                </div>

		                <div class="col-md-6">

		                    <!-- Date of Birth -->
		                    <div class="mb-3 text-start">
		                        <label for="dob" class="form-label fw-semibold">Date of Birth</label>
		                        <input type="date" class="form-control" id="dob" name="dob" required>
		                    </div>

		                    <!-- City -->
		                    <div class="mb-3 text-start">
		                        <label for="city" class="form-label fw-semibold">City</label>
		                        <select class="form-select" id="city" name="city" required>
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

		                    <!-- Availability Status -->
		                    <div class="mb-3 text-start">
		                        <label for="availabilityStatus" class="form-label fw-semibold">Availability Status</label>
		                        <select class="form-select" id="availabilityStatus" name="availabilityStatus" required>
		                            <option value="" selected disabled>Choose...</option>
		                            <option value="Yes">Yes</option>
		                            <option value="No">No</option>
		                        </select>
		                    </div>

		                    <!-- Password -->
		                    <div class="mb-3 text-start">
		                        <label for="password" class="form-label fw-semibold">Password</label>
		                        <input type="password" class="form-control" id="password" name="password" placeholder="Create a password" required>
		                    </div>

		                    <!-- Terms and Conditions -->
		                    <div class="mb-3 form-check text-start">
		                        <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
		                        <label class="form-check-label fw-semibold" for="terms">I agree to the terms and conditions</label>
		                    </div>

		                    <!-- Submit Button -->
		                    <div class = "text-start">
		                    	<button type="submit" class="btn btn-danger fw-semibold ">Submit</button>
		                    </div>
		                </div>
		            </div>
		        </form>
		    </div>
		</div>

	</main>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>