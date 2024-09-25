<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amazon.lk | Seller Registor</title>
    <link rel="stylesheet" href="style files/style.css">
    <link rel="stylesheet" href="bootstrap_files/bootstrap.css">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="resourcesofwebsiteimg/icon.svg" type="image/x-icon"> 

    <style>
    body {
      background-image: url('resourcesofwebsiteimg/login-back.avif');
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
  </style>
</head>
<body>
<div class="login-container offset-md-2">
  
  <form class="login-form">
    
  <div class="col-12 pt-2">
    
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">> <a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Sign Up</li>
                        </ol>
                    </nav>
                </div><hr/>
    <h2 class="text-center mb-4">Seller Registor</h2>

    <div class="form-group">
      <label for="username"><i class="fa-solid fa-user"></i> User name:</label>
      <input type="text" class="form-control" id="uname" placeholder="Enter your username" required>
    </div>

    <div class="form-group">
      <label for="password"><i class="fa-solid fa-lock"></i> Password:</label>
      <input type="password" class="form-control" id="password" placeholder="Enter your password" required>
    </div>

    <div class="form-group">
      <label for="username"><i class="fa-solid fa-phone"></i> Phone number:</label>
      <input type="text" class="form-control" id="phone" placeholder="Enter your number" required>
    </div>

    <div class="form-group">
      <label for="email"><i class="fa-solid fa-envelope"></i> Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter your email" required>
    </div>

                            <div class="form-group">
                            <label for="email"><i class="fa-solid fa-person"></i>/<i class="fa-solid fa-person-dress"></i> Gender:</label>
                                <select class="form-control" id="gender">
                                <?php

include 'connection.php';

$rs = Database::search("SELECT * FROM `gender`");
$num = $rs->num_rows;

for ($x = 0; $x < $num; $x++) {
    $data = $rs->fetch_assoc();
?>

    <option value="<?php echo $data["id"]; ?>">
        <?php echo $data["gender"]; ?>
    </option>

<?php
}

?>
                                </select>
                            </div>
  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
  <a href="seller's_tandc_leter.php" class="form-check-label" for="flexCheckDefault" style="color: black; text-decoration: none;">
    I'm Agree those term and conditions
  </a>
  <br><br>
    <a class="btn btn-warning btn-block col-12" onclick="sellerRegistor();">Countinive you business</a><br>
    
    <div class="btn-combined">
    <a href="seller_login.php" class="btn col-12 btn-dark mt-1">Are you have an account? Login</a>
    </div>
    
  </form>
  
</div><br>
<footer>
<div class="justify-content-center align-items-center d-flex">
      <p class="text-center text-muted">Copyright © 2024 Amazone.lk</p>
      
    </div>
</footer>
<script src="script.js"></script>
<script src="https://kit.fontawesome.com/f4e0ff3f68.js" crossorigin="anonymous"></script>
</body>
</html>