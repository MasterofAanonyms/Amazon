<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amazon.lk | Admin Dashboard</title>

    <!-- CSS -->
    <link rel="stylesheet" href="../bootstrap_files/bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="anim.css">
    <!-- CSS -->

    <!-- icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- icons -->
</head>

<?php

session_start();

include "connection.php";

if (isset($_SESSION["admin"])) {

    // include "admin-header.php";

?>
<?php include "adminNavBar.php"; ?>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col py-3">

                <div class="container-fluid">

                    <div class="text-white fw-bold mb-2 mt-2">
                        <h3 class="fw-bold text-body text-center">Dashboard</h3>
                        <hr />
                    </div>
                    <div class="col-12">
                    </div>
                    <div class="col-12">
                        <div class="row g-1">

                            <div class="col-6 col-lg-4 px-1 shadow">
                                <div class="row g-1">
                                    <div class="col-12 bg-dark text-white text-center rounded" style="height: 100px;">
                                        <br />
                                        <span class="fs-4 fw-bold">Daily Earnings</span>

                                        <?php

                                        $today = date("Y-m-d");
                                        $thismonth = date("m");
                                        $thisyear = date("Y");

                                        $a = "0";
                                        $b = "0";
                                        $c = "0";
                                        $e = "0";
                                        $f = "0";

                                        $invoice_rs = Database::search("SELECT * FROM `invoice`");
                                        $invoice_num = $invoice_rs->num_rows;

                                        for ($x = 0; $x < $invoice_num; $x++) {
                                            $invoice_data = $invoice_rs->fetch_assoc();

                                            $f = $f + $invoice_data["qty"]; //total qty

                                            $d = $invoice_data["date"];
                                            $splitDate = explode(" ", $d); //separate the date from time
                                            $pdate = $splitDate["0"]; //sold date

                                            if ($pdate == $today) {
                                                $a = $a + $invoice_data["total"];
                                                $c = $c + $invoice_data["qty"];
                                            }

                                            $splitMonth = explode("-", $pdate); //separate date as year,month & day
                                            $pyear = $splitMonth["0"]; //year
                                            $pmonth = $splitMonth["1"]; //month

                                            if ($pyear == $thisyear) {
                                                if ($pmonth == $thismonth) {
                                                    $b = $b + $invoice_data["total"];
                                                    $e = $e + $invoice_data["qty"];
                                                }
                                            }
                                        }

                                        ?>

                                        <br />
                                        <span class="fs-5">Rs. <?php echo $a; ?> .00</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 col-lg-4 px-1">
                                <div class="row g-1">
                                    <div class="col-12 bg-body-secondary text-black text-center rounded" style="height: 100px;">
                                        <br />
                                        <span class="fs-4 fw-bold">Monthly Earnings</span>
                                        <br />

                                        <span class="fs-5">Rs. <?php echo $b; ?> .00</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 col-lg-4 px-1">
                                <div class="row g-1">
                                    <div class="col-12 bg-dark text-white text-center rounded" style="height: 100px;">
                                        <br />
                                        <span class="fs-4 fw-bold">Today Sellings</span>
                                        <br />
                                        <span class="fs-5"><?php echo $c; ?> Items</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 col-lg-4 px-1">
                                <div class="row g-1">
                                    <div class="col-12 bg-secondary text-white text-center rounded" style="height: 100px;">
                                        <br />
                                        <span class="fs-4 fw-bold">Monthly Sellings</span>
                                        <br />
                                        <span class="fs-5"><?php echo $e; ?> Items</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 col-lg-4 px-1">
                                <div class="row g-1">
                                    <div class="col-12 bg-warning text-white text-center rounded" style="height: 100px;">
                                        <br />
                                        <span class="fs-4 fw-bold">Total Sellings</span>
                                        <br />
                                        <span class="fs-5"><?php echo $f; ?> Items</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 col-lg-4 px-1 shadow">
                                <div class="row g-1">
                                    <div class="col-12 bg-secondary text-white text-center rounded" style="height: 100px;">
                                        <br />
                                        <span class="fs-4 fw-bold">Total Engagements</span>
                                        <br />
                                        <?php
                                        $user_rs = Database::search("SELECT * FROM `users`");
                                        $user_num = $user_rs->num_rows;
                                        ?>
                                        <span class="fs-5"><?php echo $user_num; ?> Members</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-12">
                        <hr />
                    </div>

                    <div class="row g-4">

                        <div class="col-12 col-lg-6 my-3 rounded bg-body">
                            <div class="row g-1">
                                <div class="col-12 text-center">
                                    <label class="form-label fs-4 fw-bold text-decoration-underline">Mostly Sold Item</label>
                                </div>

                                <?php

                                $freq_rs = Database::search("SELECT `products_id`,COUNT(`products_id`) AS `value_occurence` FROM `invoice` 
                                WHERE `status` = '1' AND `date` LIKE '%" . $today . "%' GROUP BY `products_id` ORDER BY `value_occurence` DESC LIMIT 1");

                                $freq_num = $freq_rs->num_rows;

                                if ($freq_num > 0) {

                                    $freq_data = $freq_rs->fetch_assoc();

                                    $product_rs = Database::search("SELECT * FROM `products` WHERE `id`='" . $freq_data["products_id"] . "'");
                                    $product_data = $product_rs->fetch_assoc();

                                    $image_rs = Database::search("SELECT * FROM `product_img` WHERE `products_id`='" . $freq_data["products_id"] . "'");
                                    $image_data = $image_rs->fetch_assoc();

                                    $qty_rs = Database::search("SELECT SUM(`qty`) AS `qty_total` FROM `invoice` WHERE 
                                    `products_id`='" . $freq_data["products_id"] . "' AND `date` LIKE '%" . $today . "%'");
                                    $qty_data = $qty_rs->fetch_assoc();

                                ?>
                                    <div class="col-12 text-center shadow">
                                        <img src="../<?php echo $image_data["image_path"]; ?>" class="img-fluid rounded-top" style="height: 250px;" />
                                    </div>
                                    <div class="col-12 text-center my-3">
                                        <span class="fs-5 fw-bold"><?php echo $product_data["product_name"]; ?></span><br />
                                        <span class="fs-6"><?php echo $qty_data["qty_total"]; ?> items</span><br />
                                        <span class="fs-6">LKR <?php echo $qty_data["qty_total"] * $product_data["price"]; ?></span>
                                    </div>
                                <?php

                                } else {
                                ?>
                                    <!-- empty product -->
                                    <div class="col-12 text-center shadow">
                                        <img src="../resourcesofwebsiteimg/empty_folder.jpeg" class="img-fluid rounded-top" style="height: 250px;" />
                                    </div>
                                    <div class="col-12 text-center my-3">
                                        <span class="fs-5 fw-bold">-----</span><br />
                                        <span class="fs-6">--- items</span><br />
                                        <span class="fs-6">LKR ----- </span>
                                    </div>
                                    <!-- empty product -->
                                <?php
                                }

                                ?>

                                <div class="col-12">
                                    <div class="first-place"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6 my-3 rounded bg-body">
                            <div class="row g-1">

                                <?php

                                if ($freq_num > 0) {

                                    $profile_rs = Database::search("SELECT * FROM `profile_img` WHERE `users_email`='" . $product_data["seller_email"] . "'");
                                    $profile_data = $profile_rs->fetch_assoc();
                                    $profile_num = $profile_rs->num_rows;

                                    $user_rs1 = Database::search("SELECT * FROM `users` WHERE `email`='" . $product_data["seller_email"] . "'");
                                    $user_data1 = $user_rs1->fetch_assoc();

                                ?>
                                    <div class="col-12 text-center">
                                        <label class="form-label fs-4 fw-bold text-decoration-underline">Most Popular Seller</label>
                                    </div>
                                    <?php
                                    if ($profile_num < 1) {
                                    ?>
                                    <div class="col-12 text-center shadow">
                                        <img src="../resourcesofwebsiteimg/user_male.svg" class="img-fluid rounded-top" style="height: 250px;" />
                                    </div>
                                    <?php
                                    }else{
                                        ?>
                                        <div class="col-12 text-center shadow">
                                        <img src="../<?php echo $profile_data["path"]; ?>" class="img-fluid rounded-top" style="height: 250px;" />
                                    </div>
                                        <?php

                                    }
                                    ?>
                                    <div class="col-12 text-center my-3">
                                        <span class="fs-5 fw-bold"><?php echo $user_data1["user_name"]; ?></span><br />
                                        <span class="fs-6"><?php echo $user_data1["email"]; ?></span><br />
                                        <span class="fs-6"><?php echo $user_data1["phone_no"]; ?></span>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <!-- empty user -->
                                    <div class="col-12 text-center">
                                        <label class="form-label fs-4 fw-bold text-decoration-underline">Most Popular Seller</label>
                                    </div>
                                    <div class="col-12 text-center shadow">
                                        <img src="../resourcesofwebsiteimg/user_male.svg" class="img-fluid rounded-top" style="height: 250px;" />
                                    </div>
                                    <div class="col-12 text-center my-3">
                                        <span class="fs-5 fw-bold">----- -----</span><br />
                                        <span class="fs-6">-----</span><br />
                                        <span class="fs-6">----------</span>
                                    </div>
                                    <!-- empty user -->
                                <?php
                                }

                                ?>

                                <div class="col-12">
                                    <div class="first-place"></div>
                                </div>
                            </div>
                        </div>


                    </div>

                </div>

            </div>
        </div>
    </div>

    <!-- js -->
    <script src="script.js"></script>
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