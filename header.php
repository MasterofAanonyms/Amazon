<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="style files/style.css">
  <link rel="stylesheet" href="bootstrap_files/bootstrap.css">
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <style>
    *{
    margin: 0%;
    padding: 0%;
    box-sizing: border-box;
    font-family: "Raleway", sans-serif;
    }
  </style>
</head>
<body>
    <!--header section-->
  <header>
    <div class="header-left">
        <a href="#"><img src="resourcesofwebsiteimg/amazon-com.svg" style="width: 45%; color: grey;"></a>
        <div class="header-left-p">
            <p><a href="#">Explore</a><span><b><i>Plus<i class="fa-solid fa-plus"></i></i></b></span></p>
        </div>
    </div>

    <div class="header-center">
        <input class="header-center-input" type="text" id="basic_search_txt" placeholder="search here..."><a onclick="basicSearch(0);"><i class="fa-solid fa-magnifying-glass"></i></a>
    </div>
    <!--Login -->
    <div class="login">
    <?php
            session_start();

            if(isset($_SESSION["user"])){
                $data = $_SESSION["user"];
                ?>
                <a href="#"  class="login_btn" onclick="signout();"><?php echo $data["user_name"]; ?></a>
                
                <?php

            }else{
                ?>
                <a href="login.php" class="login_btn">Sign in</a>
                <?php
            }
            
            ?>
        <div class="login_dropdown none">
             <ul class="login_dropdown_list"> 
              <li class="login_drop_li sign_Li flex">
                <p class="new_login">New customer?</p>
                <a href="registor.php" class="sign_up">Sign up</a>
              </li>
             <li class="login_drop_li d-none"><i class="fa-solid fa-user-tie d-none more-icon"></i>Help</li>
                <li class="login_drop_li"><i class="fa-solid fa-circle-user more-icon"></i><a href="userprofile.php" class="ankertags">My profile</a></li>
                <li class="login_drop_li"><i class="fa-solid fa-bag-shopping more-icon"></i><a href="order.php" class="ankertags">order</a></li>
                <li class="login_drop_li"><i class="fa-solid fa-heart more-icon"></i><a href="watchlist.php" class="ankertags">Watchlist</a></li>
                <li class="login_drop_li"><i class="fa-solid fa-comment more-icon"></i><a href="chat.php" class="ankertags">Amazon AI chat</a></li>
                <!-- <li class="login_drop_li"><i class="fa-solid fa-money-bill-1 more-icon"></i><a href="rewards.php" class="ankertags">Rewards</a></li>
                <li class="login_drop_li"><i class="fa-solid fa-gift more-icon"></i><a href="giftcards.php" class="ankertags">Gift Cards</a></li> -->
                <li class="login_drop_li"><i class="fa-solid fa-history more-icon"></i><a href="recent_history.php" class="ankertags">Recent History</a></li>
                <li class="login_drop_li d-none"><i class="fa-solid fa-user-tie d-none more-icon"></i><a href="help.php" class="ankertags">Help</a></li>
            </ul>
        </div>
    </div>
    <!--more-->
    <div class="more">
        <span class="more_lan">More<i class="fa-solid fa-angle-down"></i></span>
        <div class="more_dropdown none">
          <div class="pointer more_pointer"></div>
        <ul class="more_dropdown_list"> 
                <li class="login_drop_li d-none"><i class="fa-solid fa-user-tie d-none more-icon"></i>Help</li>
                <li class="login_drop_li"><i class="fa-solid fa-basket-shopping more-icon"></i><a href="seller_registor.php" class="ankertags">Sell on amazon</a></li>
                <li class="login_drop_li d-none"><i class="fa-solid fa-user-tie d-none"></i>Help</li>
            </ul>
        </div>
    </div>

    <!---cart-->
    <span class="cart_lan"><a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a></span>
  </header>

  <!--category-->

  
  


</body>
<script src="bootstrap files/bootstrap.bundle.js">
</script>
<script src="bootstrap files/bootstrap.js"></script>
<script src="script.js"></script>
<script src="https://kit.fontawesome.com/f4e0ff3f68.js" crossorigin="anonymous"></script>
</html>       