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
                <?php
                $watchlist_btn_class = "btn-dark";
                if (isset($_SESSION["user"])) {
                    $email = $_SESSION["user"]["email"];
                    $watchlist_rs = Database::search("SELECT * FROM `wichlist` WHERE `users_email`='" . $email . "' AND `products_id`='" . $pid . "'");
                    if ($watchlist_rs->num_rows == 1) {
                        $watchlist_btn_class = "btn-danger";
                    }
                }
                ?>
            </div>

            <div class="container py-5">
                <!-- Breadcrumbs -->
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none text-muted">Home</a></li>
                        <li class="breadcrumb-item"><a href="#"
                                class="text-decoration-none text-muted"><?php echo $product_data["brand"]; ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $product_data["product_name"]; ?></li>
                    </ol>
                </nav>

                <div class="row gx-5">
                    <!-- Image Gallery Column -->
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                            <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <?php
                                    $image_rs = Database::search("SELECT * FROM `product_img` WHERE `products_id`='" . $pid . "'");
                                    $image_num = $image_rs->num_rows;
                                    $active_class = 'active';

                                    while ($image_data = $image_rs->fetch_assoc()) {
                                        echo '<div class="carousel-item ' . $active_class . ' bg-white text-center" style="height: 500px;">
                                                <img src="' . $image_data["image_path"] . '" class="d-block mx-auto h-100 w-auto" style="object-fit: contain;" alt="Product Image">
                                              </div>';
                                        $active_class = ''; // Reset active class for subsequent items
                                    }
                                    ?>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel"
                                    data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon bg-dark rounded-circle p-3"
                                        aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#productCarousel"
                                    data-bs-slide="next">
                                    <span class="carousel-control-next-icon bg-dark rounded-circle p-3"
                                        aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Product Details Column -->
                    <div class="col-lg-6">
                        <div class="ps-lg-4">
                            <!-- Title & Brand -->
                            <h6 class="text-uppercase text-muted fw-bold mb-2"><?php echo $product_data["brand"]; ?></h6>
                            <h1 class="display-6 fw-bold text-dark mb-3"><?php echo $product_data["product_name"]; ?></h1>

                            <!-- Seller Info -->
                            <div class="d-flex align-items-center mb-4">
                                <i class="bi bi-shop me-2 text-muted"></i>
                                <span class="text-muted small">Sold by: <span
                                        class="fw-bold text-dark"><?php echo $product_data["seller_email"]; ?></span></span>
                            </div>

                            <!-- Pricing Section -->
                            <div class="mb-4">
                                <?php
                                $price = $product_data["price"];
                                $discount_percentage = 0;
                                $old_price = 0;

                                if ($product_data["discount_id"] == 4)
                                    $discount_percentage = 10;
                                if ($product_data["discount_id"] == 2)
                                    $discount_percentage = 75;
                                if ($product_data["discount_id"] == 3)
                                    $discount_percentage = 50;

                                if ($discount_percentage > 0) {
                                    $adding_price = ($price / 100) * $discount_percentage;
                                    $old_price = $price + $adding_price;
                                    ?>
                                    <div class="d-flex align-items-center gap-3">
                                        <h2 class="display-5 fw-bold text-danger mb-0">Rs.<?php echo number_format($price); ?>.00
                                        </h2>
                                        <div class="d-flex flex-column">
                                            <span
                                                class="text-decoration-line-through text-muted fs-5">Rs.<?php echo number_format($old_price); ?>.00</span>
                                            <span class="badge bg-danger rounded-pill">-<?php echo $discount_percentage; ?>%
                                                OFF</span>
                                        </div>
                                    </div>
                                    <?php
                                } else {
                                    ?>
                                    <h2 class="display-5 fw-bold text-dark mb-0">Rs.<?php echo number_format($price); ?>.00</h2>
                                    <?php
                                }
                                ?>
                            </div>

                            <!-- Stock & Condition -->
                            <div class="row mb-4">
                                <div class="col-6">
                                    <div class="p-3 bg-light rounded-3">
                                        <small class="text-muted d-block mb-1">Condition</small>
                                        <span
                                            class="fw-bold text-dark"><?php echo ($product_data["condition_id"] == 1) ? "Brand New" : "Used"; ?></span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="p-3 bg-light rounded-3">
                                        <small class="text-muted d-block mb-1">Availability</small>
                                        <?php if ($product_data["qty"] > 0) { ?>
                                            <span class="fw-bold text-success">In Stock (<?php echo $product_data["qty"]; ?>)</span>
                                        <?php } else { ?>
                                            <span class="fw-bold text-danger">Out of Stock</span>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="card border-0 bg-light p-4 rounded-4 mb-4">
                                <?php if ($product_data["qty"] > 0) { ?>
                                    <div class="row g-3 align-items-end">
                                        <div class="col-12 col-md-3">
                                            <label class="form-label fw-bold small">Quantity</label>
                                            <input type="number" class="form-control form-control-lg bg-white border-0" value="1"
                                                min="1" max="<?php echo $product_data["qty"]; ?>" id="qty_input" />
                                        </div>
                                        <div class="col-6 col-md-5">
                                            <button class="btn btn-warning btn-lg w-100 fw-bold shadow-sm" type="submit"
                                                id="payhere-payment" onclick="buyNow(<?php echo $pid; ?>);">Buy Now</button>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <button class="btn btn-dark btn-lg w-100 fw-bold shadow-sm"
                                                onclick="addToCart(<?php echo $pid; ?>);"><i
                                                    class="bi bi-cart3 me-2"></i>Cart</button>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <div class="alert alert-warning mb-0" role="alert">
                                        <i class="bi bi-exclamation-triangle-fill me-2"></i> This item is currently unavailable.
                                    </div>
                                <?php } ?>

                                <div class="mt-3 text-center">
                                    <button
                                        class="btn btn-link text-decoration-none <?php echo ($watchlist_btn_class == 'btn-danger') ? 'text-danger' : 'text-muted'; ?>"
                                        onclick='addToWatchlist(<?php echo $pid; ?>);' id="heart<?php echo $pid; ?>">
                                        <i
                                            class="bi <?php echo ($watchlist_btn_class == 'btn-danger') ? 'bi-heart-fill' : 'bi-heart'; ?> me-2"></i>
                                        <?php echo ($watchlist_btn_class == 'btn-danger') ? 'Remove from Watchlist' : 'Add to Watchlist'; ?>
                                    </button>
                                </div>
                            </div>

                            <!-- Policy Info -->
                            <div class="d-flex gap-4 text-muted small">
                                <div><i class="bi bi-arrow-counterclockwise me-1"></i> 3 Months Return (Contact Seller)</div>
                                <div><i class="bi bi-shield-check me-1"></i> Warranty Available</div>
                            </div>

                            <?php if ($product_data["seller_email"] != "thehanaruth@gmail.com") { ?>
                                <div class="alert alert-info d-flex align-items-center mt-3 small mb-0" role="alert">
                                    <i class="bi bi-info-circle flex-shrink-0 me-2"></i>
                                    <div>
                                        Third-party listing. Support provided by platform. Verify within 2 weeks. Call 0772546723
                                        for help.
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <!-- Description Section -->
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="card border-0 shadow-sm rounded-4 p-4 p-lg-5">
                            <h3 class="fw-bold mb-4">Product Description</h3>
                            <p class="text-secondary lead" style="white-space: pre-line; line-height: 1.8;">
                                <?php echo $product_data["description"]; ?>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Related Items -->
                <div class="mt-5 mb-4">
                    <h3 class="fw-bold mb-4">Related Products</h3>
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 row-cols-lg-5 g-4">
                        <?php
                        $related_rs = Database::search("SELECT * FROM `products` WHERE `model_has_brand_id`='" . $product_data["model_has_brand_id"] . "' LIMIT 5");
                        $related_num = $related_rs->num_rows;
                        for ($y = 0; $y < $related_num; $y++) {
                            $related_data = $related_rs->fetch_assoc();
                            ?>
                            <div class="col">
                                <div class="card h-100 border-0 shadow-sm hover-shadow transition-all">
                                    <!-- Placeholder or Real Image Logic needed here if related items have images, using dummy for now or standard placeholder -->
                                    <div class="card-body p-4">
                                        <h6 class="card-title fw-bold text-dark text-truncate">
                                            <?php echo $related_data["product_name"]; ?>
                                        </h6>
                                        <p class="card-text text-primary fw-bold">LKR
                                            <?php echo number_format($related_data["price"]); ?>
                                        </p>
                                        <a href="<?php echo "sdds.php?id=" . ($related_data["id"]); ?>"
                                            class="btn btn-outline-dark btn-sm w-100">View</a>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>

            </div>
            <div class="container">
                <hr>
            </div>
            <div class="container mt-5 mb-5">
                <div class="row">
                    <h1 class="text-center mb-4 display-5 fw-bold text-dark">Customer Reviews</h1>

                    <div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2">
                        <?php
                        $feedback_rs = Database::search("SELECT * FROM `feedback` INNER JOIN `users` ON
                                feedback.users_email=users.email WHERE `products_id`='" . $pid . "' ORDER BY `date` DESC");

                        $feedback_num = $feedback_rs->num_rows;

                        if ($feedback_num == 0) {
                            ?>
                            <div class="alert alert-light text-center shadow-sm border p-5" role="alert">
                                <i class="bi bi-chat-square-text fs-1 text-muted mb-3 d-block"></i>
                                <h4 class="alert-heading text-muted">No feedback yet</h4>
                                <p class="text-muted">Be the first to review this product!</p>
                            </div>
                            <?php
                        } else {
                            ?>
                            <div class="list-group list-group-flush shadow-sm rounded-3">
                                <?php
                                for ($y = 0; $y < $feedback_num; $y++) {
                                    $feedback_data = $feedback_rs->fetch_assoc();
                                    ?>
                                    <div class="list-group-item p-4 border-0 border-bottom">
                                        <div class="d-flex w-100 justify-content-between align-items-center mb-2">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="bg-secondary text-white rounded-circle d-flex justify-content-center align-items-center fw-bold"
                                                    style="width: 45px; height: 45px; font-size: 1.2rem;">
                                                    <?php echo strtoupper(substr($feedback_data["user_name"], 0, 1)); ?>
                                                </div>
                                                <div>
                                                    <h5 class="mb-0 fw-bold text-dark"><?php echo $feedback_data["user_name"]; ?></h5>
                                                    <small class="text-muted"><?php echo $feedback_data["date"]; ?></small>
                                                </div>
                                            </div>
                                            <div class="text-warning fs-5">
                                                <?php
                                                $rating = $feedback_data["type"];
                                                // Assumption: type 1=3 stars, 2=2 stars?? The original code was weird.
                                                // Original logic:
                                                // type 1: 3 warning (gold)
                                                // type 2: 1 default (grey), 2 warning (gold)
                                                // type 3: 3 default (grey)
                                                // This seems like a rating system where 1 is best? Or maybe logic was flipped.
                                                // Let's standardise display based on original observation but improve icon.
                                
                                                if ($rating == 1) { // 3 Stars (Best)
                                                    echo '<i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>';
                                                } else if ($rating == 2) { // 2 Stars
                                                    echo '<i class="bi bi-star-fill text-secondary"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>';
                                                } else { // 1 Star or other
                                                    echo '<i class="bi bi-star-fill text-secondary"></i><i class="bi bi-star-fill text-secondary"></i><i class="bi bi-star-fill text-secondary"></i>';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <p class="mb-1 mt-3 text-secondary" style="font-size: 1.05rem; line-height: 1.6;">
                                            <?php echo $feedback_data["feedback"]; ?>
                                        </p>
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