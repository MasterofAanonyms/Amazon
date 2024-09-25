<?php

include "connection.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Amazone.lk</title>
  <link rel="shortcut icon" href="resourcesofwebsiteimg/icon.svg" type="image/x-icon">
  <link rel="stylesheet" href="style files/style.css">
  <link rel="stylesheet" href="bootstrap_files/bootstrap.css">
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <style>
    .point {
      cursor: pointer;
    }

    .double-border {
      border: 10px solid #000;
      /* Outer border color */
      padding: 10px;
      border-radius: 10px;
      position: relative;
    }

    .double-border:before {
      content: '';
      position: absolute;
      top: 10px;
      left: 10px;
      right: 10px;
      bottom: 10px;
      border: 8px solid #fff;
      /* Inner border color */
      border-radius: 8px;
    }

    #imageSlider {
      overflow: hidden;
      border-radius: 10px;
    }

    #customButton1 {
      display: none;
      /* Hide the button by default */
      position: absolute;
      top: 76%;
      /* Adjust the top position as needed */
      left: 80%;
      /* Adjust the left position as needed */
      transform: translate(-50%, -50%);
      background-color: red;
    }

    #customButton1:hover {
      background-color: #fff;
    }

    #customButton3 {
      display: none;
      /* Hide the button by default */
      position: absolute;
      top: 65.3%;
      /* Adjust the top position as needed */
      left: 50%;
      /* Adjust the left position as needed */
      transform: translate(-50%, -50%);
    }

    #customButton2 {
      display: none;
      /* Hide the button by default */
      position: absolute;
      top: 67%;
      /* Adjust the top position as needed */
      left: 50%;
      /* Adjust the left position as needed */
      transform: translate(-50%, -50%);
    }

    .product-card {
      border: 1px solid #ddd;
      border-radius: 10px;
      padding: 15px;
      margin-bottom: 20px;
      text-align: center;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      /* Vertically center and space-between content */
      min-height: 250px;
      /* Set a minimum height for the card */
    }

    .product-image-container {
      border: 1px solid #ddd;
      /* Border around the image */
      border-radius: 5px;
      overflow: hidden;
      /* Ensure the border doesn't extend beyond the image container */
    }

    .product-image {
      width: 60%;

      border-radius: 8px;
      display: block;
      margin: 0 auto;
    }

    .btn-circle.btn-xl {
      width: 100px;
      height: 100px;
      padding: 13px 18px;
      border-radius: 60px;
      font-size: 15px;
      text-align: center;
    }
  </style>
</head>


<body id="view_area" style="z-index: 999px;">
  <?php require "header.php"; ?>
  <div id="myDiv3">
    <section>
      <div class="category-row">
        <div class="category-col">
          <img src="others/computer_parts/system_unit/scase.jpg" style="width: 24%;">
          <h5 class="dropbtn">COMPUTER PARTS</h5>
        </div>
        <div class="category-col" style="margin-left: -4%;">
          <img src="others/gaming_componants/sony/sony2.jpg" style="width: 20%;">
          <h5 class="dropbtn">GAMING</h5>
        </div>
        <div class="category-col" style="margin-left: -4%;">
          <img src="others/laptops/dell/dell1.jpg" style="width: 24%;">
          <h5 class="dropbtn">LAPTOPS</h5>
        </div>
        <div class="category-col">
          <img src="others/phones/samsung/samsung2.jpg" style="width: 24%;">
          <h5 class="dropbtn">PHONES</h5>
        </div>
        <div class="category-col" style="margin-left: 4%;">
          <img src="others/Tablets/microsoft/microsoft1.jpg" style="width: 68%; ">
          <h5 class="dropbtn">TABLETS</h5>
        </div>
        <div class="category-col">
          <img src="others/VR_AR/apple/vision.jpg" style="width: 24%;">
          <h5 class="dropbtn">AR/VR</h5>
        </div>
      </div>
    </section>


    <div class="container mt-5">
      <div class="double-border">
        <div id="imageSlider" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="resourcesofwebsiteimg/image_slider/9742750.jpg" class="d-block w-100" alt="Image 1">
              <button id="customButton1" class="btn btn-warning col-2 col-lg-2 col-sm-6 col-md-3">Buy now</button>
            </div>
            <div class="carousel-item">
              <img src="resourcesofwebsiteimg/image_slider/7a3af271-c6a6-4962-9550-228e23109dba.jpg" class="d-block w-100" alt="Image 2">
              <button id="customButton2" class="btn btn-outline-primary col-2 col-lg-2 col-sm-6 col-md-3">Learn more</button>
            </div>
            <div class="carousel-item">
              <img src="resourcesofwebsiteimg/image_slider/33139539_7995937.jpg" class="d-block w-100" alt="Image 3">
              <button id="customButton3" class="btn btn-warning col-2 col-lg-2 col-sm-6 col-md-3">Learn more</button>
            </div>
            <!-- Add more carousel items as needed -->
          </div>
          <div>
            <a class="carousel-control-prev" href="#imageSlider" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#imageSlider" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <br><br>
  <a id="myDiv2">
    <h1 style="justify-content: center; align-items: center; display: flex;">TOP DEALS ></h1>
    <hr>
    <br>
  </a>

  <div class="container">

    <div class="row" id="basicSearchResult">
      <?php

      $product_rs = Database::search("SELECT * FROM `products` WHERE `product_place_status_id`='1' AND `product_status`='1' ORDER BY `adedd_date` DESC LIMIT 4 OFFSET 0");

      $product_num = $product_rs->num_rows;
      if ($product_num == 0) {
        echo "<h1 class='text-center'>Not Found Products</h1>";
      }

      for ($z = 0; $z < $product_num; $z++) {
        $product_data = $product_rs->fetch_assoc();
      ?>
        <div class="col-md-3">
          <div class="product-card" id="product-card">
            <div class="product-image-container">
              <?php
              $img_rs = Database::search("SELECT * FROM `product_img` WHERE `products_id`='" . $product_data["id"] . "'");
              $img_data = $img_rs->fetch_assoc();
              ?>
              <img src="<?php echo $img_data["image_path"]; ?>" alt="Product Image" class="product-image mx-auto d-block img point">
            </div><br>
            <div>
              <h5 class="point"><?php echo $product_data["product_name"]; ?></h5>
              <p class="text-muted">Rs.<?php echo $product_data["price"]; ?>.00</p>
              <?php
              if ($product_data["qty"] > 0) {
              ?>
                <span class="badge mb-3" style="background-color: rgb(255, 196, 0); width: fit-content;">Available</span>
            </div>
            <a href="<?php echo "sdds.php?id=" . ($product_data["id"]); ?>" class="btn btn-warning">buy now</a>
            <button class="btn btn-outline-dark mt-2" style="justify-content: center;align-items: center; display: flex; color: grey;" onclick="addToCart(<?php echo $product_data['id']; ?>);"><i class="fa-solid fa-cart-plus"></i></button>
          <?php
              } else {
          ?>
            <span class="badge mb-3" style="background-color: red; width: fit-content;">out of stock</span>
          </div>
          <button class="btn btn-warning disabled">buy now</button>
          <button class="btn btn-outline-dark mt-2 disabled" style="justify-content: center;align-items: center; display: flex; color: grey;"><i class="fa-solid fa-cart-plus"></i></button>
          <?php
              }



              if (isset($_SESSION["user"])) {

                $watchlist_rs = Database::search("SELECT * FROM `wichlist` WHERE `users_email`='" . $_SESSION["user"]["email"] . "' 
      AND `products_id`='" . $product_data["id"] . "'");
                $watchlist_num = $watchlist_rs->num_rows;
                if ($watchlist_num == 1) {

          ?>

            <button class="btn  mt-2" style="justify-content: center;align-items: center; display: flex;" onclick='addToWatchlist(<?php echo $product_data["id"]; ?>);'><i class="fa-solid text-danger fa-heart" id="heart<?php echo $product_data["id"]; ?>"></i></button>

          <?php
                } else {
          ?>
            <button class="btn  mt-2" style="justify-content: center;align-items: center; display: flex;" onclick='addToWatchlist(<?php echo $product_data["id"]; ?>);'><i class="fa-solid fa-heart text-dark" id="heart<?php echo $product_data["id"]; ?>"></i></button>
        <?php
                }
              } ?>

        </div>
    </div>
  <?php
      }
  ?>

  <br>
  <div class="justify-content-center align-items-center d-flex"><br>
    <a href="#" class="btn btn-dark mt-4">MORE DEALS</a>
  </div>
  </div>
  <div id="myDiv">
    <hr>
    <br>
    <h1>Leatest Products ></h1>
    <hr class="myDiv">
    <br>
    <div id="myDiv">
      <div class="container">
        <div class="row">
          <?php

          $product_rs = Database::search("SELECT * FROM `products` WHERE `product_place_status_id`='2' AND `product_status`='1' ORDER BY `adedd_date` DESC LIMIT 4 OFFSET 0");

          $product_num = $product_rs->num_rows;
          if ($product_num == 0) {
            echo "<h1 class='text-center'>Not Found Products</h1>";
          }

          for ($z = 0; $z < $product_num; $z++) {
            $product_data = $product_rs->fetch_assoc();
          ?>
            <div class="col-md-3">
              <div class="product-card" id="product-card">
                <div class="product-image-container">
                  <?php
                  $img_rs = Database::search("SELECT * FROM `product_img` WHERE `products_id`='" . $product_data["id"] . "'");
                  $img_data = $img_rs->fetch_assoc();
                  ?>
                  <img src="<?php echo $img_data["image_path"]; ?>" alt="Product Image" class="product-image mx-auto d-block img point">
                </div><br>
                <div>
                  <h5 class="point"><?php echo $product_data["product_name"]; ?></h5>
                  <p class="text-muted">Rs.<?php echo $product_data["price"]; ?>.00</p>
                  <?php
                  if ($product_data["qty"] > 0) {
                  ?>
                    <span class="badge mb-3" style="background-color: rgb(255, 196, 0); width: fit-content;">Available</span>
                </div>
                <a href="<?php echo "sdds.php?id=" . ($product_data["id"]); ?>" class="btn btn-warning">buy now</a>
                <button class="btn btn-outline-dark mt-2" style="justify-content: center;align-items: center; display: flex; color: grey;" onclick="addToCart(<?php echo $product_data['id']; ?>);"><i class="fa-solid fa-cart-plus"></i></button>
              <?php
                  } else {
              ?>
                <span class="badge mb-3" style="background-color: red; width: fit-content;">out of stock</span>
              </div>
              <button class="btn btn-warning disabled">buy now</button>
              <button class="btn btn-outline-dark mt-2 disabled" style="justify-content: center;align-items: center; display: flex; color: grey;"><i class="fa-solid fa-cart-plus"></i></button>
              <?php
                  }



                  if (isset($_SESSION["user"])) {

                    $watchlist_rs = Database::search("SELECT * FROM `wichlist` WHERE `users_email`='" . $_SESSION["user"]["email"] . "' 
      AND `products_id`='" . $product_data["id"] . "'");
                    $watchlist_num = $watchlist_rs->num_rows;
                    if ($watchlist_num == 1) {

              ?>

                <button class="btn  mt-2" style="justify-content: center;align-items: center; display: flex;" onclick='addToWatchlist(<?php echo $product_data["id"]; ?>);'><i class="fa-solid text-danger fa-heart" id="heart<?php echo $product_data["id"]; ?>"></i></button>

              <?php
                    } else {
              ?>
                <button class="btn  mt-2" style="justify-content: center;align-items: center; display: flex;" onclick='addToWatchlist(<?php echo $product_data["id"]; ?>);'><i class="fa-solid fa-heart text-dark" id="heart<?php echo $product_data["id"]; ?>"></i></button>
            <?php
                    }
                  } ?>

            </div>
        </div>
      <?php
          }
      ?>

      </div>
      <br>
      <div class="justify-content-center align-items-center d-flex">
        <a href="#" class="btn btn-warning">View More</a>
      </div>
    </div>
    <hr id="myDiv">

    <br>

    <h1 id="myDiv" class="text-danger">UP TO 50% OFFERS ></h1>
    <hr id="myDiv">
    <br>
    <div id="myDiv" class="container">
      <div class="row">
        <?php

        $product_rs = Database::search("SELECT * FROM `products` WHERE `product_place_status_id`='3' AND `product_status`='1' ORDER BY `adedd_date` DESC LIMIT 4 OFFSET 0");

        $product_num = $product_rs->num_rows;
        if ($product_num == 0) {
          echo "<h1 class='text-center'>Not Found Products</h1>";
        }

        for ($z = 0; $z < $product_num; $z++) {
          $product_data = $product_rs->fetch_assoc();
        ?>
          <div class="col-md-3">
            <div class="product-card" id="product-card">
              <div class="product-image-container">
                <?php
                $img_rs = Database::search("SELECT * FROM `product_img` WHERE `products_id`='" . $product_data["id"] . "'");
                $img_data = $img_rs->fetch_assoc();
                ?>
                <img src="<?php echo $img_data["image_path"]; ?>" alt="Product Image" class="product-image mx-auto d-block img point">
              </div><br>
              <div>
                <h5 class="point"><?php echo $product_data["product_name"]; ?></h5>
                <p class="text-muted">Rs.<?php echo $product_data["price"]; ?>.00</p>
                <?php
                if ($product_data["qty"] > 0) {
                ?>
                  <span class="badge mb-3" style="background-color: rgb(255, 196, 0); width: fit-content;">Available</span>
              </div>
              <a href="<?php echo "sdds.php?id=" . ($product_data["id"]); ?>" class="btn btn-warning">buy now</a>
              <button class="btn btn-outline-dark mt-2" style="justify-content: center;align-items: center; display: flex; color: grey;" onclick="addToCart(<?php echo $product_data['id']; ?>);"><i class="fa-solid fa-cart-plus"></i></button>
            <?php
                } else {
            ?>
              <span class="badge mb-3" style="background-color: red; width: fit-content;">out of stock</span>
            </div>
            <button class="btn btn-warning disabled">buy now</button>
            <button class="btn btn-outline-dark mt-2 disabled" style="justify-content: center;align-items: center; display: flex; color: grey;"><i class="fa-solid fa-cart-plus"></i></button>
            <?php
                }
                if (isset($_SESSION["user"])) {

                  $watchlist_rs = Database::search("SELECT * FROM `wichlist` WHERE `users_email`='" . $_SESSION["user"]["email"] . "' 
      AND `products_id`='" . $product_data["id"] . "'");
                  $watchlist_num = $watchlist_rs->num_rows;
                  if ($watchlist_num == 1) {

            ?>

              <button class="btn  mt-2" style="justify-content: center;align-items: center; display: flex;" onclick='addToWatchlist(<?php echo $product_data["id"]; ?>);'><i class="fa-solid text-danger fa-heart" id="heart<?php echo $product_data["id"]; ?>"></i></button>

            <?php
                  } else {
            ?>
              <button class="btn  mt-2" style="justify-content: center;align-items: center; display: flex;" onclick='addToWatchlist(<?php echo $product_data["id"]; ?>);'><i class="fa-solid fa-heart text-dark" id="heart<?php echo $product_data["id"]; ?>"></i></button>
          <?php
                  }
                } ?>

          </div>
      </div>
    <?php
        }
    ?>
    </div>
    <?php

    ?>

    <br>
    <div id="myDiv" class="justify-content-center align-items-center d-flex">
      <a href="#" class="btn btn-danger mt-4">More Offers</a>
    </div>
    <br>
    <div id="myDiv" class="banner-container">

      <div class="banner">
        <div class="lap">
          <img src="resourcesofwebsiteimg/image_slider/laptop.png" alt="">
        </div>
        <div class="content">
          <span>upto</span>
          <h3>50% 0ff</h3>
          <p>offer ends after 5 days</p>
          <a href="#" class="btn">veiw offer</a>
        </div>
        <div class="women">
          <img src="resourcesofwebsiteimg/image_slider/women.png" alt="">
        </div>
      </div>

    </div><br>

  </div>
  <?php require 'footer.php'; ?>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="script.js"></script>

  <script>
    // Show the button when the 3rd image is displayed
    $('#imageSlider').on('slide.bs.carousel', function(e) {
      var index = $(e.relatedTarget).index();
      if (index === 2) {
        $('#customButton3').show();
      } else {

        $('#customButton3').hide();
      }
    });

    $('#imageSlider').on('slide.bs.carousel', function(e) {
      var index = $(e.relatedTarget).index();
      if (index === 0) {
        $('#customButton1').show();
      } else {
        $('#customButton1').hide();
      }
    });

    $('#imageSlider').on('slide.bs.carousel', function(e) {
      var index = $(e.relatedTarget).index();
      if (index === 1) {
        $('#customButton2').show();
      } else {
        $('#customButton2').hide();
      }
    });

    var productDescription = document.getElementById('product-description');
    productDescription.innerHTML = productDescription.innerHTML.substring(0, 20) + '...';
  </script>

  </script>
</body>

</html>