<?php
session_start();
include "connection.php";

if (isset($_SESSION["admin"])) {
    if (isset($_GET["email"])) {

        $email = $_SESSION["admin"]["email"];
        $uid = $_GET["email"];

        $product_rs = Database::search("SELECT * FROM `users` WHERE `status_id`='1' AND 
        `email`='" . $uid . "'");
        $product_num = $product_rs->num_rows;
        Database::iud("UPDATE `products` SET `status_id` = '2' WHERE `id`='" . $uid . "'");
        echo ("Deactive");
        
    } else {
        echo ("Something went wrong. Please try again later.");
    }
} else {
    echo ("Please Login First.");
}
