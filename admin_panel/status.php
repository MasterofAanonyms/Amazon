<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amazon.lk | Admin Order Management</title>

    <!-- CSS -->
    <link rel="stylesheet" href="../bootstrap_files/bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="anim.css">
    <!-- CSS -->

    <!-- icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- icons -->

    <style>
    .table thead th {
        border-bottom: 2px solid #dee2e6;
    }

    .table tbody tr td {
        vertical-align: middle;
    }

    .status-active {
        color: #28a745;
        background-color: #d4edda;
        border-color: #c3e6cb;
    }

    .status-waiting {
        color: red;
        background-color: rgba(255, 0, 0, 0.388);
        border-color: red;
    }

    .remove-icon {
        color: red;
        cursor: pointer;
    }

    .user-info {
        display: flex;
        align-items: center;
    }

    .fimg {
        width: 10%;
        margin-right: 10px;
    }

    .user-info .added-date {
        font-size: 0.9em;
        color: #6c757d;
    }
</style>
</head>

<?php

session_start();

include "connection.php";

if (isset($_SESSION["admin"])) {

    // include "admin-header.php";

?>
<?php include "adminNavBar.php"; ?>

<br>
<h1 class="text-center">Product Status</h1>
    
<div class="container my-3">
    <?php
    $email = $_SESSION["admin"]["email"];

    if (isset($_GET["page"])) {
        $pageno = $_GET["page"];
    } else {
        $pageno = 1;
    }

    $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `seller_email`='" . $email . "' ");
    $invoice_num = $invoice_rs->num_rows;

    if ($invoice_num == 0) {
    ?>
        <br><br><br>
        <h1 class="text-center">You Haven't any order</h1>
        <div class="justify-content-center align-items-center d-flex">

            <?php include "../loading.php"; ?><br>
        </div>

    <?php
        // echo "<h1 class='text-center'><br>! Your not Added any Product</h1>";
    } else {
        $results_per_page = 5;
        $number_of_pages = ceil($invoice_num / $results_per_page);

        $page_results = ($pageno - 1) * $results_per_page;

        $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `seller_email`='" . $email . "' ");
        $invoice_num = $invoice_rs->num_rows;
        // $selected_rs = Database::search("SELECT * FROM `products` WHERE `id`='".$invoice_data["products_id"]."' LIMIT " . $results_per_page . " OFFSET " . $page_results . "");
        //  Database::search("SELECT * FROM `products` WHERE `id`='" . $product_id . "' AND `seller_email`='" . $email . "' LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

        // $selected_num = $selected_rs->num_rows;
    ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Product</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($x = 0; $x < $invoice_num; $x++) {
                    $invoice_data = $invoice_rs->fetch_assoc();

                    $product_rs = Database::search("SELECT * FROM `products` WHERE `id`='" . $invoice_data["products_id"] . "'");
                    $product_data = $product_rs->fetch_assoc();
                    if ($invoice_data["type"] == 1) {
                        $img_rs = Database::search("SELECT * FROM `product_img` WHERE `products_id`='" . $product_data["id"] . "'");
                        $img_data = $img_rs->fetch_assoc();
                    }

                ?>
                    <tr>
                        <td>#<?php echo $invoice_data['id']; ?></td>
                        <td class="user-info">
                            <?php
                            if ($invoice_data["type"] == 2) {
                            } else {


                                $img_rs = Database::search("SELECT * FROM `product_img` WHERE `products_id`='" . $invoice_data["products_id"] . "'");
                                $img_data = $img_rs->fetch_assoc();

                            ?>
                                <img src="../<?php echo $img_data["image_path"]; ?>" class="fimg" alt="User Image">
                            <?php
                            }
                            ?>
                            <div>
                                <div><?php echo $invoice_data['users_email']; ?></div>
                                <div>LKR.<?php echo $invoice_data['total']; ?>.00</div>
                                <div class="added-date">Pharches: <?php echo $invoice_data['date']; ?></div>
                                <?php
                                if ($invoice_data["type"] == 2) {
                                ?>
                       <div class="bg-warning justify-content-center align-items-center d-flex" style="border-radius: 5px;">From Cart</div>
                    <?php
                                } 
                                ?>
</div>
</td>
<?php
                    if ($invoice_data["type"] == 2) {
?>
    <td class="col-3"><?php echo $invoice_data["items"]; ?></td>
<?php
                    } else {
?>
    <td class="col-3"><?php echo $product_data["product_name"]; ?></td>
<?php
                    }
?>

<?php
                    if ($invoice_data['status'] == '0') {
?>
    <td class="col-2"><button class="btn btn-dark" onclick='updatestatus(<?php echo $invoice_data["id"]; ?>);'>Process data</button></td>
<?php
                    } else if ($invoice_data['status'] == '1') {
?>
    <td class="col-2"><button class="btn btn-dark" onclick='updatestatus(<?php echo $invoice_data["id"]; ?>);'>Product Shipped</button></td>
<?php
                    } else if ($invoice_data['status'] == '2') {
?>
    <td class="col-2"><button class="btn btn-dark" onclick='updatestatus(<?php echo $invoice_data["id"]; ?>);'>Deleverd</button></td>
<?php
                    } else {
?>
    <td class="col-2"><button class="btn btn-success">Done</button></td>
<?php
                    }
?>
</tr>
<?php
                }
?>
</tbody>
</table>

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
                    <a style="border-color: #6c757d; background-color: #6c757d;" class="page-link" onclick="showSection('stats')" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                </li>
            <?php
            } else {
            ?>
                <li class="page-item">
                    <a style="color: #6c757d;" class="page-link" onclick="showSection('stats')" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
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

    <!-- js -->
    <script src="script.js"></script>
    <script src="../script.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"></script>
    <!-- js -->

    <!-- js sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- js sweetalert -->
    </body>

<?php

} else {

    header("Location: ../admin_signin.php");
}

?>

</html>