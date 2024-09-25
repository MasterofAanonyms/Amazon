



<?php
session_start();
    include "connection.php";

    $email = $_SESSION["admin"]["email"];

    $discount = $_POST["D"];

    if (empty($discount)) {
        echo "Please enter your discount.";
    } else if(ctype_digit($discount)){
        echo "Please don't enter integier value discount.";
    } else if(strlen($discount) < 3){
        echo "Please enter valid discount.";
    } else{
        $rs = Database::search("SELECT * FROM `discount` WHERE `discount`='".$discount."'");
        $n = $rs->num_rows;
        if ($n == 1) {
            echo("discount already exists");
        }else{
            Database::iud("INSERT INTO `discount` (`discount`) VALUES ('" . $discount . "')");
            echo("ok");
        }
        
    }

?>