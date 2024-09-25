<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="bootstrap_files/bootstrap.css">
    <style>
        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
        }

        .card-text {
            font-size: 1rem;
        }

        .btn-primary {
            background-color: #ff6f61;
            border-color: #ff6f61;
        }

        .btn-primary:hover {
            background-color: #ff4c39;
            border-color: #ff4c39;
        }

        .discount-tag {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: #ebb70c;
            color: black;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .card {
            position: relative;
        }
    </style>
</head>

<body>
    <?php
    $product_rs = Database::search("SELECT * FROM `products` WHERE `discount_id` = '3' LIMIT 1");
    $product_results = $product_rs->num_rows;
    if ($product_results <= 0) {
    ?>
        <div>
            <h4 class="mt-5">No advertisement  today</h4>
            <img src="resourcesofwebsiteimg/advertice.png" class="img-fluid rounded-top mt-3" alt="" />
        </div>

    <?php
    } else {


        $product_data = $product_rs->fetch_assoc();
        $price = $product_data["price"];
        $adding_price = $price * 1;
        $new_price = $price + $adding_price;
        $difference = $new_price - $price;


    ?>

        <div class="container mt-5">
            <div class="row">
                <div class="col-md-10">
                    <div class="card">
                        <div class="justify-content-center align-items-center d-flex">
                            <span class="discount-tag">50% Off</span>
                            <img src="resources_of_products(img)/iPhone 12_0_6698fb6a48f3b.jpeg" class="card-img-top justify-content-center align-items-center d-flex" style="width: 60%;">
                        </div>

                        <div class="card-body">
                            <h5 class="card-title"><?php echo $product_data["product_name"] ?></h5>
                            <p class="card-text"><?php echo $product_data["description"] ?></p>
                            <div class="row mt-4 align-items-center">
                                <h3 class="col-12 text-warning fw-bold">Rs.<?php echo $product_data["price"]; ?>.00 </h3>
                                <p class="col-12"><span class="text-decoration-line-through text-danger">Rs.<?php echo $new_price; ?>.00</span> | -50%</p>
                            </div>

                            <a href="<?php echo "sdds.php?id=" . ($product_data["id"]); ?>" class="btn btn-warning col-12">Buy Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>