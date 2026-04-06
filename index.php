<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Form</title>
  <link rel="stylesheet" href="style.css" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>

<body>
  <div class="wrapper">
    <form action="login.php" method="post">
      <h1>Login Form</h1>
      <div class="input-box">
        <div class="input-field">
          <label>Enter CNIC Number <span>*</span></label>
          <input
            type="text"
            placeholder="Enter CNIC Number"
            name="cnic"
            required />
          <i class="fa-solid fa-address-card"></i>
        </div>
      </div>
      <div class="input-box">
        <div class="input-field">
          <label>Enter Mobile Number <span>*</span></label>
          <input
            type="text"
            placeholder="Enter Mobile Number"
            name="mobile"
            required />
          <i class="fa-solid fa-mobile-screen-button"></i>
        </div>
      </div>
      <div class="input-box">
        <div class="input-field">
          <label>Enter Password <span>*</span></label>
          <input
            type="password"
            placeholder="Enter Password"
            name="pass"
            required />
          <i class="fa-solid fa-lock"></i>
        </div>
      </div>
      <button type="submit" class="btn">Login</button>
    </form>
    <p style="text-align: center; margin-top: 30px">
      No account?
      <a href="registration_form\code.php" style="color: black">Register</a>
    </p>
  </div>
  <script src="script.js"></script>
</body>

</html>