<?php

include "connection.php";

$user_name = $_POST["un"];
$password = $_POST["pw"];
$mobile = $_POST["m"];
$email = $_POST["e"];
$gender = $_POST["g"];
$agreement = $_POST["ag"];

if(empty($user_name)){
    echo("Please enter your user name");
}else if(strlen($user_name) < 5 || strlen($user_name) > 10){
    echo("Username Must Contain 10 or LOWER THAN 10 characters.");
}else if(empty($password)){
    echo ("Please Enter Your Password.");
}else if(strlen($password) < 5 || strlen($password) > 20){
    echo ("Password Must Contain 5 to 20 Characters.");
}else if(empty($mobile)){
    echo ("Please Enter Your Mobile Number.");
}else if(strlen($mobile) != 10){
    echo ("Mobile Number Must Contain 10 characters.");
}else if(!preg_match("/07[0,1,2,4,5,6,7,8]{1}[0-9]{7}/",$mobile)){
    echo ("Invalid Mobile Number.");
}else if(empty($email)){
    echo ("Please Enter Your Email Address.");
}else if(strlen($email) > 100){
    echo ("Email Address Must Contain LOWER THAN 100 characters.");
}else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    echo ("Invalid Email Address.");
} else {
    $rs = Database::search("SELECT * FROM `users` WHERE `email`='".$email."' AND `position_id`='2' ");
        $n = $rs->num_rows;
    $rsu = Database::search("SELECT * FROM `users` WHERE `email`='".$email."' AND `position_id`='1' ");
        $nu = $rsu->num_rows;

        if($n >= 1){
            echo ("allready");
        }else if($nu >= 1){
            echo ("Your email or phone number allready registred as user! Please try different number or email. ");
        }else {
            echo ("success");
        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $jdate = $d->format("Y-m-d H:i:s");
        Database::iud("INSERT INTO `users`
        (`user_name`,`password`,`email`,`phone_no`,`joined_date`,`gender_id`,`status_id`,`position_id`) VALUES 
        ('".$user_name."','".$password."','".$email."','".$mobile."','".$jdate."','".$gender."','1','2')");
        

        
    }
}

?>