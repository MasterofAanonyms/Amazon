<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amazon.lk | Invoice</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" integrity="sha384-4LISF5TTJX/fLmGSxO53rV4miRxdg84mZsxmO8Rx5jGtp/LbrixFETvWa5a6sESd" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style files/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        .invoice-container {
            max-width: 800px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border: 1px solid #ddd;
        }

        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .invoice-header h1 {
            font-size: 2rem;
            margin: 0;
        }

        .invoice-details {
            margin-bottom: 20px;
        }

        .invoice-details .row {
            margin-bottom: 10px;
        }

        .invoice-table {
            width: 100%;
        }

        .invoice-table th,
        .invoice-table td {
            padding: 10px;
        }

        .invoice-footer {
            margin-top: 20px;
        }

        .invoice-footer .note {
            font-style: italic;
        }
    </style>
</head>

<body style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
    <div>
        <a href="order.php">Order</a> / Invoice
    </div>
    <hr>
    <div class="invoice-container" id="page">
        <div class="invoice-header">
            <div class="row">
                <?php

                session_start();
                include "connection.php";


                if (isset($_SESSION["user"])) {

                    $umail = $_SESSION["user"]["email"];
                    $oid = $_GET["id"];

                    $address_rs = Database::search("SELECT * FROM `users_has_address` WHERE `users_email`='" . $umail . "'");
                    $address_data = $address_rs->fetch_assoc();

                    $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `order_id`='" . $oid . "' AND `type`='1'");
                    $invoice_num = $invoice_rs->num_rows;

                    if ($invoice_num > 0) {
                        $invoice_data = $invoice_rs->fetch_assoc();

                ?>
                        <div class="col-12 justify-content-center align-items-center d-flex">
                            <h1 class="text-warning"> <b>AMAZONEX</b> </h1>
                        </div>
                        <div class="">
                            <h1 style="margin-left: 13px;"> <b>INVOICE</b> </h1>
                        </div>
                        <div class="col text-right">
                            <p>Invoice No. <?php echo $invoice_data["id"]; ?></p>
                        </div>
            </div>
        </div>
        <div class="invoice-details">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Billed to:</strong>
                    <p><?php echo $_SESSION["user"]["user_name"] ?> <br>
                        <?php echo $address_data["line1"] . "," . $address_data["line1"] ?><br>
                        <?php $umail; ?></p>
                </div>
                <div class="col-md-6 ">
                    <div class="">
                        <p><strong>From:</strong></p>
                    </div>
                    <div class="">
                        <p>Amazonex <br>
                            1/A/11,School lane, Bokundara, Piliyandala <br>
                            amazon@gmail.com <br></p>
                    </div>
                </div>
            </div>
        </div>
        <table class="invoice-table table-bordered " style="border: none;">
            <thead class="head_back" style="border: none;">
                <tr>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Price <a class="text-decoration-none" style="font-size: 16px; color: #333;">(per 1 item)</a> </th>

                    <th>Amount</th>

                </tr>

            </thead>
            <hr>
            <tbody>
                <?php
                        $product_rs = Database::search("SELECT * FROM `products` WHERE `id`='" . $invoice_data["products_id"] . "'");
                        $product_data = $product_rs->fetch_assoc();
                ?>
                <tr>
                    <td><?php echo $product_data["product_name"]; ?></td>
                    <td><?php echo $invoice_data["qty"]; ?></td>
                    <td>Rs. <?php echo $product_data["price"]; ?>.00</td>
                    <td>Rs. <?php echo $invoice_data["total"]; ?>.00</td>
                </tr>
                <tr class="text-end">
                    <td colspan="3" class="text-right"><strong>Total :</strong></td>
                    <td><strong>Rs. <?php echo $invoice_data["total"]; ?>.00</strong></td>
                </tr>
            </tbody>

        </table>
        <div class="invoice-footer">
            <p><strong>Payment method:</strong> Online Transfer</p>
            <p class="note">Thank you for choosing our service!</p>
            <p class="offset-10" style="margin-top: -38px;"><strong>Date:</strong> <?php echo $invoice_data["date"]; ?> <br> amazon.lk</p>
        </div>
    </div>
<?php
                    }
                    $invoice_rs2 = Database::search("SELECT * FROM `invoice` WHERE `order_id`='" . $oid . "' AND `type`='2'");
                    $invoice_num2 = $invoice_rs2->num_rows;
                    if ($invoice_num2 > 0) {
                        $invoice_data2 = $invoice_rs2->fetch_assoc();
?>

    <div class="invoice-container" id="page">
        <div class="invoice-header">
            <div class="row">
                <div class="col-12 justify-content-center align-items-center d-flex">
                    <h1 class="text-warning"> <b>AMAZONEX</b> </h1>
                </div>
                <div class="">
                    <h1 style="margin-left: 13px;"> <b>INVOICE</b> </h1>
                </div>
                <div class="col text-right">
                    <p>Invoice No. <?php echo $invoice_data2["id"]; ?></p>
                </div>
            </div>
        </div>
        <div class="invoice-details">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Billed to:</strong>
                    <p><?php echo $_SESSION["user"]["user_name"] ?> <br>
                        <?php echo $address_data["line1"] . "," . $address_data["line1"] ?><br>
                        <?php $umail; ?></p>
                </div>
                <div class="col-md-6 ">
                    <div class="">
                        <p><strong>From:</strong></p>
                    </div>
                    <div class="">
                        <p>Amazonex <br>
                            1/A/11,School lane, Bokundara, Piliyandala <br>
                            amazon@gmail.com <br></p>
                    </div>
                </div>
            </div>
        </div>
        <table class="invoice-table table-bordered " style="border: none;">
            <thead class="head_back" style="border: none;">
                <tr>
                    <th>Item</th>
                    <th>Quantity</th>

                </tr>

            </thead>
            <hr>
            <tbody>
                <tr>
                    <td><?php echo $invoice_data2["items"]; ?></td>
                    <td><?php echo $invoice_data2["qty"]; ?></td>
                </tr>
                <tr class="text-end">
                    <td colspan="3" class="text-right"><strong>Total :</strong></td>
                    <td><strong>Rs. <?php echo $invoice_data2["total"]; ?>.00</strong></td>
                </tr>
            </tbody>

        </table>
        <div class="invoice-footer">
            <p><strong>Payment method:</strong> Online Transfer</p>
            <p class="note">Thank you for choosing our service!</p>
            <p class="offset-9" style="margin-top: -38px;"><strong>Date:</strong> <?php echo $invoice_data2["date"]; ?> <br> amazon.lk</p>
        </div>
    </div>
<?php
                    }
                } else {
?>
<script>
    window.location.href = "login.php";
</script>
<?php
                }
?>
<div class="offset-5">
    <button class="btn btn-outline-dark mt-4 "  onclick="printInvoice();"><i class="bi bi-printer-fill"></i> Print Invoice</button>
</div>

<script src="script.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>