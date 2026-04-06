<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'voterdatabase');

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $cnic = mysqli_real_escape_string($conn, $_POST['cnic']);
  $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
  $pass = md5($_POST['pass']); // Hash the entered password

  $query = "SELECT * FROM voterregistration WHERE cnic='$cnic' AND mobile='$mobile' AND pass='$pass'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    $voterdata = mysqli_fetch_assoc($result);
    $_SESSION['voterdata'] = $voterdata;
    echo "<script>location='dashboard.php';</script>";
  } else {
    echo "<script>alert('Invalid CNIC, Mobile, or Password!'); window.location='index.html';</script>";
  }

  mysqli_close($conn);
}
