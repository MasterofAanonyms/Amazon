<?php

include "../connection.php";
session_start();
$user = $_SESSION["user"];

if (isset($_POST["payment"])) {

    $payment = json_decode($_POST["payment"], true);

    $cart_rs = Database::search("SELECT * FROM `cart` WHERE `users_email`='".$user["email"]."'");
    $cart_data = $cart_rs->fetch_assoc();

    $product_rs = Database::search("SELECT * FROM `products` WHERE `id`='".$cart_data["products_id"]."'");
    $product_data = $product_rs->fetch_assoc();

    $order_id = $payment["order_id"];
    $pid = $cart_data["products_id"];
    $mail = $payment["email"];
    $amount = $payment["amount"];

    $date = new DateTime();
    $date->setTimezone(new DateTimeZone("Asia/Colombo"));
    $time = $date->format("Y-m-d");

    Database::iud("INSERT INTO `invoice`(`order_id`,`date`,`total`,`status`,`users_email`,`type`,`items`) 
    VALUES('" . $payment["order_id"] . "','" . $time . "','" . $payment["amount"] . "','0','" . $mail . "','2' ,'" . $payment["items"] . "')");

    $orderHistoryId = Database::$connection->insert_id;

    $rs = Database::search("SELECT * FROM `cart` WHERE `users_email`='".$user["email"]."'");
    $num = $rs->num_rows;
        //Order Items Insert
        $d = $rs->fetch_assoc();

        $rs2 = Database::search("SELECT * FROM `products` WHERE `id`='" . $d["products_id"] . "'");
        $d2 = $rs2->fetch_assoc();

        $newQty = $d2["qty"] - $d["qty"];
        Database::iud("UPDATE `products` SET `qty`='" . $newQty . "' WHERE `id`='" . $d["products_id"] . "'");

    Database::iud("DELETE FROM `cart` WHERE `users_email`='" . $user["email"] . "'");
    // echo ("Success");

    $order = array();
    $order["response"] = "Success";
    $order["order_id"] = $orderHistoryId;
    
    echo json_encode($order);
}
