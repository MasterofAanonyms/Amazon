<?php

session_start();
include "connection.php";

$email = $_SESSION["user"]["email"];

$user_name = $_POST["n"];
$mobile = $_POST["m"];
$line1 = $_POST["l1"];
$line2 = $_POST["l2"];
$provine = $_POST["p"];
$district = $_POST["d"];
$city = $_POST["c"];
$pcode = $_POST["pc"];

if(empty($line1)){
    echo("Please enter Your Address line 1.");
}else if(empty($line2) > 10){
    echo("Please enter Your Address line 2.");
}else if(empty($provine)){
    echo ("Please select Your Province.");
}else if(empty($district)){
    echo ("Please select you district.");
}else if(empty($city)){
    echo ("Please select Your Mobile Number.");
}else if(empty($pcode)){
    echo ("Please Enter Your Postal Code.");
}else if(strlen($pcode) > 10){
    echo("Postal Code Must Contain 10 or LOWER THAN 10 characters.");
}else if (!ctype_digit($pcode)) {
    echo "Please enter integer value.";
}else{
$user_rs = Database::search("SELECT * FROM `users` WHERE `email`='".$email."'");

if($user_rs->num_rows == 1){
    

    Database::iud("UPDATE `users` SET `user_name`='".$user_name."',`phone_no`='".$mobile."' WHERE 
    `email`='".$email."'");

    $address_rs = Database::search("SELECT * FROM `users_has_address` WHERE `users_email`='".$email."'");

    if($address_rs->num_rows == 1){

        Database::iud("UPDATE `users_has_address` SET `city_id`='".$city."',`line1`='".$line1."',
        `line2`='".$line2."',`postal_code`='".$pcode."' WHERE `users_email`='".$email."'");

    }else{

        Database::iud("INSERT INTO `users_has_address`(`users_email`,`city_id`,`line1`,`line2`,`postal_code`) 
        VALUES ('".$email."','".$city."','".$line1."','".$line2."','".$pcode."')");

    }

    if(sizeof($_FILES) == 1){

        $image = $_FILES["i"];
        $image_extension = $image["type"];

        $allowed_image_extensions = array("image/jpeg","image/png","image/svg+xml");

        if(in_array($image_extension,$allowed_image_extensions)){
            $new_img_extension;

            if($image_extension == "image/jpeg"){
                $new_img_extension = ".jpeg";
            }else if($image_extension == "image/png"){
                $new_img_extension = ".png";
            }else if($image_extension == "image/svg+xml"){
                $new_img_extension = ".svg";
            }

            $file_name = "resourcesofusersprofile(img)//".$user_name."_".uniqid().$new_img_extension;
            move_uploaded_file($image["tmp_name"],$file_name);

            $profile_img_rs = Database::search("SELECT * FROM `profile_img` WHERE `users_email`='".$email."'");

            if($profile_img_rs->num_rows == 1){

                Database::iud("UPDATE `profile_img` SET `path`='".$file_name."' WHERE `users_email`='".$email."'");
                echo ("Updated");

            }else{

                Database::iud("INSERT INTO `profile_img`(`path`,`users_email`) VALUES ('".$file_name."','".$email."')");
                echo ("Saved");

            }

        }


    }else if(sizeof($_FILES) == 0){

        echo ("You have not selected any image.");

    }else{
        echo ("You must select only 01 profile image.");
    }

}else{
    echo ("Invalid user.");
}


}

?>