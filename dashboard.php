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

$voterdata = $_SESSION['voterdata'];

// Fetch candidates
$query = "SELECT * FROM addcandidate";
$result = mysqli_query($conn, $query);

$status = ($voterdata['status'] == 0) ? '<b style="color:green;">Not Voted</b>' : '<b style="color:red;">Voted</b>';

// Get the photo path from database
$stored_photo = $voterdata['photo'];

// Try multiple possible paths
$possible_paths = [
  $stored_photo,                           // Original stored path
  str_replace('../', '', $stored_photo),   // Remove ../
  'uploads/' . basename($stored_photo),    // Just the filename in uploads folder
  '../uploads/' . basename($stored_photo), // Go up one level then to uploads
];

// Find the first path that exists
$voter_photo = 'images/default-avatar.png'; // Default fallback
foreach ($possible_paths as $path) {
  if (file_exists($path)) {
    $voter_photo = $path;
    break;
  }
}

// For debugging - you can remove this after testing
$debug_info = "Stored path: " . $stored_photo;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard - Online Voting System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/5/w3.css">
  <style>
    body {
      background-color: #f8f9fa;
      min-height: 100vh;
    }

    .navbar-dark .navbar-brand,
    .navbar-dark .nav-link {
      color: whitesmoke;
    }

    .navbar-dark .nav-link:hover {
      background: blue;
      border-radius: 7px;
      color: whitesmoke;
    }

    .carousel-item img {
      height: 70vh;
      object-fit: cover;
      width: 100%;
    }

    .content-container {
      max-width: 1200px;
      margin: 30px auto;
      background: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);
    }

    .carousel-caption {
      background-color: rgba(0, 0, 0, 0.5);
      padding: 10px 20px;
      border-radius: 10px;
    }

    .voter-photo {
      width: 100px;
      height: 100px;
      object-fit: cover;
      border-radius: 50%;
    }
  </style>
</head>

<body>

  <!-- Sidebar for Admin Login -->
  <div class="w3-sidebar w3-bar-block w3-card w3-animate-right" style="display:none;right:0; width:400px; height:100%; background: white; z-index: 999;" id="rightMenu">
    <button onclick="closeRightMenu()" class="w3-bar-item w3-button w3-large w3-red">Close &times;</button>
    <div class="container p-4">
      <h2 class="text-center">Admin Login</h2>
      <hr>
      <form action="adminlogin.php" method="post">
        <div class="mb-3">
          <label class="form-label">Admin Name</label>
          <input type="text" class="form-control" name="name" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Password</label>
          <input type="password" class="form-control" name="password" required>
        </div>
        <div class="d-grid">
          <button class="btn btn-primary" type="submit">Login</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Navbar -->
  <nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><i class="fa-regular fa-envelope"></i> Online Voting System</a>
      <ul class="nav justify-content-center">
        <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Search</a><i class="fa-solid fa-magnifying-glass ms-1"></i></li>
        <li class="nav-item"><a class="nav-link" href="#">Contact Us</a><i class="fa-regular fa-envelope ms-1"></i></li>
      </ul>
      <form class="d-flex">
        <a class="btn btn-outline-success" onclick="openRightMenu()"><i class="fa fa-fw fa-user"></i> Admin Login</a>
      </form>
    </div>
  </nav>

  <!-- Carousel -->
  <div id="carouselExampleCaptions" class="carousel slide mt-4" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="images/niceone.webp" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h2>Welcome to the Online Voting System</h2>
        </div>
      </div>
    </div>
  </div>

  <div class="container-fluid content-container">
    <div class="row">
      <!-- Voter Details Card -->
      <div class="col-sm-4">
        <div class="card mb-3">
          <div class="card-header bg-warning text-dark text-center">Voter Information</div>
          <div class="row g-0">
            <div class="col-md-4 text-center p-3">
              <img src="<?php echo $voter_photo; ?>" class="voter-photo" alt="Voter Photo" onerror="this.onerror=null; this.alt='Image not found'; this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22100%22 height=%22100%22 viewBox=%220 0 100 100%22%3E%3Crect width=%22100%22 height=%22100%22 fill=%22%23ddd%22/%3E%3Ctext x=%2250%22 y=%2250%22 text-anchor=%22middle%22 dy=%22.3em%22 fill=%22%23999%22%3ENo Photo%3C/text%3E%3C/svg%3E';">
              <!-- Debug info - remove after fixing -->
              <small class="text-muted d-block mt-1" style="font-size: 10px;">Path: <?php echo basename($voter_photo); ?></small>
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title text-primary">Voter Details</h5>
                <p class="card-text">
                  <strong>Name:</strong> <?php echo $voterdata['name']; ?><br>
                  <strong>Mobile:</strong> <?php echo $voterdata['mobile']; ?><br>
                  <strong>CNIC:</strong> <?php echo $voterdata['cnic']; ?><br>
                  <strong>Status:</strong> <?php echo $status; ?>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Candidates Table -->
      <div class="col-sm-8">
        <div class="card">
          <div class="card-header bg-primary text-white text-center">
            <marquee style="color: white;">You can only vote for ONE candidate</marquee>
          </div>
          <div class="card-body">
            <table class="table table-bordered table-hover">
              <thead class="table-dark">
                <tr>
                  <th>Candidate Details</th>
                  <th>Symbol</th>
                  <th>Photo</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) {
                  $candidate_photo = str_replace('../', '', $row['photo']);
                  $candidate_symbol = str_replace('../', '', $row['symbol']);
                ?>
                  <tr>
                    <td>
                      <strong>Name:</strong> <?php echo $row['cname']; ?><br>
                      <strong>Party:</strong> <?php echo $row['cparty']; ?><br>
                    </td>
                    <td><img src="<?php echo $candidate_symbol; ?>" width="80" height="80" style="border-radius: 10px; object-fit: cover;" onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2280%22 height=%2280%22%3E%3Crect width=%2280%22 height=%2280%22 fill=%22%23ddd%22/%3E%3Ctext x=%2240%22 y=%2240%22 text-anchor=%22middle%22 dy=%22.3em%22 fill=%22%23999%22%3ENo Symbol%3C/text%3E%3C/svg%3E';"></td>
                    <td><img src="<?php echo $candidate_photo; ?>" width="80" height="80" style="border-radius: 10px; object-fit: cover;" onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2280%22 height=%2280%22%3E%3Crect width=%2280%22 height=%2280%22 fill=%22%23ddd%22/%3E%3Ctext x=%2240%22 y=%2240%22 text-anchor=%22middle%22 dy=%22.3em%22 fill=%22%23999%22%3ENo Photo%3C/text%3E%3C/svg%3E';"></td>
                    <td>
                      <?php if ($voterdata['status'] == 0) { ?>
                        <form action="vote.php" method="post">
                          <input type="hidden" name="gid" value="<?php echo $row['id']; ?>">
                          <button type="submit" class="btn btn-danger">Vote</button>
                        </form>
                      <?php } else { ?>
                        <button class="btn btn-secondary" disabled>Voted</button>
                      <?php } ?>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function openRightMenu() {
      document.getElementById("rightMenu").style.display = "block";
    }

    function closeRightMenu() {
      document.getElementById("rightMenu").style.display = "none";
    }
  </script>
</body>

</html>
<?php mysqli_close($conn); ?>