<?php
session_start();
include "connection.php";

$user = $_SESSION["users"]["email"];

$search = $_POST["s"];
$time = $_POST["t"];
$qty = $_POST["q"];
$condition = $_POST["con"];
$category = $_POST["cat"];


$query = "SELECT * FROM `products` WHERE `seller_email`='" . $user . "'";
$pid = "SELECT `id` FROM `products` WHERE `seller_email`='" . $user . "'";
$brand = "SELECT `brand_id` FROM `model_has_brand` WHERE `id`='" . $pid . "'";
$brand = "SELECT `brand_id` FROM `model_has_brand` WHERE `id`='" . $pid . "'";

if (!empty($search)) {
    $query .= " AND `product_name` LIKE '%" . $search . "%'";
}

if (!empty($category)) {
    $query .= " AND `category_id`='" . $category . "'";
}

if (!empty($condition)) {
    $query .= " AND `condition_id`='" . $condition . "'";
}

if ($time != "0") {
    if ($time == "1") {
        $query .= " ORDER BY `adedd_date` DESC";
    } else if ($time == "2") {
        $query .= " ORDER BY `adedd_date` ASC";
    }
}

if ($time != "0" && $qty != "0") {
    if ($qty == "1") {
        $query .= " , `qty` DESC";
    } else if ($qty == "2") {
        $query .= " , `qty` ASC";
    }
} else if ($time == "0" && $qty != "0") {
    if ($qty == "1") {
        $query .= " ORDER BY `qty` DESC";
    } else if ($qty == "2") {
        $query .= " ORDER BY `qty` ASC";
    }
}

?>
<style>
    .product-card {
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 20px;
        margin-bottom: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .product-card img {
        width: 30%;
        border-radius: 8px;
        border: #ddd solid 1px;
    }

    .product-info {
        flex: 1;
        margin-left: 20px;
    }

    .product-info h5 {
        margin-bottom: 10px;
        font-size: 18px;
    }

    .product-info p {
        margin-bottom: 5px;
        font-size: 16px;
    }

    .product-actions {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
    }

    .product-actions button {
        margin-top: 5px;
    }

    .pagination {
        justify-content: center;
    }
</style>

<div class="row">

    <?php



    if ("0" != ($_POST["page"])) {
        $pageno = $_POST["page"];
    } else {
        $pageno = 1;
    }

    $product_rs = Database::search($query);
    $product_num = $product_rs->num_rows;

    if ($product_num == 0) {
    ?>
        <br><br><br>
        <div class="offset-lg-4 offset-3">
            <div class="justify-content-center align-items-center d-flex">
                <?php include "loading.php"; ?><br>
            </div>
            <h1 class="text-center"><br>No Product Found</h1>

        </div>

        <?php
        // echo "<h1 class='text-center'><br>! Your not Added any Product</h1>";
    } else {

        $results_per_page = 6;
        $number_of_pages = ceil($product_num / $results_per_page);

        $page_results = ($pageno - 1) * $results_per_page;
        $selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

        $selected_num = $selected_rs->num_rows;
        for ($x = 0; $x < $selected_num; $x++) {
            $selected_data = $selected_rs->fetch_assoc();
        ?>
            <div class="col-lg-6 col-md-12 justify-content-center align-items-center d-flex">
                <div class="product-card">
                    <?php
                    $img_rs = Database::search("SELECT * FROM `product_img` WHERE `products_id`='" . $selected_data["id"] . "'");
                    $img_data = $img_rs->fetch_assoc();
                    ?>
                    <img src="<?php echo $img_data["image_path"]; ?>" alt="Product Image" class="product-image">
                    <div class="product-details">
                        <h5><?php echo $selected_data["product_name"]; ?></h5>
                        <p>Rs. <?php echo $selected_data["price"]; ?>.00<br><?php echo $selected_data["qty"]; ?> Items left</p>
                    </div>
                    <div class="product-actions">
                        <button class="btn btn-dark btn-update">Update</button>
                        <?php
                        if ($selected_data["product_status"] == 1) {
                        ?>
                            <button class="btn btn-success " onclick='p_deactive(<?php echo $selected_data["id"]; ?>);'>Active</button>
                        <?php
                        } else {
                        ?>
                            <button class="btn btn-danger " onclick='p_active(<?php echo $selected_data["id"]; ?>);'>Deactive</button>
                        <?php
                        }
                        ?>

                    </div>
                </div>
            </div>
        <?php
        }

        ?>
</div>
<div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
    <nav aria-label="Page navigation example">
        <ul class="pagination pagination-lg justify-content-center">
            <li class="page-item">
                <a style="color: #6c757d;" class="page-link" onclick="showSection('stats')" href="
                    <?php if ($pageno <= 1) {
                        echo ("#");
                    } else {
                        echo "?page=" . ($pageno - 1);
                    } ?>
                    " aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>

            <?php
            for ($x = 1; $x <= $number_of_pages; $x++) {
                if ($x == $pageno) {
            ?>
                    <li class="page-item active">
                        <a style="border-color: #6c757d; background-color: #6c757d;" class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                    </li>
                <?php
                } else {
                ?>
                    <li class="page-item">
                        <a style="color: #6c757d;" class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                    </li>
            <?php
                }
            }
            ?>

            <li class="page-item">
                <a style="color: #6c757d;" class="page-link" href="
                                                    <?php if ($pageno >= $number_of_pages) {
                                                        echo ("#");
                                                    } else {
                                                        echo "?page=" . ($pageno + 1);
                                                    } ?>
                                                    " aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>

</div>
<?php
    }
?>