<?php
session_start();
require_once('DBconnect.php');

$phone_number = $_SESSION['current_user_phone_number'];

$sql = "SELECT * FROM donors WHERE phone_number = '$phone_number'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
}

$name = $user['name'];
$total_donation = $user['total_donation'];
$last_donation_date = $user['last_donation_date'];
$availability_status = $user['availability_status'];


if ($last_donation_date == "0000-00-00") {
    $date_remain = 0;
} else {
    $today = new DateTime();
    $last_donation = new DateTime($last_donation_date);
    $interval = $today->diff($last_donation);
    
    $total_days = $interval->days;

    if ($total_days < 90) {
        $date_remain = 90 - $total_days;
    } else {
        $date_remain = 0;
    }
}

if ($date_remain > 0) {
    // $status = "Not Eligible for donating blood";
    $status = "not_eligible";
    $updateSql = "UPDATE donors SET eligible = 'No' WHERE phone_number = '$phone_number'";
    mysqli_query($conn, $updateSql);

} elseif ($availability_status == 'Yes') {
    // $status = "Eligible for donating blood";
    $status = "eligible";
    $updateSql = "UPDATE donors SET eligible = 'Yes' WHERE phone_number = '$phone_number'";
    mysqli_query($conn, $updateSql);

} elseif ($availability_status == 'No') {
    // $status = "You are eligible to donate blood, but your availability status is currently set to 'Not Available.'";
    $status = "eligible_but_not_available";
    $updateSql = "UPDATE donors SET eligible = 'Yes_No' WHERE phone_number = '$phone_number'";
    mysqli_query($conn, $updateSql);
}


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile Dashboard - Red Connect</title>
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
        .rounded-box {
            padding: 20px;
            border-radius: 15px;
            border: 2px solid white; 
            color: white;
            font-size: 1.5rem;
        }
        .box-green {
            background-color: #28a745; /* Green color */
        }
        .box-red {
            background-color: #dc3545; /* Red color */
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
        <div class="container mt-5">
            <div class="row g-4">
                <!-- Red Box -->
                <!-- #1 -->
                <?php if ($status == "not_eligible"){?>
                    <div class="col-md-6">
                        <div class="rounded-box box-red">
                            <h3 class="fw-semibold-light">You are eligible to donate blood after</h3>
                            <h1 class="fw-bold fs-1"><?php echo ($date_remain)." Days"?></h1>
                            <button type="button" class="btn btn-light">
                                <span class="fw-semibold">Status: Not Eligible</span>
                                <span class="badge rounded-pill bg-light text-dark"></span>
                            </button>
                        </div>
                    </div>

                    <!-- Green Box -->
                    <div class="col-md-6">
                        <div class="rounded-box box-green">
                            <h3 class="fw-semibold-light">Your total number of donations</h3>
                            <h1 class="fw-bold fs-1"><?php echo ($total_donation)." Days"?></h1>
                        </div>
                    </div>
                
                <!-- #2 -->
                <?php }elseif ($status == "eligible") {?>
                    <div class="col-md-6">
                        <div class="rounded-box box-green">
                            <h3 class="fw-semibold-light">You are now eligible to donate blood.</h3>
                            <button type="button" class="btn btn-light">
                                <span class="fw-semibold">Status: Eligible</span>
                                <span class="badge rounded-pill bg-light text-dark"></span>
                            </button>
                        </div>
                    </div>

                    <!-- Green Box -->
                    <div class="col-md-6">
                        <div class="rounded-box box-green">
                            <h3 class="fw-semibold-light">Your total number of donations</h3>
                            <h1 class="fw-bold fs-1"><?php echo ($total_donation)." Days"?></h1>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="rounded-box box-green">
                            <h3 class="fw-semibold">By donating today, I saved a life.</h3>
                            <form action="count_me_in.php" method="post">
                                <button type="submit" class="btn btn-light">
                                    <span class="fw-semibold">Count me in</span>
                                    <span class="badge rounded-pill bg-light text-dark"></span>
                                </button>
                            </form>
                        </div>
                    </div>
                
                <!-- #3 -->
                <?php }elseif ($status == "eligible_but_not_available"){?>
                    <div class="col-md-6">
                        <div class="rounded-box box-red">
                            <h3 class="fw-semibold-light">You are eligible to donate blood, but your availability status is currently set to 'Not Available'.</h3>
                            <button type="button" class="btn btn-light">
                                <span class="fw-semibold">Status: Eligible</span>
                                <span class="badge rounded-pill bg-light text-dark"></span>
                            </button>
                        </div>
                    </div>

                    <!-- Green Box -->
                    <div class="col-md-6">
                        <div class="rounded-box box-green">
                            <h3 class="fw-semibold-light">Your total number of donations</h3>
                            <h1 class="fw-bold fs-1"><?php echo ($total_donation)." Days"?></h1>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

    


    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>