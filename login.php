<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Amazon.lk | Sign In</title>
  <link rel="stylesheet" href="style files/style.css">
  <link rel="stylesheet" href="bootstrap_files/bootstrap.css">
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

  <link rel="shortcut icon" href="resourcesofwebsiteimg/icon.svg" type="image/x-icon">

  <style>
    body {
      background-image: url('resourcesofwebsiteimg/login_signup_back.jpg');
      background-repeat: no-repeat;
      background-size: cover;
    }

    .login-container {
      max-width: 400px;
      margin: auto;
      margin-top: 40px;
    }

    .login-form {
      background-color: lightgrey;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    .form-group {
      margin-bottom: 20px;
    }

    .btn-combined {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .btn-combined button {
      flex-grow: 1;
    }

    .head {
      background-color: #000;
    }

    .disabled-link {
            pointer-events: none;
            opacity: 0.65;
            cursor: not-allowed;
        }
  </style>
</head>

<body>
  <div class="head">
    <?php require 'header_main.php'; ?><br>
  </div>
  <div class="login-container offset-md-2">

    <form class="login-form">
      <div class="col-12 pt-2">

        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">> <a href="index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Sign In</li>
          </ol>
        </nav>
      </div>
      <hr />
      <h2 class="text-center mb-4">Sign In</h2>
      <?php
      $email = "";
      $password = "";

      if (isset($_COOKIE["email"])) {
        $email = $_COOKIE["email"];
      }

      if (isset($_COOKIE["password"])) {
        $password = $_COOKIE["password"];
      }
      ?>

      <div class="form-group">
        <label for="username"><i class="fa-solid fa-user"></i> Email:</label>
        <input type="text" class="form-control" id="email2" placeholder="Enter your email" required>
      </div>
      <div class="form-group">
        <label for="password"><i class="fa-solid fa-lock"></i> Password:</label>
        <input type="password" class="form-control" id="password2" placeholder="Enter your password" required>
      </div>
      <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="rememberme">
        <label class="form-check-label" for="rememberMe">Remember Me</label>
        <a href="#" class="float-right offset-2" onclick="forgotPassword();" id="myAnchor">Forgot Password?</a>
      </div><br>
      <a class="btn btn-warning btn-block col-12" onclick="signin();">Sign In</a>

      <div class="btn-combined">
        <a href="registor.php" class="btn btn-info col-12 btn-danger">New to Amazon? Join us</a> <br><br><!--  -->
      </div>

      <a href="seller_login.php"><button type="button" class="btn btn-secondary col-12">Seller Login</button></a>

    </form>

  </div><br>


  <!-- modal -->
  <div class="modal" tabindex="-1" id="fpmodal" style="background-color:  rgba(0, 0, 0, 0.49);">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Forgot Password</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <div class="row g-3">

            <div class="col-6">
              <label class="form-label">New Password</label>
              <div class="input-group mb-3">
                <input type="password" class="form-control" id="np" />
                <button id="npb" class="btn btn-outline-secondary" type="button" onclick="showPassword1();">Show</button>
              </div>
            </div>

            <div class="col-6">
              <label class="form-label">Re-type Password</label>
              <div class="input-group mb-3">
                <input type="password" class="form-control" id="rnp" />
                <button id="rnpb" class="btn btn-outline-secondary" type="button" onclick="showPassword2();">Show</button>

              </div>
            </div>

            <div class="col-12">
              <label class="form-label">Verification Code</label>
              <input type="text" class="form-control" id="vcode" />
            </div>

          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-warning" onclick="resetPassword();">Reset</button>
        </div>
      </div>
    </div>
  </div>

  <footer>
    <div class="justify-content-center align-items-center d-flex">
      <p class="text-center text-black">Copyright © 2024 Amazone.lk</p>

    </div>
    <br>
  </footer>

  <?php require 'footer.php'; ?>
  <script>
    // Function to disable the anchor tag
    function disableAnchor() {
            var anchor = document.getElementById("myAnchor");
            anchor.classList.add("disabled-link"); // Add the disabled-link class for styling
        }
  </script>
  <script src="script.js"></script>
  <script src="https://kit.fontawesome.com/f4e0ff3f68.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>