<?php
session_start();
include "connection.php";

$email = $_POST["e"];
$password = $_POST["pw"];
$rememberme = $_POST["rem"];

if(empty($email)){
    echo ("Please Enter Your Email Address.");
}else if(strlen($email) > 100){
    echo ("Email Address Must Contain LOWER THAN 100 characters.");
}else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    echo ("Please enter your anouther part in your email.");
}else if(empty($password)){
    echo ("Please Enter Your Password.");
}else if(strlen($password) < 5 || strlen($password) > 20){
    echo ("Password Must Contain 5 to 20 Characters.");
}else{
    $rs = Database::search("SELECT * FROM `users` WHERE `email`='".$email."' AND `password`='".$password."'");
    $n = $rs->num_rows;

    $positions = 1;

$rsnu = Database::search("SELECT * FROM `users` WHERE `email`='".$email."'  AND `position_id`='".$positions."'");
$nus = $rsnu->num_rows;
if($nus == 1){
    echo ("You not valid seller.");
}else{
    
    if($n == 1){

        echo ("success");
        $d = $rs->fetch_assoc();
        $_SESSION["users"] = $d;

        if($rememberme == "true"){

            setcookie("email",$email,time()+(60*60*24*365));
            setcookie("password",$password,time()+(60*60*24*365));

        }else{

            setcookie("email","",-1);
            setcookie("password","",-1);

        }

    }else{
        echo ("Invalid Username or Password.");
    }
    
}

}

?>