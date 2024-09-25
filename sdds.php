<?php
include "connection.php";
if (isset($_GET["id"])) {

    $pid = $_GET["id"];

    $product_rs = Database::search("SELECT products.id,products.price,products.product_status,products.qty,products.description,
    products.product_name,products.discount_id,products.adedd_date,products.delevery_fee_colombo,products.delevery_fee_other,
    products.category_id,products.model_has_brand_id,products.condition_id,
    products.product_status,products.seller_email,model.model AS model,brand.brand AS brand FROM 
    `products` INNER JOIN `model_has_brand` ON model_has_brand.id=products.model_has_brand_id INNER JOIN 
    `brand` ON brand.id=model_has_brand.brand_id INNER JOIN `model` ON 
    model.id=model_has_brand.model_id WHERE products.id='" . $pid . "'");



    $product_num = $product_rs->num_rows;
    if ($product_num == 1) {

        $product_data = $product_rs->fetch_assoc();
        $seller_rs = Database::search("SELECT * FROM `users` WHERE `email`= '" . $product_data["seller_email"] . "'");
        $seller_data = $seller_rs->fetch_assoc();


?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <title>Amazone.lk | <?php echo $product_data["product_name"]; ?></title>
            <link rel="shortcut icon" href="resourcesofwebsiteimg/icon.svg" type="image/x-icon">
            <!-- CSS -->
            <link rel="stylesheet" href="bootstrap_files/bootstrap.css">
            <link rel="stylesheet" href="sdds.css">
            <!-- CSS -->
            <!-- icons -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
            <!-- icons -->
            <style>
                @media only screen and (max-width: 480px) {}

                .head {
                    background-color: #000;
                }

                .h3X {
                    margin-top: 15px;
                }

                .carousel-item img {
                    transition: transform 0.3s ease-in-out;
                }

                .carousel-item img:hover {
                    transform: scale(1.1);
                    /* Zooms in the image */
                }
            </style>
        </head>

        <body data-bs-theme="light">
            <div class="head">
                <?php require 'header_main.php' ?><br>
            </div>

            <div class="container-fluid">
                <div class="row mb-5 justify-content-center">
                    <div class="col-10 card p-3 bg-body-tertiary mt-5">
                        <div class="row g-3 ">
                            <div class="col-12 col-md-5 justify-content-center align-items-center d-flex ">
                                <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        <?php
                                        $image_rs = Database::search("SELECT * FROM `product_img` WHERE `products_id`='" . $pid . "'");
                                        $image_num = $image_rs->num_rows;
                                        $active_class = 'active';

                                        while ($image_data = $image_rs->fetch_assoc()) {
                                            echo '<div class="carousel-item ' . $active_class . '">
                                            <img src="' . $image_data["image_path"] . '" style="width: 80%;" class="d-block offset-1" alt="Product Image">
                                          </div>';
                                            $active_class = ''; // Reset active class for subsequent items
                                        }
                                        ?>

                                    </div>
                                    <button class="carousel-control-prev bg-dark" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon " aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next bg-dark" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>

                            </div>

                            <div class="col-12 col-md-7">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="row">
                                            <h2 class="col-12 fs-4 text-center"><?php echo $product_data["product_name"]; ?></h2>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <span class="text-black-50">Brand | <a class="text-warning text-decoration-none"><?php echo $product_data["brand"]; ?></a></span>&nbsp;&nbsp;&nbsp;&nbsp;
                                                <span class="text-black-50">Model | <a class="text-black text-decoration-none"><?php echo $product_data["model"]; ?></a></span>

                                            </div>
                                            <div class="col-12">
                                                <span class="text-black-50">Seller | <a class="text-black text-decoration-none"><?php echo $product_data["seller_email"]; ?></a></span>&nbsp;&nbsp;&nbsp;&nbsp;

                                            </div>
                                        </div>



                                        <?php
                                        if ($product_data["discount_id"] == 4) {
                                            $price = $product_data["price"];
                                            $adding_price = ($price / 100) * 10;
                                            $new_price = $price + $adding_price;
                                            $difference = $new_price - $price;
                                        ?>
                                            <div class="row mt-4 align-items-center">
                                                <h1 class="col-12 text-warning fw-bold">Rs.<?php echo $product_data["price"]; ?>.00</h1>
                                                <h5 class="col-12"><span class="text-decoration-line-through text-danger">Rs.<?php echo $new_price; ?>.00</span> | -10%</h5>
                                            </div>
                                        <?php
                                        }
                                        if ($product_data["discount_id"] == 2) {
                                            $price = $product_data["price"];
                                            $adding_price = ($price / 100) * 75;
                                            $new_price = $price + $adding_price;
                                            $difference = $new_price - $price;
                                        ?>
                                            <div class="row mt-4 align-items-center">
                                                <h1 class="col-12 text-warning fw-bold">Rs.<?php echo $product_data["price"]; ?>.00</h1>
                                                <h5 class="col-12"><span class="text-decoration-line-through text-danger">Rs.<?php echo $new_price; ?>.00</span> | -75%</h5>
                                            </div>
                                        <?php
                                        }
                                        if ($product_data["discount_id"] == 3) {
                                            $price = $product_data["price"];
                                            $adding_price = ($price / 100) * 50;
                                            $new_price = $price + $adding_price;
                                            $difference = $new_price - $price;
                                        ?>
                                            <div class="row mt-4 align-items-center">
                                                <h1 class="col-12 text-warning fw-bold">Rs.<?php echo $product_data["price"]; ?>.00</h1>
                                                <h5 class="col-12"><span class="text-decoration-line-through text-danger">Rs.<?php echo $new_price; ?>.00</span> | -50%</h5>

                                            </div>
                                        <?php
                                        }
                                        if ($product_data["discount_id"] == 1) {

                                        ?>
                                            <div class="row mt-4 align-items-center">
                                                <h1 class="col-12 text-warning fw-bold">Rs.<?php echo $product_data["price"]; ?>.00</h1>
                                            </div>
                                        <?php
                                        }

                                        if ($product_data["condition_id"] == 1) {
                                        ?>
                                            <div class="row mt-3">
                                                <div class="col-12">
                                                    <h5 class="fs-5">Warranty: 2 Years</h5>
                                                    <p class="text-black-50">contact to Warranty: <?php echo $seller_data["phone_no"] ?></p>
                                                    <?php
                                                    if ($product_data["qty"] < 1) {
                                                    ?>
                                                        <h5 class="fs-5 text-danger">Out of Stock</h5>
                                                        <div class="col-12 col-md-2 col-lg-2">
                                                            <input type="number" class="form-control mb-2" value="0" min="0" max="0" id="qty_input" />
                                                            <button class="btn btn-dark heart" onclick='addToWatchlist(<?php echo $pid; ?>);'><i class="bi bi-heart"></i></button>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col-6">
                                                                <button class="col-12 btn btn-warning disabled" type="submit" id="payhere-payment" onclick="buyNow(<?php echo $pid; ?>);">Buy</button>
                                                            </div>
                                                            <div class="col-6">
                                                                <button class="col-12 btn btn-outline-dark disabled" onclick="addToCart(<?php echo $pid; ?>);"><i class="bi bi-cart3"></i> Cart</button>
                                                            </div>
                                                            <?php
                                                            if ($product_data["seller_email"] == "thehanaruth@gmail.com") {
                                                            } else {
                                                            ?>
                                                                <div class="alert alert-danger col-11 mt-3" style="margin-left: 30px;">
                                                                    This product is not our product but was added to our website by another person. But we will give you all the support we can through our website. If you do not receive the product within 2 weeks, please give us a phone call on 0772546723
                                                                </div>
                                                            <?php
                                                            }

                                                            ?>
                                                        </div>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <h5 class="fs-5 text-warning">In Stock: <?php echo $product_data["qty"]; ?> qty Available</h5>
                                                        <div class="col-12 col-md-2 col-lg-2">
                                                            <input type="number" class="form-control mb-2" value="1" min="1" max="<?php echo $product_data["qty"]; ?>" id="qty_input" />
                                                            <button class="btn btn-dark" onclick='addToWatchlist(<?php echo $pid; ?>);'><i class="bi bi-heart"></i></button>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col-6">
                                                                <button class="col-12 btn btn-warning" type="submit" id="payhere-payment" onclick="buyNow(<?php echo $pid; ?>);">Buy</button>
                                                            </div>
                                                            <div class="col-6">
                                                                <button class="col-12 btn btn-outline-dark" onclick="addToCart(<?php echo $pid; ?>);"><i class="bi bi-cart3"></i> Cart</button>
                                                            </div>
                                                            <?php
                                                            if ($product_data["seller_email"] == "thehanaruth@gmail.com") {
                                                            } else {
                                                            ?>
                                                                <div class="alert alert-danger col-11 mt-3" style="margin-left: 30px;">
                                                                    This product is not our product but was added to our website by another person. But we will give you all the support we can through our website. If you do not receive the product within 2 weeks, please give us a phone call on 0772546723
                                                                </div>
                                                            <?php
                                                            }

                                                            ?>
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>

                                                </div>
                                            </div>
                                        <?php
                                        } else {
                                        ?>
                                            <div class="row mt-3">
                                                <div class="col-12">
                                                    <h5 class="fs-5">Return Policy: 3 Months</h5>
                                                    <p class="text-black-50">Contact to return: <?php echo $seller_data["phone_no"] ?> (Seller number)</p>
                                                    <?php
                                                    if ($product_data["qty"] < 1) {
                                                    ?>
                                                        <h5 class="fs-5 text-danger">Out of Stock</h5>
                                                        <div class="row mt-3">
                                                            <div class="col-6">
                                                                <button class="col-12 btn btn-warning disabled" type="submit" id="payhere-payment" onclick="buyNow(<?php echo $pid; ?>);">Buy</button>
                                                            </div>
                                                            <div class="col-6">
                                                                <button class="col-12 btn btn-outline-dark disabled" onclick="addToCart(<?php echo $pid; ?>);"><i class="bi bi-cart3"></i> Cart</button>
                                                            </div>
                                                        </div>
                                                    <?php
                                                    } else {
                                                    ?>

                                                        <h5 class="fs-5 text-warning">In Stock: <?php echo $product_data["qty"]; ?>
                                                            <?php
                                                            if ($product_data["qty"] == 1) {
                                                            ?>
                                                                Product Available</h5>

                                                    <?php
                                                            } else {
                                                    ?>
                                                        Products Available</h5>
                                                    <?php
                                                            }
                                                    ?>
                                                    <div class="col-12 col-md-2 col-lg-2">
                                                        <input type="number" class="form-control mb-2" value="1" min="1" max="<?php echo $product_data["qty"]; ?>" id="qty_input" />
                                                        <button class="btn btn-dark" onclick='addToWatchlist(<?php echo $pid; ?>);'><i class="bi bi-heart"></i></button>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col-6">
                                                            <button class="col-12 btn btn-warning" type="submit" id="payhere-payment" onclick="buyNow(<?php echo $pid; ?>);">Buy</button>
                                                        </div>
                                                        <div class="col-6">
                                                            <button class="col-12 btn btn-outline-dark" onclick="addToCart(<?php echo $pid; ?>);"><i class="bi bi-cart3"></i> Cart</button>
                                                        </div>

                                                    </div>
                                                <?php

                                                    }
                                                ?>

                                                <?php
                                                if ($product_data["seller_email"] == "thehanaruth@gmail.com") {
                                                } else {
                                                ?>
                                                    <div class="alert alert-danger col-11 mt-3" style="margin-left: 30px;">
                                                        This product is not our product but was added to our website by another person. But we will give you all the support we can through our website. If you do not receive the product within 2 weeks, please give us a phone call on 0772546723
                                                    </div>

                                                <?php
                                                }

                                                ?>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>



                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="col-10">
                        <h1>Description:</h1>
                        <textarea cols="60" rows="10" class="form-control" readonly>
                                                <?php echo $product_data["description"]; ?>
                                                </textarea>
                    </div>
                    <div class="col-12 bg-white">
                        <div class="row d-block me-0 mt-4 mb-3 border-bottom border-1 border-dark">
                            <div class="col-12">
                                <span class="fs-3 fw-bold">Related Items</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 bg-white">
                        <div class="row g-2">

                            <?php

                            $related_rs = Database::search("SELECT * FROM `products` 
                                    WHERE `model_has_brand_id`='" . $product_data["model_has_brand_id"] . "' LIMIT 5");

                            $related_num = $related_rs->num_rows;
                            for ($y = 0; $y < $related_num; $y++) {
                                $related_data = $related_rs->fetch_assoc();
                            ?>
                                <div class="offset-1 offset-lg-0 col-4 col-lg-2 me-3">
                                    <div class="card" style="width: 18rem;">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $related_data["product_name"]; ?></h5>
                                            <p class="card-text">price: LKR.<?php echo $related_data["price"]; ?></p>
                                            <a href="<?php echo "sdds.php?id=" . ($related_data["id"]); ?>" class="btn btn-warning">Buy now</a>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }

                            ?>

                        </div>
                    </div>
                </div>

            </div>
            <hr>
            <div class="col-12 col-lg-6 mt-5 offset-lg-3 mb-5" readonly>
                <div class="row mb-5 bg-light border-dark rounded  me-0" style="height: 300px;">
                    <h1 class="text-center mt-2">FEED BACKS</h1>
                    <?php

                    $feedback_rs = Database::search("SELECT * FROM `feedback` INNER JOIN `users` ON 
                                feedback.users_email=users.email WHERE `products_id`='" . $pid . "'");

                    $feedback_num = $feedback_rs->num_rows;
                    if ($feedback_num == 0) {
                    ?>
                        <h1 class="text-center">No feedback found for this product !</h1>
                    <?php
                    }
                    for ($y = 0; $y < $feedback_num; $y++) {
                        $feedback_data = $feedback_rs->fetch_assoc();

                    ?>
                        <div class="col-12  mb-2">
                            <div class="row border border-1 border-dark rounded me-0">

                                <div class="col-10 mt-1 mb-1 ms-0"><?php echo $feedback_data["user_name"]; ?></div>
                                <div class="col-2 mt-1 mb-1 me-0">

                                    <?php

                                    if ($feedback_data["type"] == 1) {
                                    ?>
                                        <i class="fa fa-star rating-color text-warning"></i>
                                        <i class="fa fa-star rating-color text-warning"></i>
                                        <i class="fa fa-star rating-color text-warning"></i>
                                    <?php
                                    } else if ($feedback_data["type"] == 2) {
                                    ?><i class="fa fa-star rating-color"></i>
                                        <i class="fa fa-star rating-color text-warning"></i>
                                        <i class="fa fa-star rating-color text-warning"></i><?php
                                                                                        } else if ($feedback_data["type"] == 3) {
                                                                                            ?><i class="fa fa-star rating-color"></i>
                                        <i class="fa fa-star rating-color"></i>
                                        <i class="fa fa-star rating-color"></i><?php
                                                                                        }

                                                                                ?>

                                </div>

                                <div class="col-12">
                                    <b><?php echo $feedback_data["feedback"]; ?></b>
                                </div>
                                <div class="offset-6 col-6 text-end">
                                    <label class="form-label fs-6 text-black-50"><?php echo $feedback_data["date"]; ?></label>
                                </div>
                            </div>
                        </div>
                    <?php

                    }

                    ?>

                </div>
            </div>
            <?php include "footer.php" ?>

            <!-- js -->
            <script src="script.js"></script>
            <script src="bootstrap_files/bootstrap.bundle.js"></script>
            <!-- js -->

            <!-- payhere js -->
            <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
            <!-- payhere js -->
        </body>

        </html>
<?php
    }
}

?>