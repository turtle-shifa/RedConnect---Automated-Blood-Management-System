<?php
session_start();
require_once('DBconnect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
   
    $phone_number = $_SESSION['current_user_phone_number'];
    

    $sql = "SELECT * FROM donors WHERE phone_number = '$phone_number' AND password = '$currentPassword'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0){
        $updateSQL = "UPDATE donors SET password = '$newPassword' WHERE phone_number = '$phone_number'";
        mysqli_query($conn, $updateSQL);
        header("Location: user_dashboard.php");
    } else{
        $_SESSION['status'] = 'mismatch';
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

                    <form action="user_change_password.php" method="post">
                        <div class="row g-3">
                            <!-- cpass -->
                            <div class="col-md-12 mb-3">
                                <label for="phoneNumber" class="form-label fw-bold text-danger">Current Password</label>
                                <input type="password" class="form-control fw-semibold" placeholder="*********" name="current_password" required>
                            </div>
                            <!-- npass -->
                            <div class="col-md-12 mb-3">
                                <label for="phoneNumber" class="form-label fw-bold text-danger">New Password</label>
                                <input type="password" class="form-control fw-semibold" placeholder="*********" name="new_password" required>
                            </div>

                        <div class="d-flex mt-4">
                            <button type="submit" class="btn btn-danger px-4">
                                <div class="fw-semibold">Change</div>
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <!-- update form end -->

        <?php if (isset($_SESSION['status'])){
            if ($_SESSION['status'] == 'mismatch'){?>
            <br>
            <div class="alert alert-danger alert-dismissible fade show ps-3 pe-3 w-50 mx-auto" role="alert">
                    <div class ="fw-bold text-dark">
                        Invalid current password.
                    </div>
            </div>
            <?php }unset($_SESSION['status']);}?>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>