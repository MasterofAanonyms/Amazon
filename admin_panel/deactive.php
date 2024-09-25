<?php
session_start();
include "connection.php";


if (isset($_SESSION["admin"])) {
    if (isset($_GET["email"])) {

        $email = $_SESSION["admin"]["email"];
        $pid = $_GET["email"];

        $product_rs = Database::search("SELECT * FROM `users` WHERE `status_id`='2' AND 
        `email`='" . $pid . "'");
        $product_num = $product_rs->num_rows;
        Database::iud("UPDATE `users` SET `status_id` = '1' WHERE `email`='" . $pid . "'");
        echo ("Active");
        
    } else {
        echo ("Something went wrong. Please try again later.");
    }
} else {
    echo ("Please Login First.");
}
?>