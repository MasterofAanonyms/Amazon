<?php

include "connection.php";

$list_id = $_GET["id"];

$recent_rs = Database::search("SELECT * FROM `recent` WHERE `id`='".$list_id."'");
$recent_num = $recent_rs->num_rows;

if($recent_num == 0){
    echo ("Something went wrong. Please try again later.");
}else{
    $recent_data = $recent_rs->fetch_assoc();

    Database::iud("DELETE FROM `recent` WHERE `id`='".$list_id."'");
    echo ("success");
    
}

?>