<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="shortcut icon" href="resourcesofwebsiteimg/icon.svg" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style files/style.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        img {
            width: 25%;
        }

        .cart-container {
            padding: 20px;
        }

        .cart-header {
            font-size: 24px;
            font-weight: bold;
        }

        .cart-item {
            border-bottom: 1px solid #ddd;
            padding: 15px 0;
        }

        .item-details {
            flex: 1;
        }

        .item-name {
            font-size: 18px;
            font-weight: bold;
        }

        .item-options {
            font-size: 14px;
            color: #888;
        }

        .item-price {
            font-size: 16px;
            font-weight: bold;
        }

        .order-summary {
            background-color: #f1f1f1;
            padding: 20px;
            border-radius: 5px;
        }

        .order-summary h4 {
            font-weight: bold;
        }

        .order-summary .total {
            font-size: 20px;
            font-weight: bold;
            color: #333;
        }

        .head {
            background-color: black;
        }
    </style>
</head>

<body class="">
    <div class="head">
        <?php require 'header_main.php'; ?><br>
    </div>
    <hr style="color: black;">
    <div class="container mt-5 ">
        <h2 class="text-center"> Shopping Cart <i class="bi bi-cart-fill"></i></h2><br>
        <div class="row "><?php

                            include "connection.php";

                            if (isset($_SESSION["user"])) {

                                $user = $_SESSION["user"]["email"];

                                $total = 0;
                                $subtotal = 0;
                                $shipping = 0;

                                $cart_rs = Database::search("SELECT * FROM `cart` WHERE `users_email`='" . $user . "'");
                                $cart_num = $cart_rs->num_rows;

                                if ($cart_num == 0) {
                            ?>
                    <div class="container empty-cart-container">
                        <div class="empty-cart-icon">
                            <i class="fa fa-shopping-cart"></i>
                        </div>
                        <div class="empty-cart-text">
                            No items yet? Continue shopping to explore more.
                        </div>
                        <a href="index.php" style="text-decoration: none;" class="text-dark explore-btn">
                            Explore items
                        </a>
                    </div>

                <?php
                                } else {
                ?>
                    <div class="container cart-container">
                        <div class="row">
                            <div class="col-lg-8">
                                <?php
                                    for ($x = 0; $x < $cart_num; $x++) {
                                        $cart_data = $cart_rs->fetch_assoc();

                                        $product_rs = Database::search("SELECT * FROM `products` INNER JOIN `product_img` ON 
                                id=product_img.products_id WHERE `id`='" . $cart_data["products_id"] . "'");
                                        $product_data = $product_rs->fetch_assoc();

                                        $total = $total + ($product_data["price"] * $cart_data["qty"]);

                                        $address_rs = Database::search("SELECT `district_id` AS district_id FROM `users_has_address` INNER JOIN `city` ON 
                            users_has_address.city_id=city.id INNER JOIN `district` ON 
                            city.district_id=district.id WHERE `users_email`='" . $user . "'");
                                        $address_data = $address_rs->fetch_assoc();

                                        $ship = 0;

                                        $color_rs = Database::search("SELECT * FROM `color_has_products` INNER JOIN `products` ON color_has_products.products_id=products.id INNER JOIN
                                             `color` ON color_has_products.color_id=color.id WHERE products_id = '" . $cart_data["products_id"] . "'");
                                            $color_data = $color_rs->fetch_assoc();

                                        if ($address_data["district_id"] == 10) {
                                            $ship = $product_data["delevery_fee_colombo"];
                                            $shipping =  $ship;
                                        } else {
                                            $ship = $product_data["delevery_fee_other"];
                                            $shipping = $ship;
                                        }

                                        $seller_rs = Database::search("SELECT * FROM `users` WHERE `email`='" . $product_data["seller_email"] . "'");
                                        $seller_data = $seller_rs->fetch_assoc();
                                        $seller = $seller_data["user_name"];

                                ?>
                                    <div class="cart-item d-flex">
                                        <img src="<?php echo $product_data["image_path"]; ?>" alt="Colorado Tee" class="img-fluid mr-3">
                                        <div class="item-details">
                                        <div class="item-name mb-2"><?php echo $product_data["product_name"]; ?></div>
                                            <div class="item-options mb-2">Color : <?php echo $color_data["color"]; ?></div>
                                            <div class="">Price : Rs.<?php echo $product_data["price"]; ?>.00</div>
                                            <hr class="col-5">
                                            <div class=""><b>Delevery Fee : Rs.<?php echo $shipping ?>.00</b></div>
                                            <hr class="col-5">
                                        </div>
                                        <input type="number"   id="qty_input" class="form-control col-1" value="<?php echo $cart_data['qty']; ?>" onchange="changeQTY(<?php echo $cart_data['id']; ?>);" min="1" max="<?php echo $product_data["qty"];?>" >
                                        <div class="remove ml-3">
                                            <button onclick="deleteFromCart(<?php echo $cart_data['id']; ?>);" class="btn btn-sm btn-outline-danger">&times;</button>
                                        </div>
                                    </div>
                                <?php
                                    }
                                ?>
                            </div>
                            <div class="col-lg-4">
                                <div class="order-summary">
                                    <h4>Order Summary</h4>
                                    <div class="d-flex justify-content-between">
                                        <span><?php echo $cart_num; ?> items</span>
                                        <span>Rs. <?php echo $total; ?> .00</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span>Delivery fee</span>
                                        <span>Rs. <?php echo $shipping; ?> .00</span>
                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-between total">
                                        <span>Total Cost</span>
                                        <span>Rs. <?php echo $total + $shipping; ?> .00</span>
                                    </div>
                                    <div class="d-none" id="msgDiv2">
            <div class="alert alert-success" id="msg2"></div>
        </div>
                                    <button class="btn btn-dark btn-block mt-2" onclick="checkOut();">Proceed to Checkout</button>
                                    <p class="text-muted text-center mt-2">Thank you for you choosing us!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                                }
                            } else {
                ?>
                <script>
                    alert("Please login first");
                    window.location = "login.php";
                </script>
            <?php
                            }
            ?>

        </div>
    </div>
    <?php include "footer.php"; ?>
    <script src="script.js"></script>
    <script src="cart/script.js"></script>
    <!-- payhere js -->
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
    <!-- payhere js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js" integrity="sha512-X2f5WstYlKTcOKFn1FQ8ovf8DZdjzQ2n4geL9ldZ1FvvFvjTGR+UbbJcrx/oCvd/1Jh2A5Y6I5whBvv0FdSi3A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>