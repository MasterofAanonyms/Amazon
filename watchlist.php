<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Watchlist</title>
    <link rel="shortcut icon" href="resourcesofwebsiteimg/icon.svg" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        

        img {
            width: 15%;
        }

        

        .watchlist-header {
            font-size: 24px;
            font-weight: bold;
        }

        .watchlist-item {
            border-bottom: 1px solid #ddd;
            
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

        img{
            width: 10%;
        }

        .head {
            background-color: black;
            margin-top: -65px;
            margin-left: -85px;
        }
    </style>
</head>

<body>
    <div class="head">
        <?php require 'header_main.php'; ?><br>
    </div>
    <hr style="color: black;">
    <div class="container mt-5">
        <h2 class="text-center"><i class="bi bi-heart-fill"></i> Watchlist <i class="bi bi-heart-fill"></i></h2><br>
        <div class="row">
            <div class="container watchlist-container">
                <div class="row">
                <?php

include "connection.php";

if (isset($_SESSION["user"])) {

    $user = $_SESSION["user"]["email"];

    $total = 0;
    $subtotal = 0;
    $shipping = 0;

    $witchlist_rs = Database::search("SELECT * FROM `wichlist` WHERE `users_email`='" . $user . "'");
    $witchlist_num = $witchlist_rs->num_rows;

    if ($witchlist_num == 0) {
?>
<div class="container empty-cart-container" style="margin-top: -100px;">
                        <div class="empty-cart-icon">
                        <i class="fa fa-heart"></i>
                        </div>
                        <div class="empty-cart-text">
                            No items yet? Continue shopping to explore more.
                        </div>
                        <a href="index.php" style="text-decoration: none;" class="text-dark bg-warning explore-btn">
                            Explore items
                        </a>
                    </div>
                    <?php
                                } else {
                ?>
                
                    <div class="col-lg-12">
                    <?php
                                    for ($x = 0; $x < $witchlist_num; $x++) {
                                        $witchlist_data = $witchlist_rs->fetch_assoc();

                                        $product_rs = Database::search("SELECT * FROM `products` INNER JOIN `product_img` ON 
                                id=product_img.products_id WHERE `id`='" . $witchlist_data["products_id"] . "'");
                                        $product_data = $product_rs->fetch_assoc();


                                        $address_rs = Database::search("SELECT `district_id` AS district_id FROM `users_has_address` INNER JOIN `city` ON 
                            users_has_address.city_id=city.id INNER JOIN `district` ON 
                            city.district_id=district.id WHERE `users_email`='" . $user . "'");
                                        $address_data = $address_rs->fetch_assoc();

                                        $ship = 0;

                                        if ($address_data["district_id"] == 10) {
                                            $ship = $product_data["delevery_fee_colombo"];
                                            $shipping = $shipping + $ship;
                                        } else {
                                            $ship = $product_data["delevery_fee_other"];
                                            $shipping = $shipping + $ship;
                                        }

                                        $seller_rs = Database::search("SELECT * FROM `users` WHERE `email`='" . $product_data["seller_email"] . "'");
                                        $seller_data = $seller_rs->fetch_assoc();
                                        $seller = $seller_data["user_name"];

                                ?>
                        <!-- Loop through watchlist items -->
                        <div class="watchlist-item d-flex mt-4">
                            <img src="<?php echo $product_data["image_path"]; ?>" alt="Item Name" class="img-fluid mr-3">
                            <div class="item-details">
                                <div class="item-name"><?php echo $product_data["product_name"]; ?></div>
                                <div class="item-options"><?php echo $product_data["qty"]; ?> Items avalable</div>
                                <div class="item-price">Rs. <?php echo $product_data["price"]; ?>.00</div>
                            </div>
                            <div class="actions ml-auto mt-2">
                                <?php
                            $list_id = $witchlist_data["id"];
                            ?>
                                <button class="btn btn-sm btn-outline-danger mr-2" onclick='removeFromWatchlist(<?php echo $list_id; ?>);'>&times; Remove</button>
                                <button class="btn btn-sm btn-outline-dark" onclick="addToCart(<?php echo $product_data['id']; ?>); removeFromWatchlist(<?php echo $list_id; ?>);">Move to Cart</button>
                            </div>
                        </div>
                        <?php
                                    }
                    ?>
                        <!-- End of loop -->
                    </div>
                    <?php
                                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php
}?>
    <script src="script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>
