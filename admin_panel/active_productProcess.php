<?php
session_start();
include "connection.php";


if (isset($_SESSION["admin"])) {
    if (isset($_GET["id"])) {

        $email = $_SESSION["admin"]["email"];
        $pid = $_GET["id"];

        $product_rs = Database::search("SELECT * FROM `products` WHERE `product_status`='2' AND 
        `id`='" . $pid . "'");
        $product_num = $product_rs->num_rows;
        Database::iud("UPDATE `products` SET `product_status` = '1' WHERE `id`='" . $pid . "'");
        echo ("Active");
        
    } else {
        echo ("Something went wrong. Please try again later.");
    }
} else {
    echo ("Please Login First.");
}
?>