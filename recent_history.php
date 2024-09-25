<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recent History</title>
    <link rel="shortcut icon" href="resourcesofwebsiteimg/icon.svg" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .history-container {
            padding: 20px;
        }

        .history-header {
            font-size: 24px;
            font-weight: bold;
            color: #ffc107;
        }

        .history-item {
            border-bottom: 1px solid #ddd;
            padding: 15px 0;
        }

        .item-details {
            flex: 1;
        }

        .item-name {
            font-size: 18px;
            font-weight: bold;
            color: black;
        }

        .item-description {
            font-size: 14px;
            color: #888;
        }

        .item-date {
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }

        .head {
            background-color: black;
            margin-top: -65px;
            margin-left: -85px;
        }

        .btn-warning-custom {
            background-color: #ffc107;
            border-color: #ffc107;
            color: white;
        }

        .btn-warning-custom:hover {
            background-color: #e0a800;
            border-color: #d39e00;
        }

        .summary {
            background-color: #f1f1f1;
            padding: 20px;
            border-radius: 5px;
        }

        .summary h4 {
            font-weight: bold;
            color: black;
        }
    </style>
</head>

<body>
    <div class="head">
        <?php require 'header_main.php'; ?><br>
    </div>
    <hr style="color: black;">
    <div class="container mt-5">
        <h2 class="text-center history-header"><i class="fas fa-history"></i> Recent History <i class="fas fa-history"></i></h2><br>
        <div class="row">
            <div class="container history-container">
                <?php
                include "connection.php";
            if (isset($_SESSION["user"])) {

$user = $_SESSION["user"]["email"];

$total = 0;
$subtotal = 0;
$shipping = 0;

$recent_rs = Database::search("SELECT * FROM `recent` WHERE `users_email`='" . $user . "'");
$recent_num = $recent_rs->num_rows;

if ($recent_num == 0) {
?>
<div class="container empty-cart-container" style="margin-top: -90px;">
                    <div class="empty-cart-icon">
                    <i class="fas fa-history"></i>
                    </div>
                    <div class="empty-cart-text">
                        No items yet? Continue shopping to explore more.
                    </div>
                    <a href="index.php"  style="text-decoration: none;" class="bg-warning text-dark explore-btn">
                        Explore items
                    </a>
                </div>
                <?php
                            } else {
            ?>
                <div class="row">
                    <div class="col-lg-12">
                    <?php
                                    for ($x = 0; $x < $recent_num; $x++) {
                                        $recent_data = $recent_rs->fetch_assoc();

                                        $product_rs = Database::search("SELECT * FROM `products` INNER JOIN `product_img` ON 
                                id=product_img.products_id WHERE `id`='" . $recent_data["products_id"] . "'");
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
                        <div class="history-item d-flex">
                            <div class="item-details">
                                <div class="item-name"><?php echo $product_data["product_name"]; ?></div>
                                <div class="item-description"><?php echo $product_data["price"]; ?></div>
                                <div class="item-date">Viewed on: <?php echo $recent_data["viwe_date"]; ?></div>
                            </div>
                            <div class="actions ml-auto">
                                <a href="<?php echo "sdds.php?id=" . ($product_data["id"]); ?>" class="btn btn-sm btn-warning-custom mr-2">View Again</a>
                                <button class="btn btn-sm btn-outline-danger" onclick='removeFromRecent(<?php echo $recent_data["id"]; ?>);'>&times; Remove</button>
                            </div>
                        </div>
                        <?php
                                    }
                                }
                                    ?>
                        <!-- End of loop -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
            }else{
                ?>
                <script>
                    alert("Please login first");
                    window.location.href = "login.php";
                </script>
                <?php
            }
            ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>
