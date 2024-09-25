<?php

include "connection.php";

session_start();

$search_txt = $_POST["t"];
$category = $_POST["cat"];
$brand = $_POST["b"];
$model = $_POST["m"];
$condition = $_POST["con"];
$color = $_POST["col"];
$price_from = $_POST["pf"];
$price_to = $_POST["pt"];
$sort = $_POST["s"];

$query = "SELECT * FROM `products`";
$status = 0;

if ($sort == 0) {

    if (!empty($search_txt)) {
        $query .= " WHERE `product_name` LIKE '%" . $search_txt . "%'";
        $status = 1;
    }

    if ($category != 0 && $status == 0) {
        $query .= " WHERE `category_id`='" . $category . "'";
        $status = 1;
    } else if ($category != 0 && $status != 0) {
        $query .= " AND `category_id`='" . $category . "'";
    }

    $pid = 0;
    if ($brand != 0 && $model == 0) {
        $model_has_brand_rs = Database::search("SELECT * FROM `model_has_brand` WHERE `brand_id`='" . $brand . "'");
        $model_has_brand_num = $model_has_brand_rs->num_rows;
        for ($x = 0; $x < $model_has_brand_num; $x++) {
            $model_has_brand_data = $model_has_brand_rs->fetch_assoc();
            $pid = $model_has_brand_data["id"];
        }

        if ($status == 0) {
            $query .= " WHERE `model_has_brand_id`='" . $pid . "'";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND model_has_brand_id`='" . $pid . "'";
        }
    }

    if ($brand == 0 && $model != 0) {
        $model_has_brand_rs = Database::search("SELECT * FROM `model_has_brand` WHERE `model_id`='" . $model . "'");
        $model_has_brand_num = $model_has_brand_rs->num_rows;
        for ($x = 0; $x < $model_has_brand_num; $x++) {
            $model_has_brand_data = $model_has_brand_rs->fetch_assoc();
            $pid = $model_has_brand_data["id"];
        }

        if ($status == 0) {
            $query .= " WHERE `model_has_brand_id`='" . $pid . "'";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND model_has_brand_id`='" . $pid . "'";
        }
    }

    if ($brand != 0 && $model != 0) {
        $model_has_brand_rs = Database::search("SELECT * FROM `model_has_brand` WHERE `brand_id`='" . $brand . "' 
        AND `model_id`='" . $model . "'");

        $model_has_brand_num = $model_has_brand_rs->num_rows;
        for ($x = 0; $x < $model_has_brand_num; $x++) {
            $model_has_brand_data = $model_has_brand_rs->fetch_assoc();
            $pid = $model_has_brand_data["id"];
        }

        if ($status == 0) {
            $query .= " WHERE `model_has_brand_id`='" . $pid . "'";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND model_has_brand_id`='" . $pid . "'";
        }
    }

    if ($condition != 0 && $status == 0) {
        $query .= " WHERE `condition_id`='" . $condition . "'";
        $status = 1;
    } else if ($condition != 0 && $status != 0) {
        $query .= " AND `condition_id`='" . $condition . "'";
    }

    $cid = 0;
    if ($color != 0) {
        $clr_rs = Database::search("SELECT * FROM `color_has_products` WHERE `color_id`='" . $color . "'");
        $clr_num = $clr_rs->num_rows;

        for ($x = 0; $x < $clr_num; $x++) {
            $clr_data = $clr_rs->fetch_assoc();
            $cid = $clr_data["products_id"];
        }

        if ($status == 0) {
            $query .= " WHERE `id`='" . $cid . "'";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND `id`='" . $cid . "'";
        }
    }

    if (!empty($price_from) && empty($price_to)) {
        if ($status == 0) {
            $query .= " WHERE `price` >= '" . $price_from . "'";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND `price` >= '" . $price_from . "'";
        }
    }

    if (empty($price_from) && !empty($price_to)) {
        if ($status == 0) {
            $query .= " WHERE `price` <= '" . $price_to . "'";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND `price` <= '" . $price_to . "'";
        }
    }

    if (!empty($price_from) && !empty($price_to)) {
        if ($status == 0) {
            $query .= " WHERE `price` BETWEEN '" . $price_from . "' AND '" . $price_to . "'";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND `price` BETWEEN '" . $price_from . "' AND '" . $price_to . "'";
        }
    }
} else if ($sort == 1) {

    if (!empty($search_txt)) {
        $query .= " WHERE `product_name` LIKE '%" . $search_txt . "%' ORDER BY `price` ASC";
        $status = 1;
    }

    if ($category != 0 && $status == 0) {
        $query .= " WHERE `category_cat_id`='" . $category . "' ORDER BY `price` ASC";
        $status = 1;
    } else if ($category != 0 && $status != 0) {
        $query .= " AND `category_cat_id`='" . $category . "' ORDER BY `price` ASC";
    }

    $pid = 0;
    if ($brand != 0 && $model == 0) {
        $model_has_brand_rs = Database::search("SELECT * FROM `model_has_brand` WHERE `brand_brand_id`='" . $brand . "'");
        $model_has_brand_num = $model_has_brand_rs->num_rows;
        for ($x = 0; $x < $model_has_brand_num; $x++) {
            $model_has_brand_data = $model_has_brand_rs->fetch_assoc();
            $pid = $model_has_brand_data["id"];
        }

        if ($status == 0) {
            $query .= " WHERE `model_has_brand_id`='" . $pid . "' ORDER BY `price` ASC";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND model_has_brand_id`='" . $pid . "' ORDER BY `price` ASC";
        }
    }

    if ($brand == 0 && $model != 0) {
        $model_has_brand_rs = Database::search("SELECT * FROM `model_has_brand` WHERE `model_model_id`='" . $model . "'");
        $model_has_brand_num = $model_has_brand_rs->num_rows;
        for ($x = 0; $x < $model_has_brand_num; $x++) {
            $model_has_brand_data = $model_has_brand_rs->fetch_assoc();
            $pid = $model_has_brand_data["id"];
        }

        if ($status == 0) {
            $query .= " WHERE `model_has_brand_id`='" . $pid . "' ORDER BY `price` ASC";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND model_has_brand_id`='" . $pid . "' ORDER BY `price` ASC";
        }
    }

    if ($brand != 0 && $model != 0) {
        $model_has_brand_rs = Database::search("SELECT * FROM `model_has_brand` WHERE `brand_brand_id`='" . $brand . "' 
        AND `model_model_id`='" . $model . "'");

        $model_has_brand_num = $model_has_brand_rs->num_rows;
        for ($x = 0; $x < $model_has_brand_num; $x++) {
            $model_has_brand_data = $model_has_brand_rs->fetch_assoc();
            $pid = $model_has_brand_data["id"];
        }

        if ($status == 0) {
            $query .= " WHERE `model_has_brand_id`='" . $pid . "' ORDER BY `price` ASC";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND model_has_brand_id`='" . $pid . "' ORDER BY `price` ASC";
        }
    }

    if ($condition != 0 && $status == 0) {
        $query .= " WHERE `condition_id`='" . $condition . "' ORDER BY `price` ASC";
        $status = 1;
    } else if ($condition != 0 && $status != 0) {
        $query .= " AND `condition_id`='" . $condition . "' ORDER BY `price` ASC";
    }

    $cid = 0;
    if ($color != 0) {
        $clr_rs = Database::search("SELECT * FROM `product_has_color` WHERE `color_clr_id`='" . $color . "'");
        $clr_num = $clr_rs->num_rows;

        for ($x = 0; $x < $clr_num; $x++) {
            $clr_data = $clr_rs->fetch_assoc();
            $cid = $clr_data["product_id"];
        }

        if ($status == 0) {
            $query .= " WHERE `id`='" . $cid . "' ORDER BY `price` ASC";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND `id`='" . $cid . "' ORDER BY `price` ASC";
        }
    }

    if (!empty($price_from) && empty($price_to)) {
        if ($status == 0) {
            $query .= " WHERE `price` >= '" . $price_from . "' ORDER BY `price` ASC";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND `price` >= '" . $price_from . "' ORDER BY `price` ASC";
        }
    }

    if (empty($price_from) && !empty($price_to)) {
        if ($status == 0) {
            $query .= " WHERE `price` <= '" . $price_to . "' ORDER BY `price` ASC";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND `price` <= '" . $price_to . "' ORDER BY `price` ASC";
        }
    }

    if (!empty($price_from) && !empty($price_to)) {
        if ($status == 0) {
            $query .= " WHERE `price` BETWEEN '" . $price_from . "' AND '" . $price_to . "' ORDER BY `price` ASC";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND `price` BETWEEN '" . $price_from . "' AND '" . $price_to . "' ORDER BY `price` ASC";
        }
    }
}

?>

<!-- <div class="row">
    <div class="offset-lg-1 col-12 col-lg-10 text-center">
        <div class="row"> -->

<?php

$pageno;

if ("0" != ($_POST["page"])) {
    $pageno = $_POST["page"];
} else {
    $pageno = 1;
}

$product_rs = Database::search($query);
$product_num = $product_rs->num_rows;

$results_per_page = 6;
$number_of_pages = ceil($product_num / $results_per_page);

$page_results = ($pageno - 1) * $results_per_page;
$selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

$selected_num = $selected_rs->num_rows;
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
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>

<?php
}
?>
<footer>
<div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
    <nav aria-label="Page navigation example">
        <ul class="pagination pagination-lg justify-content-center">
            <li class="page-item">
                <a class="page-link" <?php if ($pageno <= 1) {
                                            echo ("#");
                                        } else {
                                        ?> onclick="advancedSearch(<?php echo ($pageno - 1); ?>);" ; <?php
                                                                                                                } ?> aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>

            <?php
            for ($x = 1; $x <= $number_of_pages; $x++) {
                if ($x == $pageno) {
            ?>
                    <li class="page-item active">
                        <a class="page-link" onclick="advancedSearch(<?php echo ($x); ?>);"><?php echo $x; ?></a>
                    </li>
                <?php
                } else {
                ?>
                    <li class="page-item">
                        <a class="page-link" onclick="advancedSearch(<?php echo ($x); ?>);"><?php echo $x; ?></a>
                    </li>
            <?php
                }
            }
            ?>

            <li class="page-item">
                <a class="page-link" <?php if ($pageno >= $number_of_pages) {
                                            echo ("#");
                                        } else {
                                        ?> onclick="advancedSearch(<?php echo ($pageno + 1); ?>);" ; <?php
                                                                                                                } ?> aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>
</footer>

<!-- </div>
    </div>
</div> -->