<?php

session_start();

if(isset($_SESSION["users"])){

    $_SESSION["users"] = null;
    session_destroy();

    echo ("success");

}

?>
