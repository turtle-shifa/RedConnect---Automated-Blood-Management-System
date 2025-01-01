<?php
session_start();
require_once('DBconnect.php');

$phone_number = $_SESSION['current_user_phone_number'];
$todayDate = date("Y-m-d");

$sql = "UPDATE donors SET total_donation = total_donation+1, last_donation_date = '$todayDate' WHERE phone_number = '$phone_number'";

$result = mysqli_query($conn, $sql);
header("Location: user_dashboard.php");
exit();
?>