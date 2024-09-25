<?php
session_start();
include "connection.php";

if(isset($_SESSION["user"])){

    $id = $_GET["id"];
    $qty = $_GET["qty"];
    $umail = $_SESSION["user"]["email"];

    $array;

    $order_id = uniqid();

    $product_rs = Database::search("SELECT * FROM `products` WHERE `id`='".$id."'");
    $product_data = $product_rs->fetch_assoc();

    $city_rs = Database::search("SELECT * FROM `users_has_address` WHERE `users_email`='".$umail."'");
    $city_num = $city_rs->num_rows;

    if($city_num == 1){

        $city_data = $city_rs->fetch_assoc();

        $city_id = $city_data["city_id"];
        $address = $city_data["line1"].", ".$city_data["line2"];

        $district_rs = Database::search("SELECT * FROM `city` WHERE `id`='".$city_id."'");
        $district_data = $district_rs->fetch_assoc();
        $delivery = "0";

        if($district_data["id"] == "10"){
            $delivery = $product_data["delevery_fee_colombo"];
        }else{
            $delivery = $product_data["delevery_fee_other"];
        }

        $item = $product_data["product_name"];
        $amount = ((int)$product_data["price"] * (int)$qty) + (int)$delivery;

        $uname = $_SESSION["user"]["user_name"];
        $mobile = $_SESSION["user"]["phone_no"];
        $uaddress = $address;
        $city = $district_data["city"];

        $merchant_id = "1225180";
        $merchant_secret = "MTgwNzQxNzMzODE0Mjc1Nzc4NjMxODI2NTI3OTQxMjQ2MTc2NTI5";
        $currency = "LKR";

        $hash = strtoupper(
            md5(
                $merchant_id . 
                $order_id . 
                number_format($amount, 2, '.', '') . 
                $currency .  
                strtoupper(md5($merchant_secret)) 
            ) 
        );

        $array["id"] = $order_id;
        $array["item"] = $item;
        $array["amount"] = $amount;
        $array["uname"] = $uname;
        $array["mobile"] = $mobile;
        $array["address"] = $uaddress;
        $array["city"] = $city;
        $array["umail"] = $umail;
        $array["mid"] = $merchant_id;
        $array["msecret"] = $merchant_secret;
        $array["currency"] = $currency;
        $array["hash"] = $hash;

        echo json_encode($array);

    }else{
        echo ("2");
    }

}else{
    echo ("1");
}

?>