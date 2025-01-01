<?php
session_start();
require_once('DBconnect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phoneNumber = $_POST['phone_number'];
    $bloodGroup = $_POST['bloodGroup'];
    $city = $_POST['city'];
    $availabilityStatus = $_POST['availabilityStatus'];
    $phone_number = $_SESSION['current_user_phone_number'];
    if ($phone_number == $phoneNumber){
        $sql = "UPDATE donors SET phone_number = '$phoneNumber', blood_group = '$bloodGroup', city = '$city', availability_status = '$availabilityStatus' WHERE phone_number = '$phone_number'";
        $result = mysqli_query($conn, $sql);
        $_SESSION['current_user_phone_number'] = $phoneNumber;
        header("Location: user_dashboard.php");
        
    } else{
        $checkPhoneSql = "SELECT * FROM donors WHERE phone_number = '$phoneNumber'";
        $checkPhoneSqlResult = mysqli_query($conn, $checkPhoneSql);
        if (mysqli_num_rows($checkPhoneSqlResult) > 0){
            $_SESSION['status'] = "exist";
        } else{
            $sql = "UPDATE donors SET phone_number = '$phoneNumber', blood_group = '$bloodGroup', city = '$city', availability_status = '$availabilityStatus' WHERE phone_number = '$phone_number'";
            $result = mysqli_query($conn, $sql);
            $_SESSION['current_user_phone_number'] = $phoneNumber;
            header("Location: user_dashboard.php");
        }

    }
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
        <!-- update form start -->
        <div class="container mt-5">
            <div class="card shadow">
                <div class="card-body">

                    <h5 class="card-title mb-4 fs-3 fw-bold text-danger">Update Information</h5>

                    <form action="user_update_profile.php" method="post">
                        <div class="row g-3">
                            <!-- Phone Number -->
                            <div class="col-md-12 mb-3">
                                <label for="phoneNumber" class="form-label fw-bold text-danger">Phone Number</label>
                                <input type="text" class="form-control fw-semibold" placeholder="01⨯⨯⨯⨯⨯⨯⨯⨯⨯" name="phone_number" required>
                            </div>

                            <!-- Blood Group -->
                            <div class="col-md-12 mb-3">
                                <label for="password" class="form-label fw-bold text-danger">Blood Group</label>
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

                            <!-- City -->
                            <div class="col-md-12 mb-3">
                                <label for="email" class="form-label fw-bold text-danger">City</label>
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
                            <div class="col-md-12 mb-3">
                                <label for="email" class="form-label fw-bold text-danger">Availability Status</label>
                                <select class="form-select" id="availabilityStatus" name="availabilityStatus" required>
                                    <option value="" selected disabled>Choose...</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>

                        </div>

                        <div class="d-flex mt-4">
                            <button type="submit" class="btn btn-danger px-4">
                                <div class="fw-semibold">Update</div>
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <!-- update form end -->

        <?php if (isset($_SESSION['status'])){
            if ($_SESSION['status'] == 'exist'){?>
            <br>
            <div class="alert alert-danger alert-dismissible fade show ps-3 pe-3 w-50 mx-auto" role="alert">
                    <div class ="fw-bold text-dark">
                        This phone number is already registered with an existing user. Please update it with a new phone number.
                    </div>
            </div>
            <?php }unset($_SESSION['status']);}?>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>