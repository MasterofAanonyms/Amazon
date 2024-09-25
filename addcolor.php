



<?php
session_start();
    include "connection.php";

    $email = $_SESSION["users"]["email"];

    $color = $_POST["C"];

    if (empty($color)) {
        echo "Please enter your color.";
    } else if(ctype_digit($color)){
        echo "Please don't enter integier value color.";
    } else if(strlen($color) < 3){
        echo "Please enter valid color.";
    } else{
        $rs = Database::search("SELECT * FROM `color` WHERE `color`='".$color."'");
        $n = $rs->num_rows;
        if ($n == 1) {
            echo("color already exists");
        }else{
            Database::iud("INSERT INTO `color` (`color`) VALUES ('" . $color . "')");
            echo("ok");
        }
        
    }

?>