<?php
include "connection.php";
session_start();

$txt = $_POST["t"];

$query = "SELECT * FROM `products` ";

if (!empty($txt)) {
    $query .= "WHERE `product_name` LIKE '%" . $txt . "%'";
}

?>

<h1 class="text-center mb-3">Search results...</h1>
<div class="justify-content-center align-items-center d-flex">
<a href="advancedSearch.php" class="btn btn-secondary col-3 mb-2">Advance Search option</a>
</div>




            <?php

            $pageno;

            if ("0" != ($_POST["page"])) {
                $pageno = $_POST["page"];
            } else {
                $pageno = 1;
            }

            $product_rs = Database::search($query);
            $product_num = $product_rs->num_rows;

            $results_per_page = 12;
            $number_of_pages = ceil($product_num / $results_per_page);

            $page_results = ($pageno - 1) * $results_per_page;
            $selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

            $selected_num = $selected_rs->num_rows;
            if($selected_num == 0){
                ?>
                <?php include "loading.php";?>
                <h1 class="text-center">!No Product Found</h1>
                <?php
            }else{
            for ($x = 0; $x < $selected_num; $x++) {
                $selected_data = $selected_rs->fetch_assoc();
                

                
            ?>
                <div class="col-md-3 col-sm-6 mb-4">
                <div class="product-card">
                    <div class="product-image-container">
                        <?php
                        $img_rs = Database::search("SELECT * FROM `product_img` WHERE `products_id`='" . $selected_data["id"] . "'");
                        $img_data = $img_rs->fetch_assoc();
                        ?>
                        <img src="<?php echo $img_data["image_path"]; ?>" alt="Product Image" class="product-image mx-auto d-block img-fluid">
                    </div>
                    <div class="product-details">
                        <h5 class="mt-3"><?php echo $selected_data["product_name"]; ?></h5>
                        <p class="text-muted mt-3">Rs.<?php echo $selected_data["price"]; ?>.00</p>
                        <?php if ($selected_data["qty"] > 0) { ?>
                            <span class="badge badge-warning ">Available</span>
                            <a  href="<?php echo "sdds.php?id=" . $selected_data["id"]; ?>" class="col-12 btn btn-warning btn-sm">Buy Now</a>
                            <button class="btn btn-outline-dark col-12 btn-sm mt-2" onclick="addToCart(<?php echo $selected_data['id']; ?>);">
                                <i class="fa-solid fa-cart-plus"></i>
                            </button>
                        <?php } else { ?>
                            <span class="badge badge-danger mb-3">Out of Stock</span>
                            <a class="col-12 btn btn-warning btn-sm disabled">Buy Now</a>
                            <button class="btn btn-outline-dark col-12 btn-sm mt-2 disabled">
                                <i class="fa-solid fa-cart-plus"></i>
                            </button>
                        <?php } ?>
                        
                        <?php if (isset($_SESSION["user"])) { 
                            $watchlist_rs = Database::search("SELECT * FROM `wichlist` WHERE `users_email`='" . $_SESSION["user"]["email"] . "' 
                            AND `products_id`='" . $selected_data["id"] . "'");
                            $watchlist_num = $watchlist_rs->num_rows;
                            if ($watchlist_num == 1) { ?>
                                <button class="btn mt-2" onclick='addToWatchlist(<?php echo $selected_data["id"]; ?>);'>
                                    <i class="fa-solid text-danger fa-heart" id="heart<?php echo $selected_data["id"]; ?>"></i>
                                </button>
                            <?php } else { ?>
                                <button class="btn mt-2" onclick='addToWatchlist(<?php echo $selected_data["id"]; ?>);'>
                                    <i class="fa-solid fa-heart text-dark" id="heart<?php echo $selected_data["id"]; ?>"></i>
                                </button>
                            <?php }}
                            ?>
                    </div>
                </div>
            </div>

            <?php
            }
        }
            ?>

<footer>


            <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
                <nav aria-label="Page navigation example">
                    <ul class="pagination pagination-lg justify-content-center">
                        <li class="page-item">
                            <a class="page-link text-dark" <?php if ($pageno <= 1) {
                                                        echo ("#");
                                                    } else {
                                                    ?> onclick="basicSearch(<?php echo ($pageno - 1); ?>);" ; <?php
                                                                                                            } ?> aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>

                        <?php
                        for ($x = 1; $x <= $number_of_pages; $x++) {
                            if ($x == $pageno) {
                        ?>
                                <li class="page-item active bg-black">
                                    <a class="page-link bg-black border-dark" onclick="basicSearch(<?php echo ($x); ?>);"><?php echo $x; ?></a>
                                </li>
                            <?php
                            } else {
                            ?>
                                <li class="page-item bg-black">
                                    <a class="page-link bg-black border-dark" onclick="basicSearch(<?php echo ($x); ?>);"><?php echo $x; ?></a>
                                </li>
                        <?php
                            }
                        }
                        ?>

                        <li class="page-item text-dark">
                            <a class="page-link text-dark" <?php if ($pageno >= $number_of_pages) {
                                                        echo ("#");
                                                    } else {
                                                    ?> onclick="basicSearch(<?php echo ($pageno + 1); ?>);" ; <?php
                                                                                                            } ?> aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            </footer>
            