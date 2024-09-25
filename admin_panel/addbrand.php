<?php
session_start();
    include "connection.php";

    $email = $_SESSION["admin"]["email"];

    $brand = $_POST["B"];
    $category = $_POST["C2"];

    if (empty($brand)) {
        echo "Please enter your brand.";
    } else if (empty($category)) {
        echo "Please select the category.";
    }else if(ctype_digit($brand)){
        echo "Please don't enter integier value brand.";
    } else if(strlen($brand) < 2){
        echo "Please enter valid brand.";
    } else{
        $rs = Database::search("SELECT * FROM `brand` WHERE `brand`='".$brand."'");
        $n = $rs->num_rows;
        if ($n == 1) {
            echo("Brand already exists");
        }else{
            Database::iud("INSERT INTO `brand` (`brand`) VALUES ('" . $brand . "')");
            $brand_id = Database::$connection->insert_id;

            Database::iud("INSERT INTO `category_has_brand` (`category_id`,`brand_id`) VALUES ('" . $category . "','" . $brand_id . "')");
            echo("ok");
        }
        
    }

?>