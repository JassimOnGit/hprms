<?php require_once '../config.php'; ?>

<!DOCTYPE html>
<html lang="en" class="" style="height: auto;">
<?php require_once 'inc/header.php'; ?>
<body class="hold-transition" style="background-color: #007BFF;">
  <script>
    start_loader();
  </script>
  <style>
    body, html {
      height: 100%;
      margin: 0;
    }
    #register {
      background: url('<?= validate_image($_settings->info('logo')) ?>') no-repeat center center fixed;
      background-size: cover;
    }
    .form-container {
      background: rgba(255, 255, 255, 0.8);
      border-radius: 10px;
      padding: 20px;
    }
    .login-title {
      color: #000;
    }
  </style>
  <div class="h-100 d-flex align-items-center w-100" id="register">
    <div class="col-12 h-100 d-flex align-items-center justify-content-center">
      <div class="w-100 form-container">
        <h1 class="text-center py-5 login-title"><b><?php echo $_settings->info('name'); ?></b></h1>      
        <div class="card col-sm-12 col-md-6 col-lg-3 card-outline card-teal rounded-0 shadow mx-auto">
          <div class="card-header rounded-0">
            <h4 class="text-purple text-center"><b>Registration Form</b></h4>
          </div>
          <div class="card-body rounded-0">
            <?php
              if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $conn = new mysqli('localhost', 'root', '', 'hprms_db');
                if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
                }

                $first_name = $_POST['first_name'];
                $last_name = $_POST['last_name'];
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = md5($_POST['password']);
                $mobile = $_POST['mobile'];

                $sql = "INSERT INTO users (firstname, lastname, username, email, password, mobile) VALUES ('$first_name', '$last_name', '$username', '$email', '$password', '$mobile')";

                if ($conn->query($sql) === TRUE) {
                  echo "<p style='color: green; font-weight: bold;'>Thank you, new record created successfully! Go back to sign-in.</p>";
                } else {
                  echo "Error: " . $sql . "<br>" . $conn->error;
                }

                $conn->close();
              }
            ?>
            <form id="register-frm" action="" method="post">
              <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" id="first_name" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" id="last_name" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="confirm_email">Confirm Email</label>
                <input type="email" name="confirm_email" id="confirm_email" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="mobile">Mobile Number</label>
                <input type="tel" name="mobile" id="mobile" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
              </div>
              <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
              <a href="login.php" class="btn btn-secondary btn-block btn-flat">Sign In</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<script>
  $(document).ready(function(){
    end_loader();
  });

  // Form validation
  document.getElementById('register-frm').addEventListener('submit', function(event) {
    var emailInput = document.getElementById('email');
    var confirmEmailInput = document.getElementById('confirm_email');
    var mobileInput = document.getElementById('mobile');
    var passwordInput = document.getElementById('password');
    var confirmPasswordInput = document.getElementById('confirm_password');

    // Email validation
    if (!validateEmail(emailInput.value)) {
      event.preventDefault();
      alert('Invalid email format!');
      return false;
    }

    // Confirm email validation
    if (emailInput.value !== confirmEmailInput.value) {
      event.preventDefault();
      alert('Emails do not match!');
      return false;
    }

    // Mobile number validation
    if (!validateMobile(mobileInput.value)) {
      event.preventDefault();
      alert('Mobile number must be 11 digits!');
      return false;
    }

    // Password validation
    if (!validatePassword(passwordInput.value)) {
      event.preventDefault();
      alert('Password must be at least 6 characters long!');
      return false;
    }

    // Confirm password validation
    if (passwordInput.value !== confirmPasswordInput.value) {
      event.preventDefault();
      alert('Passwords do not match!');
      return false;
    }
  });

  // Email validation function
  function validateEmail(email) {
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
  }

  // Mobile number validation function
  function validateMobile(mobile) {
    var re = /^\d{11}$/;
    return re.test(mobile);
  }

  // Password validation function
  function validatePassword(password) {
    return password.length >= 6;
  }
</script>
</body>
</html>
