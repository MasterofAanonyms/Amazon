<?php
session_start();
include "connection.php";

if (isset($_SESSION["users"])) {
    if (isset($_GET["id"])) {

        $email = $_SESSION["users"]["email"];
        $iid = $_GET["id"];

        $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `id`= '".$iid."'");
        $invoice_num = $invoice_rs->num_rows;
            $invoice_data = $invoice_rs->fetch_assoc();
            $sid = $invoice_data["status"];

        $new_sid = $sid +1;
        Database::iud("UPDATE `invoice` SET `status` = '".$new_sid."' WHERE `id`='" . $iid . "'");
        echo ("update");
        
    } else {
        echo ("Something went wrong. Please try again later.");
    }
} else {
    echo ("Please Login First.");
}
