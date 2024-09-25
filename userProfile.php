<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>User Profile | eShop</title>

    <link rel="stylesheet" href="bootstrap_files/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .head {
            background-color: #000;
        }

        .roundedX {
            border: 3px solid grey;
            border-radius: 70%;
        }
    </style>
    <link rel="icon" href="resource/logo.svg" />

</head>

<body>
    <!-- <div class="head"> -->
    <?php
    // include "header_main.php"; 
    session_start();
    ?>
    <!-- <br> -->
    <!-- </div> -->

    <div class="container-fluid">
        <div class="row">


            <?php

            include "connection.php";

            if (isset($_SESSION["user"])) {

                $email = $_SESSION["user"]["email"];

                $details_rs = Database::search("SELECT * FROM `users` INNER JOIN `gender` ON 
    users.gender_id=gender.id WHERE `email`='" . $email . "'");

                $image_rs = Database::search("SELECT * FROM `profile_img` WHERE `users_email`='" . $email . "'");

                $address_rs = Database::search("SELECT * FROM `users_has_address` INNER JOIN `city` ON 
    users_has_address.city_id=city.id INNER JOIN `district` ON 
    city.district_id=district.id INNER JOIN `province` ON 
    district.province_id=province.id WHERE `users_email`='" . $email . "'");

                $user_details = $details_rs->fetch_assoc();
                $image_details = $image_rs->fetch_assoc();
                $address_details = $address_rs->fetch_assoc();

            ?>
                <div class="col-12">
                    <div class="row">

                        <div class="col-12 bg-body  mt-4 mb-4">
                            <div class="row g-2">
                                <div class="col-12">
                                    <a href="index.php">Home</a>/ Profile
                                </div>
                                <hr>
                                <div class="col-md-3 border-end">
                                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">

                                        <?php

                                        if (empty($image_details["path"])) {
                                        ?>
                                            <img src="resourcesofwebsiteimg/user_male.svg" class="roundedX mt-5" style="width: 150px;" id="img" />
                                        <?php
                                        } else {
                                        ?>
                                            <img src="<?php echo $image_details["path"]; ?>" class="roundedX mt-5" id="img" style="width: 150px;" />
                                        <?php
                                        }

                                        ?>

                                        <span class=""><?php echo $user_details["user_name"] ?></span>
                                        <span class=" text-black-50"><?php echo $email; ?></span>

                                        <input type="file" class="d-none" id="profileimage" />
                                        <label for="profileimage" class="btn btn-warning mt-5" onclick="changeProfileImg();">Update Profile Image</label>

                                    </div>
                                </div>

                                <div class="col-md-5 border-end">
                                    <div class="p-3 py-5">

                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h4 class="fw-bold">Profile Settings</h4>
                                        </div>

                                        <div class="row mt-4">

                                            <div class="col-12">
                                                <label class="form-label">User Name</label>
                                                <input id="uname" type="text" class="form-control" value="<?php echo $user_details["user_name"]; ?>" />
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">Mobile</label>
                                                <input id="mobile" type="text" class="form-control" value="<?php echo $user_details["phone_no"]; ?>" />
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">Password</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control" value="<?php echo $user_details["password"]; ?>" readonly />
                                                    <span class="input-group-text bg-warning" id="basic-addon2">
                                                        <i class="bi bi-eye-slash-fill text-white"></i>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">Email</label>
                                                <input type="text" class="form-control" readonly value="<?php echo $user_details["email"]; ?>" />
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">Registered Date</label>
                                                <input type="text" class="form-control" readonly value="<?php echo $user_details["joined_date"]; ?>" />
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">Address Line 01</label>

                                                <?php
                                                if (empty($address_details["line1"])) {
                                                ?>
                                                    <input id="line1" type="text" class="form-control" />
                                                <?php
                                                } else {
                                                ?>
                                                    <input id="line1" type="text" class="form-control" value="<?php echo $address_details["line1"]; ?>" />
                                                <?php
                                                }
                                                ?>

                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">Address Line 02</label>
                                                <?php
                                                if (empty($address_details["line2"])) {
                                                ?>
                                                    <input id="line2" type="text" class="form-control" />
                                                <?php
                                                } else {
                                                ?>
                                                    <input id="line2" type="text" class="form-control" value="<?php echo $address_details["line2"]; ?>" />
                                                <?php
                                                }
                                                ?>
                                            </div>

                                            <?php
                                            $province_rs = Database::search("SELECT * FROM `province`");
                                            $district_rs = Database::search("SELECT * FROM `district`");
                                            $city_rs = Database::search("SELECT * FROM `city`");
                                            ?>

                                            <div class="col-6">
                                                <label class="form-label">Province</label>
                                                <select class="form-select" id="province">
                                                    <option value="0">Select Province</option>
                                                    <?php
                                                    for ($x = 0; $x < $province_rs->num_rows; $x++) {
                                                        $province_data = $province_rs->fetch_assoc();
                                                    ?>
                                                        <option value="<?php echo $province_data["id"]; ?>" <?php
                                                                                                            if (!empty($address_details["province_id"])) {
                                                                                                                if ($province_data["id"] == $address_details["province_id"]) {
                                                                                                            ?>selected<?php
                                                                                                                    }
                                                                                                                }
                                                                                                                        ?>>
                                                            <?php echo $province_data["province"]; ?>
                                                        </option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label">District</label>
                                                <select class="form-select" id="district">
                                                    <option value="0">Select District</option>
                                                    <?php
                                                    for ($x = 0; $x < $district_rs->num_rows; $x++) {
                                                        $district_data = $district_rs->fetch_assoc();
                                                    ?>
                                                        <option value="<?php echo $district_data["id"]; ?>" <?php
                                                                                                            if (!empty($address_details["district_id"])) {
                                                                                                                if ($district_data["id"] == $address_details["district_id"]) {
                                                                                                            ?>selected<?php
                                                                                                                    }
                                                                                                                }
                                                                                                                        ?>>
                                                            <?php echo $district_data["district"]; ?>
                                                        </option>
                                                    <?php
                                                    }
                                                    ?>

                                                </select>
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label">City</label>
                                                <select class="form-select" id="city">
                                                    <option value="0">Select City</option>
                                                    <?php
                                                    for ($x = 0; $x < $city_rs->num_rows; $x++) {
                                                        $city_data = $city_rs->fetch_assoc();
                                                    ?>
                                                        <option value="<?php echo $city_data["id"]; ?>" <?php
                                                                                                        if (!empty($address_details["city_id"])) {
                                                                                                            if ($city_data["id"] == $address_details["city_id"]) {
                                                                                                        ?>selected<?php
                                                                                                                }
                                                                                                            }
                                                                                                                    ?>>
                                                            <?php echo $city_data["city"]; ?>
                                                        </option>
                                                    <?php
                                                    }
                                                    ?>

                                                </select>
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label">Postal Code</label>
                                                <?php
                                                if (empty($address_details["postal_code"])) {
                                                ?>
                                                    <input id="pcode" type="text" class="form-control" />
                                                <?php
                                                } else {
                                                ?>
                                                    <input id="pcode" type="text" class="form-control" value="<?php echo $address_details["postal_code"]; ?>" />
                                                <?php
                                                }
                                                ?>

                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">Gender</label>
                                                <input type="text" class="form-control" value="<?php echo $user_details["gender"]; ?>" readonly />
                                            </div>

                                            <div class="col-12 d-grid mt-2">
                                                <button class="btn btn-warning" onclick="updateProfile();">Update My Profile</button>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-4 text-center">
                                    <div class="row">
                                        <?php require "advertice.php" ?>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            <?php

            } else {
            ?>

                <script>
                    alert("Please login first.");
                    window.location = "login.php";
                </script>

            <?php
            }

            ?>



        </div>
    </div>

    <script src="bootstrap_files/bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>