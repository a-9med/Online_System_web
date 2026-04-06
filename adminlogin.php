<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'voterdatabase');

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $password = md5($_POST['password']); // Hash the entered password

  $query = "SELECT * FROM adminlogin WHERE name='$name' AND password='$password'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    $admin_data = mysqli_fetch_assoc($result);
    $_SESSION['admin_data'] = $admin_data;
    echo "<script>location='AdminDashboard.php';</script>";
  } else {
    echo "<script>alert('Incorrect Information! You are not an Administrator'); window.location='dashboard.php';</script>";
  }

  mysqli_close($conn);
}
