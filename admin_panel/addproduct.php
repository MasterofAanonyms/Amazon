<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Update Product | Amazone.lk</title>
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
            include "connection.php";
    ?>
    <?php include "adminNavBar.php"; ?>
<div class="mt-3">
    <br>
    <hr>
</div>
<div class="container">

    <div class="d-flex justify-content-between align-items-center flex-wrap">
        <div class="mb-3 mb-md-0">
            <label class="btn btn-link text-dark d_none">
                <i class="bi bi-box-seam"></i> Add New Product
            </label>
        </div>
        <div class="adjestment">
            <a class="btn btn-success2 d_none">
                <i class="bi bi-check-circle"></i> Add Product
            </a>
        </div>
    </div>
    <div class="row rounded bg-darkX">

        <div class="col-12 col-md-6 mt-3">
            <form>

                <div class="form-group ">
                    <label for="productFirstName">Product Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Product name">
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="productPrice">Product Per Price</label>

                        <input type="text" class="form-control" id="price" placeholder="Enter product price">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="productPrice">Product Quantity</label>
                        <input type="number" class="form-control" id="qty" placeholder="Enter product quantity">
                    </div>
                </div>
                <div class="form-group">
                    <label for="productPrice">Delivery cost Within Colombo</label>
                    <input type="text" class="form-control" id="dwc" placeholder="Delevery Price for Colombo Customers">
                </div>
                <div class="form-group">
                    <label for="productPrice">Delivery cost out of Colombo</label>
                    <input type="text" class="form-control" id="doc" placeholder="Delevery Price for out of Colombo Customers">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="productCategory">Product Category</label>
                        <select class="form-control" id="category">
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
                    <div class="form-group col-md-4">
                        <label for="productCategory">Product Brand</label>
                        <select class="form-control" id="brand">
                            <option value="0">Select Brand</option>
                            <?php
                            $brand_rs = Database::search("SELECT * FROM `Brand`");
                            $brand_num = $brand_rs->num_rows;

                            for ($x = 0; $x < $brand_num; $x++) {
                                $brand_data = $brand_rs->fetch_assoc();
                            ?>
                                <option value="<?php echo $brand_data["id"]; ?>">
                                    <?php echo $brand_data["brand"]; ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="productCategory">Product Model</label>
                        <select class="form-control" id="model">
                            <option value="0">Select model</option>
                            <?php
                            $model_rs = Database::search("SELECT * FROM `model`");
                            $model_num = $model_rs->num_rows;

                            for ($x = 0; $x < $model_num; $x++) {
                                $model_data = $model_rs->fetch_assoc();
                            ?>
                                <option value="<?php echo $model_data["id"]; ?>">
                                    <?php echo $model_data["model"]; ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="productCategory">Product Color</label>
                        <select class="form-control" id="color">
                            <option value="0">Select Color</option>
                            <?php
                            $color_rs = Database::search("SELECT * FROM `color`");
                            $color_num = $color_rs->num_rows;

                            for ($x = 0; $x < $color_num; $x++) {
                                $color_data = $color_rs->fetch_assoc();
                            ?>
                                <option value="<?php echo $color_data["id"]; ?>">
                                    <?php echo $color_data["color"]; ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="productCategory">Discount Category</label>
                        <select class="form-control" id="discount">
                            <option value="0">Select Discount</option>
                            <?php
                            $discount_rs = Database::search("SELECT * FROM `discount`");
                            $discount_num = $discount_rs->num_rows;

                            for ($x = 0; $x < $discount_num; $x++) {
                                $discount_data = $discount_rs->fetch_assoc();
                            ?>
                                <option value="<?php echo $discount_data["id"]; ?>">
                                    <?php echo $discount_data["discount"]; ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="productCategory">Product Condition</label>
                        <select class="form-control" id="condition">
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
                    <div class="form-group col-md-6">
                        <label for="productCategory">Product Placement</label>
                        <select class="form-control" id="place">
                            <option value="0">Select Place</option>
                            <?php
                            $place_rs = Database::search("SELECT * FROM `product_status`");
                            $place_num = $place_rs->num_rows;

                            for ($x = 0; $x < $place_num; $x++) {
                                $place_data = $place_rs->fetch_assoc();
                            ?>
                                <option value="<?php echo $place_data["id"]; ?>">
                                    <?php echo $place_data["status"]; ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="productDescription">Product Description</label>
                    <textarea class="form-control" id="desc" rows="3" placeholder="Enter product description"></textarea>
                </div>
            </form>
        </div>
        <div class="col-md-6">
            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <label class="form-label fw-bold" style="font-size: 20px;">Add Product Images</label>
                    </div>
                    <div class="image-preview-container">
                        <div class="image-preview" id="imagePreview1">
                            <img src="../resourcesofwebsiteimg/empty_folder.jpeg" id="i0" alt="">
                        </div>
                        <div class="image-preview" id="imagePreview2">
                            <img src="../resourcesofwebsiteimg/empty_folder.jpeg" id="i1" alt="">
                        </div>
                        <div class="image-preview" id="imagePreview3">
                            <img src="../resourcesofwebsiteimg/empty_folder.jpeg" id="i2" alt="">
                        </div>

                    </div>
                    <div class="offset-lg-3 col-12 col-lg-6 d-grid mt-3">
                        <input type="file" class="d-none" multiple id="imageuploader" />
                        <label for="imageuploader" class="col-12 btn btn-dark" onclick="changeProductImage();"><i class="bi bi-upload"></i> Upload Images</label>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center align-items-center w-100 mb-3 mt-3">
                <a class="btn btn-success2" onclick="addProduct();"><i class="bi bi-check-circle"></i> Add Product</a>

            </div>
            <div class="container mt-3 border">
                <h5 class="text-danger mt-3 mb-4 justify-content-center align-items-center d-flex">If You Want add Category or Brand or Model or Discount or Color</h5>
                <div class="row justify-content-center">
                <div class="col-md-6 mb-3">
                        <div class="form-container">
                            <div class="logo-container">
                                Add Brand 
                            </div>

                            <form class="form">
                                <div class="form-group">
                                    <label for="braand">Brand name</label>
                                    <input type="text" id="Bname" placeholder="Enter your brand name" required="">
                                </div>
                                <div class="form-group ">
                        <label for="productCategory">Product Category</label>
                        <select class="form-control" id="category2">
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
                                <button class="form-submit-btn" type="submit" onclick="addbrand();">Add Brand</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-container">
                            <div class="logo-container">
                                Add Model 
                            </div>

                            <form class="form">
                                <div class="form-group">
                                    <label for="model">Model name</label>
                                    <input type="text" id="Mname" name="email" placeholder="Enter your model name" required="">
                                </div>
                                <div class="form-group ">
                        <label for="productCategory">Product Brand</label>
                        <select class="form-control" id="bradn2">
                            <option value="0">Select Brand</option>
                            <?php
                            $brand_rs = Database::search("SELECT * FROM `brand`");
                            $brand_num = $brand_rs->num_rows;

                            for ($x = 0; $x < $brand_num; $x++) {
                                $brand_data = $brand_rs->fetch_assoc();
                            ?>
                                <option value="<?php echo $brand_data["id"]; ?>">
                                    <?php echo $brand_data["brand"]; ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>

                                <button class="form-submit-btn" type="submit" onclick="addmodel();">Add Model</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-container">
                            <div class="logo-container">
                                Add Discount 
                            </div>

                            <form class="form">
                                <div class="form-group">
                                    <label for="discount">Discount</label>
                                    <input type="text" id="Dname" name="email" placeholder="Enter your discount category" required="">
                                </div>
                                

                                <button class="form-submit-btn" type="submit" onclick="adddiscount();">Add discount</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-container">
                            <div class="logo-container">
                                Add Color 
                            </div>

                            <form class="form">
                                <div class="form-group">
                                    <label for="color">color</label>
                                    <input type="text" id="Cname" placeholder="Enter your color name" required="">
                                </div>

                                <button class="form-submit-btn" type="submit" onclick="addcolor();">Add Color</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>



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
            alert("You have to signin to the system for access this function.");
            window.location = "../admin_signin.php";
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
</script>
</body>
</html>
