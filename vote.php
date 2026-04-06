<?php
session_start();
if (!isset($_SESSION['voterdata'])) {
  echo "<script>location='index.html';</script>";
  exit();
}

$conn = mysqli_connect('localhost', 'root', '', 'voterdatabase');

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $gid = (int)$_POST['gid'];
  $uid = $_SESSION['voterdata']['id'];

  // Check if voter has already voted
  if ($_SESSION['voterdata']['status'] == 1) {
    echo "<script>alert('You have already voted!'); window.location='dashboard.php';</script>";
    exit();
  }

  // Get current votes for this candidate (ensures we always use correct value)
  $get_votes = mysqli_query($conn, "SELECT votes FROM addcandidate WHERE id = $gid");
  if (!$get_votes || mysqli_num_rows($get_votes) == 0) {
    echo "<script>alert('Candidate not found!'); window.location='dashboard.php';</script>";
    exit();
  }
  $row = mysqli_fetch_assoc($get_votes);
  $new_votes = $row['votes'] + 1;

  // Update candidate votes (only the selected candidate)
  $update_votes = mysqli_query($conn, "UPDATE addcandidate SET votes = $new_votes WHERE id = $gid");

  // Update voter status
  $update_user_status = mysqli_query($conn, "UPDATE voterregistration SET status = 1 WHERE id = $uid");

  if ($update_votes && $update_user_status) {
    $_SESSION['voterdata']['status'] = 1;
    echo "<script>alert('Voting Successful!'); window.location='dashboard.php';</script>";
  } else {
    echo "<script>alert('Error: " . mysqli_error($conn) . "'); window.location='dashboard.php';</script>";
  }
}
mysqli_close($conn);
