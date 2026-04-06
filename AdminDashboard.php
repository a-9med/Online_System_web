<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'voterdatabase');

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT * FROM addcandidate";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AdminDashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<style>
  .nav-item a {
    font-family: sans-serif;
  }

  ul a {
    display: flex;
    gap: 20px;
    list-style: none;
    padding: 0;
  }

  .nav-item a:hover {
    background: blueviolet;
    color: white;
    border-radius: 7px;
  }

  .image {
    height: 60vb;
    object-fit: cover;
    width: 100%;
  }
</style>

<body>

  <ul class="nav justify-content-center bg-dark " style=" padding: 20px;">
    <li class="nav-item">
    </li>
    <h1 style="font-family: sans-serif; color: blue;">Administrator Dashboard Online Voting System</h1>
  </ul>
  <nav class="navbar navbar-expand-lg  bg-light" style="position: static;">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"> <img src="images/userimage.png" width="20%"><b style="color: black;">Admin Panel</b></a>
      <button class="navbar-toggler navbar navbar-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#Header">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#Add Candidate">Add Candidate</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#Total">Total Candidate</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="logout.php">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div id="Header">
    <img src="images/aivote.webp" alt="Voting Banner" class="image">
  </div>
  <br><br>

  <div class="container-fluid" id="Add Candidate" style="box-shadow: 2px 2px 10px rgba(0,0,0,0.9); padding: 40px;">
    <div class="row">
      <div class="col-sm-8">
        <h2 style=" text-align:center"> <span style="background: mediumblue;color:whitesmoke;padding: 10px;border-radius:10px;">Add Candidate For Election</span> </h2><br>

        <form action="AddCandidate.php" method="post" enctype="multipart/form-data">
          <div class="row">
            <div class="col-sm-6">
              <div class="mb-3">
                <label class="form-label">Candidate Name</label>
                <input type="text" class="form-control" name="cname" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Party Name</label>
                <input type="text" class="form-control" name="cparty" required>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="mb-3">
                <label class="form-label">Symbol (Image)</label>
                <input type="file" class="form-control" name="symbol" accept="image/*" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Candidate Photo</label>
                <input type="file" class="form-control" name="photo" accept="image/*" required>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>

      </div>
      <div class="col-sm-4">
        <img src="images/uescase.png" width="100%">
      </div>
    </div>
  </div>
  <br><br><br>

  <div class="container my-5" id="Total">
    <h2 class="text-center mb-4"><span class="bg-primary text-white p-2 rounded">List of Candidates</span></h2>
    <div class="table-responsive">
      <table class="table table-bordered table-striped">
        <thead class="table-dark">
          <tr>
            <th>Candidate Name</th>
            <th>Party</th>
            <th>Symbol</th>
            <th>Photo</th>
            <th>Total Votes</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
          ?>
              <tr>
                <td><?php echo $row['cname']; ?></td>
                <td><?php echo $row['cparty']; ?></td>
                <td><img src="<?php echo $row['symbol']; ?>" width="60" height="60" style="border-radius: 10px; object-fit: cover;"></td>
                <td><img src="<?php echo $row['photo']; ?>" width="60" height="60" style="border-radius: 10px; object-fit: cover;"></td>
                <td><?php echo isset($row['votes']) ? $row['votes'] : '0'; ?></td>
              </tr>
          <?php
            }
          } else {
            echo '<tr><td colspan="5" class="text-center">No candidates found</td></tr>';
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php mysqli_close($conn); ?>