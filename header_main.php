
<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Furniture</title>
     <link rel="stylesheet" href="style files/style.css">
     <style>
         
         .navbar-top {
             display: flex;
             justify-content: space-between;
             align-items: center;
             
         }
         .logo {
             flex: 1;
             text-align: center;
         }
         .dropdown {
             position: relative;
             display: inline-block;
             margin: 0 10px;
         }
         .dropdown-content {
             display: none;
             position: absolute;
             background-color: #f9f9f9;
             min-width: 160px;
             box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
             z-index: 1;
         }
         .dropdown-content a {
             color: black;
             padding: 12px 16px;
             text-decoration: none;
             display: block;
         }
         .dropdown-content a:hover {
             background-color: #f1f1f1;
         }
         .dropdown:hover .dropdown-content {
             display: block;
         }
         @media (max-width: 768px) {

             h3{
                display: none;
             }

             .icons{
                margin-top: -10px;
             }
         }
     </style>
</head>
<body>
     <!-- navbar top -->
     <div class="container advanceX">
         <div class="navbar-top ">
             <div class="social-link " style="color: white;"><br>
             <?php
            session_start();

            if(isset($_SESSION["user"])){
                $data = $_SESSION["user"];
                ?>
                Hi, <a href="#" style="text-decoration: none; color: white;"><?php echo $data["user_name"]; ?></a> | <a href="#" style="text-decoration: none; color: white;" onclick="signout();">Signout</a>
                
                <?php

            }else{
                ?>
                <a href="login.php" class="text-decoration-none text-white">Sign in or Register</a>
                <?php
            }
            
            ?>
                 
             </div>
             <div class="logo mt-2 ">
                <br>
                 <h3 class="h3X" style="color: white;">Amazon.lk</h3>
             </div>
             <div class="dropdown">
                <br>
                 <p class="mt-4" style="cursor: pointer; color: white;">Menu</p>
                 <div class="dropdown-content" style="border-radius: 5px; ">
                     <a href="index.php" class="text-black">Home</a>
                     <a href="userprofile.php" class="text-black">Profile</a>
                     <a href="order.php" class="text-black">Order</a>
                     <a href="chat.php" class="text-black">Amazon AI Chat</a>

                     <!-- <a href="rewards.php" class="text-black">Rewards</a>
                     <a href="giftcards.php" class="text-black">Giftcards</a> -->
                     <a href="recent_history.php" class="text-black">Recent history</a>
                 </div>
             </div>
             <div class="icons">
                <br>
                 <span class="cart_lan"><a href="watchlist.php"><i class="fa-solid fa-heart more-icon"></i></a></span>
                 <span class="cart_lan"><a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a></span>
                
             </div>
         </div>
     </div>
     
     <script src="https://kit.fontawesome.com/f4e0ff3f68.js" crossorigin="anonymous"></script>
     <script src="script.js"></script>
</body>
</html>
