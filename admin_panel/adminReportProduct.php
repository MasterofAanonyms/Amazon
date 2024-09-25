<?php

session_start();
include "connection.php";

if (isset($_SESSION["admin"])) {

    
$rs = Database::search("SELECT products.id,products.price,products.product_status,products.qty,products.description,
products.product_name,products.discount_id,products.adedd_date,products.delevery_fee_colombo,products.delevery_fee_other,
products.category_id,products.model_has_brand_id,products.condition_id,
products.product_status,products.seller_email,model.model AS model,brand.brand AS brand FROM 
`products` INNER JOIN `model_has_brand` ON model_has_brand.id=products.model_has_brand_id INNER JOIN 
`brand` ON brand.id=model_has_brand.brand_id INNER JOIN `model` ON 
model.id=model_has_brand.model_id   ORDER BY
    `products`.`seller_email` ASC");
    $num = $rs->num_rows;

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../bootstrap_files/bootstrap.css">
        <link rel="stylesheet" href="../style.css">
        <link rel="shortcut icon" href="../resourcesofwebsiteimg/icon.svg" type="image/x-icon">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" integrity="sha512-dPXYcDub/aeb08c63jRq/k6GaKccl256JQy/AnOq7CAnEZ9FzSL9wSbcZkMp4R26vBsMLFYH4kQ67/bbV8XaCQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <title>Amazon.lk | Product Report</title>
        <style>
            .anker{
                color: black;
                text-decoration: none;
            }

            .anker:hover{
                color: black;
            }
        </style>
    </head>

    <body>
    <?php include "adminNavBar.php"; ?>
        <div class="container mt-3">
        <a href="adminDashboard.php" class="anker">
            <i class="bi bi-arrow-left"></i> Back to Dashboard
            </a>
        </div>

        <div class="container" id="printArea">
            <h2 class="text-center">Products Report</h2>

            <table class="table table-hover mt-5">
                <thead>
                    <tr>
                        <th>products Id</th>
                        <th>products Name</th>
                        <th>QTY</th>
                        <th>Brand Name</th>
                        <th>Image</th>
                        <th>status</th>
                        <th>seller email</th>
                        <th>Viwe Product</th>
                    </tr>
                </thead>
                <tbody>

                    <?php

                    for ($i = 0; $i < $num; $i++) {
                        $d = $rs->fetch_assoc();

                    ?>
                        <tr>
                            <td><?php echo $d["id"]; ?></td>
                            <td><?php echo $d["product_name"]; ?></td>
                            <td><?php echo $d["qty"]; ?></td>
                            <td><?php echo $d["brand"]; ?></td>
                            <?php
                            $image_rs = Database::search("SELECT * FROM `product_img` WHERE `products_id`='" . $d["id"] . "'");
                            $image_data = $image_rs->fetch_assoc();
                            ?>
                            <td>
                                <?php
                            if($d["seller_email"] == "thehanaruth@gmail.com"){
                                ?>
                                <img src="../<?php echo $image_data["image_path"]; ?>" height="50">
                                <?php
                            }else{
                                ?>
                                <img src="../<?php echo $image_data["image_path"]; ?>" height="50">
                                <?php
                            }
                            ?>
                            </td>
                            <td>
                            <?php
                            if ($d["product_status"] == 1) {
                                    ?>
                                    <button class="btn btn-warning" onclick='p_deactive(<?php echo $d["id"]; ?>);'>Active</button>
                                    <?php
                                } else {
                                    ?>
                                    <button class="btn btn-danger" onclick='p_active(<?php echo $d["id"]; ?>);'>Deactive</button>
                                    <?php
                                }
                                ?>
                                </td>
                                <?php
                                if($d["seller_email"] == "thehanaruth@gmail.com"){
                                    ?>
                                    <td>Our</td>
                                    <?php
                                }else{
                                    ?>
                                <td><?php echo $d["seller_email"]; ?></td>
                                <?php
                                }
                               ?>
                               <td>
                               <?php
                                if($d["seller_email"] == "thehanaruth@gmail.com"){
                                    ?>
                                    <button class="btn btn-dark btn-update offset-1" onclick="sendid(<?php echo $d['id']; ?>);">Update</button>
                                    <?php
                                }else{
                                    ?>
                                    <a href="<?php echo "../sdds.php?id=" . ($d["id"]); ?>" class="btn btn-dark btn-update offset-2" >View</a>
                                <?php
                                }
                               ?>
                               </td>
                        </tr>
                    <?php
                    }

                    ?>

                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end container mt-5 mb-5">
            <button class="btn btn-outline-dark col-2" onclick="printDiv();">Print</button>
        </div>

    </body>
    <script src="script.js"></script>
    <script src="script2.js"></script>
    </html>

<?php
} else {
    echo ("You're not a valid admin");
}

?>