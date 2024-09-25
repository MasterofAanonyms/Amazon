<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <title>Amazon.lk | Order History</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" integrity="sha384-4LISF5TTJX/fLmGSxO53rV4miRxdg84mZsxmO8Rx5jGtp/LbrixFETvWa5a6sESd" crossorigin="anonymous">

    <link rel="stylesheet" href="style files/style.css">
    <link rel="stylesheet" href="bootstrap_files/bootstrap.css">
    <style>
        .hh-grayBox {
            background-color: #F8F8F8;
            margin-bottom: 20px;
            padding: 35px;
            margin-top: 20px;
        }

        .pt45 {
            padding-top: 45px;
        }

        .order-tracking {
            text-align: center;
            width: 33.33%;
            position: relative;
            display: block;
        }

        .order-tracking .is-complete {
            display: block;
            position: relative;
            border-radius: 50%;
            height: 30px;
            width: 30px;
            border: 0px solid #AFAFAF;
            background-color: #f7be16;
            margin: 0 auto;
            transition: background 0.25s linear;
            -webkit-transition: background 0.25s linear;
            z-index: 2;
        }

        .order-tracking .is-complete:after {
            display: block;
            position: absolute;
            content: '';
            height: 14px;
            width: 7px;
            top: -2px;
            bottom: 0;
            left: 5px;
            margin: auto 0;
            border: 0px solid #AFAFAF;
            border-width: 0px 2px 2px 0;
            transform: rotate(45deg);
            opacity: 0;
        }

        .order-tracking.completed .is-complete {
            border-color: #27aa80;
            border-width: 0px;
            background-color: #27aa80;
        }

        .order-tracking.completed .is-complete:after {
            border-color: #fff;
            border-width: 0px 3px 3px 0;
            width: 7px;
            left: 11px;
            opacity: 1;
        }

        .order-tracking p {
            color: #A4A4A4;
            font-size: 16px;
            margin-top: 8px;
            margin-bottom: 0;
            line-height: 20px;
        }

        .order-tracking p span {
            font-size: 14px;
        }

        .order-tracking.completed p {
            color: #000;
        }

        .order-tracking::before {
            content: '';
            display: block;
            height: 3px;
            width: calc(100% - 40px);
            background-color: #f7be16;
            top: 13px;
            position: absolute;
            left: calc(-50% + 20px);
            z-index: 0;
        }

        .order-tracking:first-child:before {
            display: none;
        }

        .order-tracking.completed:before {
            background-color: #27aa80;
        }

        .star-rating {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .star-rating .fa-star {
            font-size: 24px;
            color: #ddd;
            cursor: pointer;
            transition: color 0.2s;
        }

        .star-rating .fa-star.checked {
            color: #f39c12;
        }

        .fa-star.checked {
            color: gold;
        }

        .testimonial.card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: none;
        }

        .testimonial.card .card-body {
            padding: 1.5rem;
        }
    </style>

</head>

<body>

    <?php include "connection.php"; ?>


    <?php
    session_start();

    if (isset($_SESSION["user"])) {
        $user_id = $_SESSION["user"]["email"];


    ?>
<div class="col-12 mt-4 bg-light">
                                    <a href="index.php">Home</a>/ Order
                                </div>
        <section>
            <div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
                <div class="container text-center">
                    <h1 class="display-4  animated slideInDown mb-4">Your Orders</h1>
                </div>
            </div>
        </section>

        <?php
        $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `users_email`='" . $user_id . "' AND `type`='1'");
        $invoice_num = $invoice_rs->num_rows;
        $invoice_rs2 = Database::search("SELECT * FROM `invoice` WHERE `users_email`='" . $user_id . "' AND `type`='2'");
        $invoice_num2 = $invoice_rs2->num_rows;

        if ($invoice_num > 0) {
        ?>
            <section>
                <div class="container my-5">
                    <div class="row m-0 col-12 my-3 bg-light p-lg-5 p-3 rounded-3">
                        <?php

                        for ($x = 0; $x < $invoice_num; $x++) {
                            $invoice_data = $invoice_rs->fetch_assoc();

                            $product_rs = Database::search("SELECT * FROM `products` WHERE `id`='" . $invoice_data["products_id"] . "'");
                            $product_data = $product_rs->fetch_assoc();

                            $img_rs = Database::search("SELECT * FROM `product_img` WHERE `products_id`='" . $product_data["id"] . "'");
                            $img_data = $img_rs->fetch_assoc();

                        ?>
                            <div class="card mb-3">
                                <div class="row g-0">
                                    <h3 class="text-start mt-3">Order Id: <?php echo $invoice_data["order_id"]; ?></h3>
                                    <div class="col-md-4">
                                        <img src="<?php echo $img_data["image_path"]; ?>" class="img rounded-start" style="width: 40%;">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $product_data["product_name"]; ?></h5>
                                            <p class="card-text">Price: Rs.<?php echo $invoice_data["total"]; ?>.00</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="btn-group" role="group">
                                                    <p class="card-text">QTY: <?php echo $invoice_data["qty"]; ?></p>

                                                </div>
                                                <?php
                                                if ($invoice_data["status"] == 3) {
                                                ?>

                                                    <button class=" btn btn-success text-white p-2 rounded-2">Delivered</button>
                                                    <button class=" btn btn-dark text-white p-2 rounded-2" onclick="addFeedback(<?php echo $invoice_data['products_id']; ?>);">Add your Feedback </button>
                                                <?php
                                                } else {
                                                ?>
                                                    <div class=" bg-dark text-white p-2 rounded-2">In Progress</div>
                                                <?php
                                                }
                                                ?>

                                            </div>
                                            <button class=" btn btn-warning" onclick="viewInvoice('<?php echo $invoice_data['order_id'] ?>');">View Invoice</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </section>
        <?php

        }  if ($invoice_num2 > 0) {


        ?>
            <section>
                <h1 class="text-center">Cart Payments</h1>
                <div class="container my-5">
                    <div class="row m-0 col-12 my-3 bg-light p-lg-5 p-3 rounded-3">
                        <?php
                        for ($x = 0; $x < $invoice_num2; $x++) {
                            $invoice_data2 = $invoice_rs2->fetch_assoc();

                        ?>
                            <div class="card mb-3">
                                <div class="row g-0">
                                    <h3 class="text-start mt-3">Order Id: <?php echo $invoice_data2["order_id"]; ?>(Cart)</h3>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $invoice_data2["items"]; ?></h5>
                                            <p class="card-text">Price: Rs.<?php echo $invoice_data2["total"]; ?>.00</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="btn-group" role="group">
                                                    <p class="card-text">QTY: <?php echo $invoice_data2["qty"]; ?></p>

                                                </div>
                                                <?php
                                                if ($invoice_data2["status"] == 3) {
                                                ?>

                                                    <button class=" btn btn-success text-white p-2 rounded-2">Delivered</button>
                                                    <button class=" btn btn-dark text-white p-2 rounded-2" onclick="addFeedback(<?php echo $invoice_data['products_id']; ?>);">Add your Feedback </button>
                                                <?php
                                                } else {
                                                ?>
                                                    <div class=" bg-dark text-white p-2 rounded-2">In Progress</div>
                                                <?php
                                                }
                                                ?>

                                            </div>
                                            <button class=" btn btn-warning" onclick="viewInvoice('<?php echo $invoice_data2['order_id'] ?>');">View Invoice</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </section>
        <?php
        }


        ?>





        <!-- model -->
        <div class="modal" tabindex="-1" id="feedbackmodal<?php echo $invoice_data['products_id']; ?>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">Add New Feedback</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-3">
                                            <label class="form-label fw-bold">Type</label>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="type" id="type1" />
                                                <label class="form-check-label text-success fw-bold" for="type1">
                                                    Positive
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="type" id="type2" checked />
                                                <label class="form-check-label text-warning fw-bold" for="type2">
                                                    Neutral
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="type" id="type3" />
                                                <label class="form-check-label text-danger fw-bold" for="type3">
                                                    Negative
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-3">
                                            <label class="form-label fw-bold">User's Email</label>
                                        </div>
                                        <div class="col-9">
                                            <input type="text" class="form-control" disabled id="mail" value="<?php echo $user_id; ?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-2">
                                    <div class="row">
                                        <div class="col-3">
                                            <label class="form-label fw-bold">Feedback</label>
                                        </div>
                                        <div class="col-9">
                                            <textarea class="form-control" cols="50" rows="8" id="feed"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-outline-warning" onclick="saveFeedback(<?php echo $invoice_data['products_id']; ?>);">Save Feedback</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- model -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="script.js"></script>
    <?php
    } else {
    ?>
        <script>
            window.location = "login.php";
        </script>
    <?php
    }
    ?>
</body>

</html>