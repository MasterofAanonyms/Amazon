<?php

session_start();
include "connection.php";

if (isset($_SESSION["user"])) {
    if (isset($_GET["id"])) {

        $pid = $_GET["id"];
        $umail = $_SESSION["user"]["email"];

        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `products_id`='" . $pid . "' AND `users_email`='" . $umail . "'");
        $cart_num = $cart_rs->num_rows;

        $product_rs = Database::search("SELECT * FROM `products` WHERE `id`='" . $pid . "'");
        $product_data = $product_rs->fetch_assoc();

        $product_qty = $product_data["qty"];

        if ($cart_num == 1) {

            $cart_data = $cart_rs->fetch_assoc();
            $current_qty = $cart_data["qty"];
            $new_qty = (int)$current_qty + 1;

            if ($product_qty >= $new_qty) {
                Database::iud("UPDATE `cart` SET `qty`='" . $new_qty . "' WHERE `id`='" . $cart_data["id"] . "'");
                echo ("The product qty in the cart increased by 1 product.");
            } else {
                echo ("Invalid Quantity");
            }
        } else {
            Database::iud("INSERT INTO `cart`(`qty`,`users_email`,`products_id`) VALUES ('1','" . $umail . "','" . $pid . "')");
            echo ("New product added to the cart.");
        }
    } else {
        echo ("Someting Went Wrong.");
    }
} else {
    echo ("change");
}

?>