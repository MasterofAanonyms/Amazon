<?php
session_start();
    include "connection.php";

    $email = $_SESSION["admin"]["email"];

    $model = $_POST["M"];
    $brand = $_POST["B"];

    if (empty($model)) {
        echo "Please enter your Model.";
    } else if (empty($brand)) {
        echo "Please select the brand.";
    }else if(ctype_digit($model)){
        echo "Please don't enter integier value model.";
    } else if(strlen($model) < 2){
        echo "Please enter valid model.";
    } else{
        $rs = Database::search("SELECT * FROM `model` WHERE `model`='".$model."'");
        $n = $rs->num_rows;
        if ($n == 1) {
            echo("Model already exists");
        }else{
            Database::iud("INSERT INTO `model` (`model`) VALUES ('" . $model . "')");
            $model_id = Database::$connection->insert_id;

            Database::iud("INSERT INTO `model_has_brand` (`model_id`,`brand_id`) VALUES ('" . $model_id. "','" . $brand . "')");
            echo("ok");
        }
        
    }

?>