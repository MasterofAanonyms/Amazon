<?php

session_start();
include "connection.php";

if(isset($_SESSION["user"])){

    $mail = $_SESSION["user"]["email"];
    $pid = $_POST["pid"];
    $type = $_POST["t"];
    $feed = $_POST["f"];

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    Database::iud("INSERT INTO `feedback`(`type`,`date`,`feedback`,`users_email`,`products_id`) VALUES 
    ('".$type."','".$date."','".$feed."','".$mail."','".$pid."')");

    echo ("success");

}

?>