<?php
session_start();
if (!isset($_SESSION['admin_data'])) {
  echo "<script>alert('Please login as admin first!'); window.location='dashboard.php';</script>";
  exit();
}

$conn = mysqli_connect('localhost', 'root', '', 'voterdatabase');

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $cname = mysqli_real_escape_string($conn, $_POST['cname']);
  $cparty = mysqli_real_escape_string($conn, $_POST['cparty']);

  // Create directories if they don't exist
  $symbol_dir = "uploads/symbols/";
  $photo_dir = "uploads/candidates/";

  if (!is_dir($symbol_dir)) {
    mkdir($symbol_dir, 0777, true);
  }
  if (!is_dir($photo_dir)) {
    mkdir($photo_dir, 0777, true);
  }

  // Upload symbol
  $symbol_name = time() . "_sym_" . basename($_FILES["symbol"]["name"]);
  $symbol_path = $symbol_dir . $symbol_name;

  // Upload photo
  $photo_name = time() . "_can_" . basename($_FILES["photo"]["name"]);
  $photo_path = $photo_dir . $photo_name;

  // Try to upload files
  $symbol_upload = move_uploaded_file($_FILES["symbol"]["tmp_name"], $symbol_path);
  $photo_upload = move_uploaded_file($_FILES["photo"]["tmp_name"], $photo_path);

  if ($symbol_upload && $photo_upload) {
    $sql = "INSERT INTO addcandidate (cname, cparty, symbol, photo) VALUES ('$cname', '$cparty', '$symbol_path', '$photo_path')";

    if (mysqli_query($conn, $sql)) {
      echo "<script>alert('Candidate Added Successfully!'); window.location='AdminDashboard.php';</script>";
    } else {
      echo "<script>alert('Database Error: " . mysqli_error($conn) . "'); window.location='AdminDashboard.php';</script>";
    }
  } else {
    $error_msg = "";
    if (!$symbol_upload) $error_msg .= "Symbol upload failed. ";
    if (!$photo_upload) $error_msg .= "Photo upload failed. ";
    echo "<script>alert('Error uploading files: " . $error_msg . "'); window.location='AdminDashboard.php';</script>";
  }
}
mysqli_close($conn);
