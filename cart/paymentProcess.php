<?php

include "../connection.php";
session_start();
$user = $_SESSION["user"];

$stockList = array();
$qtyList = array();

if (isset($_POST["cart"]) && $_POST["cart"] == "true") {
    //From Cart

    $rs = Database::search("SELECT * FROM `cart` WHERE `users_email`='" . $user["email"] . "'");
    $num = $rs->num_rows;



    for ($i = 0; $i < $num; $i++) {
        $d = $rs->fetch_assoc();

        $stockList[] = $d["products_id"];
        $qtyList[] = $d["qty"];
    }
} else {
    //From Buy Now

    $stockList[] = $_POST["stockId"];
    $qtyList[] = $_POST["qty"];
}


$merchantId = "1225180";
$merchantSecret = "MTgwNzQxNzMzODE0Mjc1Nzc4NjMxODI2NTI3OTQxMjQ2MTc2NTI5";
$items = "";
$netTotal = 0;
$currency = "LKR";
$orderId = uniqid();

for ($i = 0; $i < sizeof($stockList); $i++) {

    $rs2 = Database::search("SELECT * FROM `products` WHERE `id`='" . $stockList[$i] . "'");

    $d2 = $rs2->fetch_assoc();
    $stockQty = $d2["qty"];

    if ($stockQty >= $qtyList[$i]) {
        //Stock Available
        $items .= $d2["product_name"];

        if ($i != sizeof($stockList) - 1) {
            $items .= ", ";
        }

        $netTotal += (intval($d2["price"]) * intval($qtyList[$i]));
    } else {
        echo ("Product has no available stock.");
    }
}
$address_rs = Database::search("SELECT `district_id` AS district_id FROM `users_has_address` INNER JOIN `city` ON 
                            users_has_address.city_id=city.id INNER JOIN `district` ON 
                            city.district_id=district.id WHERE `users_email`='" . $user["email"] . "'");


$address_data = $address_rs->fetch_assoc();
if ($address_data["district_id"] == 10) {
    $ship = $d2["delevery_fee_colombo"];
    $shipping =  $ship;
} else {
    $ship = $d2["delevery_fee_other"];
    $shipping = $ship;
}
$netTotal += $shipping;



$hash = strtoupper(
    md5(
        $merchantId .
            $orderId .
            number_format($netTotal, 2, '.', '') .
            $currency .
            strtoupper(md5($merchantSecret))
    )
);

$payment = array();
$payment["sandbox"] = true;
$payment["merchant_id"] = $merchantId;
$payment["first_name"] = $user["user_name"];
$payment["last_name"] = "";
$payment["email"] = $user["email"];
$payment["phone"] = $user["phone_no"];
$payment["address"] = "";
$payment["city"] = "";
$payment["country"] = "Sri Lanka";
$payment["order_id"] = $orderId;
$payment["items"] = $items;
$payment["currency"] = $currency;
$payment["amount"] = number_format($netTotal, 2, '.', '');
$payment["hash"] = $hash;
$payment["return_url"] = "";
$payment["cancel_url"] = "";
$payment["notify_url"] = "";

echo json_encode($payment);
