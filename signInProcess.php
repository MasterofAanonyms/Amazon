<?php
session_start();
include "connection.php";

$email = $_POST["e"];
$password = $_POST["pw"];
$rememberme = $_POST["rm"];

if(empty($email)){
    echo ("Please Enter Your Email Address.");
}else if(empty($password)){
    echo ("Please Enter Your Password.");
}
else{
    $rs = Database::search("SELECT * FROM `users` WHERE `email`='".$email."' AND `password`='".$password."'");
    $n = $rs->num_rows;
    
    if($n == 1){
        
        echo ("success");
        $d = $rs->fetch_assoc();
        $_SESSION["user"] = $d;

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
    




?>