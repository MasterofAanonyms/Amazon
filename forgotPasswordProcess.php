<?php

include "connection.php";

include "SMTP.php";
include "PHPMailer.php";
include "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_GET["e"])) {

    $email = $_GET["e"];

    $rs = Database::search("SELECT * FROM `users` WHERE `email`='" . $email . "'");
    $n = $rs->num_rows;

    if ($n == 1) {

        $code = substr(uniqid(), -6);
        Database::iud("UPDATE `users` SET `vft_code`='" . $code . "' WHERE `email`='" . $email . "'");

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'jkaaruth@gmail.com';
        $mail->Password = 'drpm taha andb akzl';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('jkaaruth@gmail.com', 'Amazon');
        $mail->addReplyTo('jkaaruth@gmail.com', 'Amazon');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Your Amazon verification code';
        $bodyContent = '
        <div style="background-color:  #ffff; max-width: 600px;margin: 50px auto;padding: 20px;box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);border-radius: 8px;">
        <img src="https://www.amazon.com/ref=nav_logo" alt="Embedded Image">
        <h2 style="color: #000000;text-align: center;font-weight: bold;font-size: 24px;">Amazon Forgot password Verification Code</h2>
        <hr/><br/>
        <p style="color: #000000;line-height: 1.6; font-weight: bold;">Hi,<a>'.$email.'</a></p><br/>
        <p style="color: #000000;line-height: 1.6; font-weight: bold; font-size: 14px;">Please enter the 6-digit code below on the email verification page: <span style="font-size: 24px; font-weight: bold;color: #f48024;">'.$code.'</span> Remember, beware of scams and keep this one-time verification code confidential.</p>
        <p style="color: red;">If you did\'t request to reset password, please ignore this email</p>
        <p style="color: #909090;line-height: 1.6;">Thanks,<br>The Amazon Team</p>
        </div>';
        $mail->Body    = $bodyContent;

        if (!$mail->send()) {
            echo 'Verification code sending failed.';
        } else {
            echo 'Success';
        }
    }else if(!isset($_GET["e"])){
        echo ("Please enter your Email Address in Email Field.");
    } else {
        echo ("Invalid Email Address.");
    }
} 
