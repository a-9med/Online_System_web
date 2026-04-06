<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registration Form</title>
  <link rel="stylesheet" href="code.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>

<body>
  <div class="wrapper">
    <form action="index.php" method="post" enctype="multipart/form-data">
      <h1>Registration Form</h1>
      <span class="title">Personal Details</span>
      <div class="input-box">
        <div class="input-field">
          <label>Full Name <span>*</span></label>
          <input type="text" placeholder="Full Name" name="name" required />
          <i class="fa-regular fa-user"></i>
        </div>
        <div class="input-field">
          <label>Email <span>*</span></label>
          <input type="email" placeholder="Email" name="email" required />
          <i class="fa-regular fa-envelope"></i>
        </div>
        <div class="input-field">
          <label>Mobile Number <span>*</span></label>
          <input type="tel" placeholder="Mobile Number" name="mobile" required />
          <i class="fa-solid fa-mobile-screen-button"></i>
        </div>
      </div>
      <div class="input-box">
        <div class="input-field">
          <label>Date of Birth <span>*</span></label>
          <input type="date" name="dob" required />
        </div>
        <div class="input-field">
          <label>Picture <span>*</span></label>
          <input type="file" name="photo" accept="image/*" required />
          <i class="fa-regular fa-image"></i>
        </div>
        <div class="input-field">
          <label>Gender <span>*</span></label>
          <select required name="gender">
            <option disabled selected>Select Gender</option>
            <option>Male</option>
            <option>Female</option>
          </select>
        </div>
      </div>
      <span class="title">Identity Details</span>
      <div class="input-box">
        <div class="input-field">
          <label>ID Type <span>*</span></label>
          <input type="text" placeholder="Enter ID type" name="idtype" required />
          <i class="fa-solid fa-address-card"></i>
        </div>
        <div class="input-field">
          <label>ID Number <span>*</span></label>
          <input type="text" placeholder="Enter ID number" name="cnic" required />
          <i class="fa-solid fa-address-card"></i>
        </div>
        <div class="input-field">
          <label>Password <span>*</span></label>
          <input type="password" placeholder="Password" name="pass" required />
          <i class="fa-solid fa-lock"></i>
        </div>
      </div>
      <div class="input-box">
        <div class="input-field">
          <label>Confirm Password <span>*</span></label>
          <input type="password" placeholder="Confirm Password" name="cpass" required />
          <i class="fa-solid fa-lock"></i>
        </div>
        <div class="input-field">
          <label>Issued Date <span>*</span></label>
          <input type="date" name="issue" required />
        </div>
        <div class="input-field">
          <label>Expiry Date (optional)</label>
          <input type="date" name="expire" />
        </div>
      </div>
      <label>
        <input type="checkbox" required /> I hereby declare that the above information is true and correct
      </label>
      <button type="submit" class="btn">Register</button>
    </form>

  </div>
  <script src="script.js"></script>
</body>

</html>