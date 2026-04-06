<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'voterdatabase');

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
  $dob = $_POST['dob'];
  $gender = $_POST['gender'];
  $idtype = mysqli_real_escape_string($conn, $_POST['idtype']);
  $cnic = mysqli_real_escape_string($conn, $_POST['cnic']);
  $issue = $_POST['issue'];
  $expire = !empty($_POST['expire']) ? "'" . $_POST['expire'] . "'" : "NULL";
  $pass = md5($_POST['pass']);
  $cpass = md5($_POST['cpass']);

  if ($pass != $cpass) {
    echo "<script>alert('Passwords do not match!'); window.location='code.php';</script>";
    exit();
  }

  $check = mysqli_query($conn, "SELECT * FROM voterregistration WHERE email='$email' OR mobile='$mobile' OR cnic='$cnic'");
  if (mysqli_num_rows($check) > 0) {
    echo "<script>alert('Email, Mobile, or CNIC already registered!'); window.location='code.php';</script>";
    exit();
  }

  $target_dir = "../uploads/";
  if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);
  }

  $photo_name = time() . "_" . basename($_FILES["photo"]["name"]);
  $target_file = $target_dir . $photo_name;

  if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
    $photo_path = "uploads/" . $photo_name;
  } else {
    echo "<script>alert('Error uploading photo!'); window.location='code.php';</script>";
    exit();
  }

  $sql = "INSERT INTO voterregistration (name, email, mobile, dob, photo, gender, idtype, cnic, pass, issue, expire) 
            VALUES ('$name', '$email', '$mobile', '$dob', '$photo_path', '$gender', '$idtype', '$cnic', '$pass', '$issue', $expire)";

  if (mysqli_query($conn, $sql)) {
    echo "<script>alert('Registration Successful! Please login.'); window.location='../index.html';</script>";
  } else {
    echo "<script>alert('Error: " . mysqli_error($conn) . "'); window.location='code.php';</script>";
  }
}
mysqli_close($conn);
