<?php
$page_number;
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

<div class="container mt-5">

    <div class="row ">
        <?php
        $product_rs = Database::search("SELECT * FROM `products` WHERE `seller_email`='" . $email . "'");
        $product_num = $product_rs->num_rows;
        if ($product_num == 0) {
        ?>
            <br><br><br>
            <div class="offset-lg-3 offset-3 mt-5"><br><br><br>
                <div class="justify-content-center align-items-center d-flex">
                    <?php include "loading.php"; ?><br>
                </div>
                <h1 class="text-center"><br>No Product Found from Your account</h1>

            </div>

        <?php
            // echo "<h1 class='text-center'><br>! Your not Added any Product</h1>";
        } else {
        ?>

            <div class="card col-lg-4 col-12 mt-4">
                <div class="card-header">
                    Sort Products
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search with your product name..." id="search">
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12 col-lg-12 col-12">
                            <label for="productCategory">Product Category</label>
                            <select class="form-control" id="categorys">
                                <option value="0">Select Category</option>
                                <?php
                                $category_rs = Database::search("SELECT * FROM `category`");
                                $category_num = $category_rs->num_rows;

                                for ($x = 0; $x < $category_num; $x++) {
                                    $category_data = $category_rs->fetch_assoc();
                                ?>
                                    <option value="<?php echo $category_data["id"]; ?>">
                                        <?php echo $category_data["category"]; ?>
                                    </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="productCategory">Product Condition</label>
                            <select class="form-control" id="conditions">
                                <option value="0">Select Condition</option>
                                <?php
                                $condition_rs = Database::search("SELECT * FROM `condition`");
                                $condition_num = $condition_rs->num_rows;

                                for ($x = 0; $x < $condition_num; $x++) {
                                    $condition_data = $condition_rs->fetch_assoc();
                                ?>
                                    <option value="<?php echo $condition_data["id"]; ?>">
                                        <?php echo $condition_data["condition"]; ?>
                                    </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-6">
                            <label for="productCategory">Active Time</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="r1" id="n">
                                <label class="form-check-label" for="n">
                                    Newest to oldest
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="r1" id="o">
                                <label class="form-check-label" for="o">
                                    Oldest to newest
                                </label>
                            </div>
                        </div>
                        <!-- <div class="form-group col-lg-12 col-md-12 col-6">
                        <label for="productCategory">By quantity</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="r1" id="h">
                            <label class="form-check-label" for="h">
                                High to low
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="r1" id="l">
                            <label class="form-check-label" for="l">
                                Low to high
                            </label>
                        </div>
                    </div> -->

                        <div class="col-12">
                        <label for="productQTY">By quantity</label>
                            <div class="form-check">
                            
                                <input class="form-check-input" type="radio" name="r2" id="h">
                                <label class="form-check-label" for="h">
                                    High to low
                                </label>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="r2" id="l">
                                <label class="form-check-label" for="l">
                                    Low to high
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="mt-2">
                        <button class="btn btn-warning col-12 mb-2" onclick="sort1(0);">Sort</button>
                        <button class="btn btn-secondary col-12" onclick="clearSort();">Clear</button>
                    </div>
                </div>
            </div>
            <!-- https://www.blackbox.ai/publish/8vmOqW9wC0Mdez_Vdu66x  -->
            <div class="col-lg-8 col-md-12 mt-4" id="sort">
                <div class="row">
                    <?php
                    $email = $_SESSION["users"]["email"];

                    if (isset($_GET["page"])) {
                        $pageno = $_GET["page"];
                    } else {
                        $pageno = 1;
                    }


                    $results_per_page = 6;
                    $number_of_pages = ceil($product_num / $results_per_page);

                    $page_results = ($pageno - 1) * $results_per_page;
                    $selected_rs = Database::search("SELECT * FROM `products` WHERE `seller_email`='" . $email . "' LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

                    $selected_num = $selected_rs->num_rows;

                    for ($x = 0; $x < $selected_num; $x++) {
                        $selected_data = $selected_rs->fetch_assoc();
                    ?>
                        <div class="col-lg-6 col-md-12">
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
                                    <button class="btn btn-dark btn-update" onclick="sendid(<?php echo $selected_data['id']; ?>);">Update</button>
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
            <?php
        }
            ?>
            </div>
    </div>
</div>

<script src="script.js"></script>