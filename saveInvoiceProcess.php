<?php

session_start();
include "connection.php";

if (isset($_SESSION["user"])) {

    $order_id = $_POST["o"];
    $pid = $_POST["i"];
    $mail = $_POST["m"];
    $amount = $_POST["a"];
    $qty = $_POST["q"];

    $product_rs = Database::search("SELECT * FROM `products` WHERE `id`='" . $pid . "'");
    $product_data = $product_rs->fetch_assoc();

    $seller = $product_data["seller_email"];

    $current_qty = $product_data["qty"];
    $new_qty = $current_qty - $qty;

    Database::iud("UPDATE `products` SET `qty`='" . $new_qty . "' WHERE `id`='" . $pid . "'");

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    Database::iud("INSERT INTO `invoice`(`order_id`,`date`,`total`,`qty`,`status`,`users_email`,`products_id`,`seller_email`,`type`) 
    VALUES ('" . $order_id . "','" . $date . "','" . $amount . "','" . $qty . "','0','" . $mail . "','" . $pid . "','" . $seller . "','1')");
    echo ("success");
}
