<?php

session_start();
include "connection.php";

if (isset($_SESSION["admin"])) {

?>

    <!DOCTYPE html>
    <html lang="en" data-bs-theme="dark">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Amazone.lk | Management</title>
    <link rel="stylesheet" href="../bootstrap_files/bootstrap.css" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="../resourcesofwebsiteimg/icon.svg" type="image/x-icon">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" integrity="sha384-4LISF5TTJX/fLmGSxO53rV4miRxdg84mZsxmO8Rx5jGtp/LbrixFETvWa5a6sESd" crossorigin="anonymous">
    <link rel="stylesheet" href="../update_pro.css" />

    <link rel="icon" href="../resource/logo.svg" />

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

    <body class="adminBody">
        <!-- nav Bar -->
        <?php include "adminNavBar.php"; ?>
        <!-- nav Bar -->
        <div class="container mt-3">
            <a href="adminDashboard.php" class="anker">
            <i class="bi bi-arrow-left"></i> Back to report
            </a>
        </div>

        <div class="col-10">
            <h2 class="text-center offset-1">Product Management</h2>

            <div class="container  mt-2 border offset-1">
                
                <div class="row justify-content-center mt-3">
                <div class="col-md-3 mb-3">
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
                    <div class="col-md-3 mb-3">
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
                    <div class="col-md-3 mb-3">
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
                    <div class="col-md-3 mb-3">
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


        <script src="script.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>

<?php

} else {
    echo ("You are not a Valid Admin");
}


?>