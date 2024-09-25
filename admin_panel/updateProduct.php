<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Update Product | Amazone</title>
    <link rel="stylesheet" href="../bootstrap_files/bootstrap.css" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="../resourcesofwebsiteimg/icon.svg" type="image/x-icon">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" integrity="sha384-4LISF5TTJX/fLmGSxO53rV4miRxdg84mZsxmO8Rx5jGtp/LbrixFETvWa5a6sESd" crossorigin="anonymous">
    <link rel="stylesheet" href="../update_pro.css" />

    <link rel="icon" href="../resource/logo.svg" />



</head>

<body>
    <?php
    session_start();
    if (isset($_SESSION["admin"])) {
        if (isset($_SESSION["p"])) {
            include "connection.php";
            $product = $_SESSION["p"];
    ?>
            <div class="container mt-2 adjestment">
                <h1 class="text-center"><?php echo $product["product_name"]; ?></h1><br>

                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <div class="mb-3 mb-md-0">
                        <label class="btn btn-link text-dark d_none">
                            <i class="bi bi-box-seam"></i> Update Product
                        </label>
                    </div>
                    <div class="adjestment">
                        <a class="btn btn-success2 d_none">
                            <i class="bi bi-check-circle"></i> Update Product
                        </a>
                    </div>
                </div>
                <div class="row rounded bg-darkX">

                    <div class="col-12 col-md-6 mt-3">
                        <form>

                            <div class="form-group ">
                                <label for="productFirstName">Product Name</label>
                                <input type="text" class="form-control" value="<?php echo $product["product_name"]; ?>" id="name" placeholder="Product name">
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="productPrice">Product Per Price</label>

                                    <input type="text" class="form-control" disabled value="<?php echo $product["price"]; ?>.00" id="price" placeholder="Enter product price">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="productPrice">Product Quantity</label>
                                    <input type="number" class="form-control" value="<?php echo $product["qty"]; ?>" id="qty" placeholder="Enter product quantity">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="productPrice">Delivery cost Within Colombo</label>
                                <input type="text" class="form-control" id="dwc" value="<?php echo $product["delevery_fee_colombo"]; ?>" placeholder="Delevery Price for Colombo Customers">
                            </div>
                            <div class="form-group">
                                <label for="productPrice">Delivery cost out of Colombo</label>
                                <input type="text" class="form-control" id="doc" value="<?php echo $product["delevery_fee_other"]; ?>" placeholder="Delevery Price for out of Colombo Customers">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="productCategory">Product Category</label>
                                    <select class="form-select " disabled>
                                        <?php
                                        $category_rs = Database::search("SELECT * FROM `category` WHERE `id`='" . $product["category_id"] . "'");
                                        $category_data = $category_rs->fetch_assoc();
                                        ?>
                                        <option><?php echo $category_data["category"]; ?></option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="productCategory">Product Brand</label>
                                    <select class="form-select" disabled>
                                        <?php
                                        $brand_rs = Database::search("SELECT * FROM `brand` WHERE `id` IN 
                                                    (SELECT `brand_id` FROM `model_has_brand` WHERE `id`='" . $product["model_has_brand_id"] . "')");
                                        $brand_data = $brand_rs->fetch_assoc();
                                        ?>
                                        <option><?php echo $brand_data["brand"]; ?></option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="productCategory">Product Model</label>
                                    <select class="form-select" disabled>
                                        <?php
                                        $model_rs = Database::search("SELECT * FROM `model` WHERE `id` IN 
                                                    (SELECT `model_id` FROM `model_has_brand` WHERE `id`='" . $product["model_has_brand_id"] . "')");
                                        $model_data = $model_rs->fetch_assoc();
                                        ?>
                                        <option><?php echo $model_data["model"]; ?></option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="productCategory">Product Color</label>
                                    <select class="form-select" disabled>
                                        <?php
                                        $color_id = Database::search("SELECT * FROM `color_has_products` WHERE `products_id`='" . $product["id"] . "'");
                                        $color_id_data = $color_id->fetch_assoc();

                                        $color_rs =  Database::search("SELECT `color` FROM `color` WHERE `id`='" . $color_id_data["color_id"] . "'");
                                        $color_data = $color_rs->fetch_assoc();

                                        ?>
                                        <option><?php echo $color_data["color"]; ?></option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="productCategory">Discount Category</label>
                                    <select class="form-select" disabled>
                                        <?php
                                        $discount_rs = Database::search("SELECT * FROM `discount`WHERE `id`='" . $product["discount_id"] . "'");
                                        $discount_data = $discount_rs->fetch_assoc();
                                        ?>
                                        <option><?php echo $discount_data["discount"]; ?></option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="productCategory">Product Condition</label>
                                    <select class="form-select" disabled>
                                        <?php
                                        $condition_rs = Database::search("SELECT * FROM `condition`WHERE `id`='" . $product["condition_id"] . "'");
                                        $condition_data = $condition_rs->fetch_assoc();
                                        ?>
                                        <option><?php echo $condition_data["condition"]; ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="productDescription">Product Description</label>
                                <textarea class="form-control" id="desc" rows="3" placeholder="Enter product description"><?php echo $product["description"]; ?></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <div class="col-12">
                            <?php

                            $img = array();

                            $img[0] = "resourcesofwebsiteimg/empty_folder.jpeg";
                            $img[1] = "resourcesofwebsiteimg/empty_folder.jpeg";
                            $img[2] = "resourcesofwebsiteimg/empty_folder.jpeg";

                            $product_img_rs = Database::search("SELECT * FROM `product_img` WHERE `products_id`='" . $product["id"] . "'");
                            $product_img_num = $product_img_rs->num_rows;

                            for ($x = 0; $x < $product_img_num; $x++) {
                                $product_img_data = $product_img_rs->fetch_assoc();

                                $img[$x] = $product_img_data["image_path"];
                            }

                            ?>
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label fw-bold" style="font-size: 20px;">Add Product Images</label>
                                </div>
                                <div class="image-preview-container">
                                    <div class="image-preview" id="imagePreview1">
                                        <img src="../<?php echo $img[0]; ?>" id="i0" alt="">
                                    </div>
                                    <div class="image-preview" id="imagePreview2">
                                        <img src="../<?php echo $img[1]; ?>" id="i1" alt="">
                                    </div>
                                    <div class="image-preview" id="imagePreview3">
                                        <img src="../<?php echo $img[2]; ?>" id="i2" alt="">
                                    </div>

                                </div>
                                <div class="offset-lg-3 col-12 col-lg-6 d-grid mt-3">
                                    <input type="file" class="d-none" multiple id="imageuploader" />
                                    <label for="imageuploader" class="col-12 btn btn-dark" onclick="changeProductImage();"><i class="bi bi-upload"></i> Upload Images</label>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center align-items-center w-100 mb-3 mt-3">
                            <a class="btn btn-success2" onclick="updateProduct();"><i class="bi bi-check-circle"></i> Update Product</a>

                        </div>

                    </div>
                </div>
            </div>
            <script src="script.js"></script>

            <script>
                function previewImages(event, previewId) {
                    const input = event.target;
                    const previewContainer = document.getElementById(previewId);
                    previewContainer.innerHTML = ''; // Clear previous images

                    const files = input.files;
                    for (let i = 0; i < files.length; i++) {
                        const file = files[i];
                        const reader = new FileReader();

                        reader.onload = function(e) {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.classList.add('img-thumbnail');
                            previewContainer.appendChild(img);
                        }

                        reader.readAsDataURL(file);
                    }
                }
            </script>
        <?php
        } else {
        ?>
            <script>
                alert("Please select a product to update.");
                window.location = "manage_pro.php";
            </script>
        <?php
        }
    } else {
        ?>
        <script>
            alert("You have to signin to the system for access this function.");
            window.location = "seller_login.php";
        </script>
    <?php
    }
    ?>
    </div>
    </div>
    <script src="script2.js"></script>
    <script src="script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>