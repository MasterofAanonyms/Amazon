 <?php

    session_start();
    include "connection.php";

    $email = $_SESSION["admin"]["email"];

    $product_name = $_POST["n"];
    $price = $_POST["p"];
    $qty = $_POST["q"];
    $dwc = $_POST["w"];
    $doc = $_POST["o"];
    $category = $_POST["c"];
    $brand = $_POST["b"];
    $model = $_POST["m"];
    $color = $_POST["clr"];
    $discount = $_POST["d"];
    $condition = $_POST["con"];
    $dicription = $_POST["disc"];
    $place = $_POST["place"];


    if (empty($product_name)) {
        echo "Please enter the product name.";
    } else if (empty($price)) {
        echo "Please enter the price.";
    } else if (!ctype_digit($price)) {
        echo "Please enter valid price or integer value. If you have added only integer values, check if symbols have been added (eg : , or .) or don't try put other currencies we all ready get LKR";
    } else if (empty($qty)) {
        echo "Please enter the quantity.";
    } else if ($qty <= 0) {
        echo "Please enter valid quentity.";
    } else if (empty($dwc)) {
        echo "Please enter the delivery cost for colombo users.";
    } else if (empty($doc)) {
        echo "Please enter the delivery cost for out of colombo users.";
    } else if (empty($category)) {
        echo "Please select the category.";
    } else if (empty($brand)) {
        echo "Please select the brand.";
    } else if (empty($model)) {
        echo "Please select the model.";
    } else if (empty($color)) {
        echo "Please select the color.";
    } else if (empty($discount)) {
        echo "Please select the discount category.";
    } else if (empty($condition)) {
        echo "Please Select the condition.";
    } else if (empty($place)) {
        echo "Please Select the Place.";
    } else if (empty($dicription)) {
        echo "Please enter the description about your product.";
    } else {

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        $mhb_rs = Database::search("SELECT * FROM `model_has_brand` WHERE `model_id`='" . $model . "' AND  `brand_id`='" . $brand . "'");

        $model_has_brand_id;

        if ($mhb_rs->num_rows > 0) {
            $mhb_data = $mhb_rs->fetch_assoc();
            $model_has_brand_id = $mhb_data["id"];
        } else {
            Database::iud("INSERT INTO `model_has_brand`(`model_id`,`brand_id`) VALUES ('" . $model . "','" . $brand . "')");
            $model_has_brand_id = Database::$connection->insert_id;
        }
        

        Database::iud("INSERT INTO `products` (`product_name`,`price`,`qty`,`delevery_fee_colombo`,`delevery_fee_other`,`discount_id`,`seller_email`,`adedd_date`,`product_place_status_id`,`category_id`,`condition_id`,`description`,`model_has_brand_id`) VALUES 
        ('" . $product_name . "','" . $price . "','$qty','" . $dwc . "','" . $doc . "','" . $discount . "','" . $email . "','" . $date . "','" . $place . "','" . $category . "','" . $condition . "','" . $dicription . "','" . $model_has_brand_id . "')");

        $product_id = Database::$connection->insert_id;

        Database::iud("INSERT INTO `color_has_products` (`products_id`,`color_id`) VALUES 
                ('$product_id','$color')");

        $length = sizeof($_FILES);

        if ($length <= 3  && $length > 1) {


            $allowed_image_extensions = array("image/jpeg", "image/png", "image/svg+xml");
            for ($x = 0; $x < $length; $x++) {
                if (isset($_FILES["image" . $x])) {

                    $image_file = $_FILES["image" . $x];
                    $file_extension = $image_file["type"];

                    if (in_array($file_extension, $allowed_image_extensions)) {

                        $new_img_extension;

                        if ($file_extension == "image/jpeg") {
                            $new_img_extension = ".jpeg";
                        } else if ($file_extension == "image/png") {
                            $new_img_extension = ".png";
                        } else if ($file_extension == "image/svg+xml") {
                            $new_img_extension = ".svg";
                        }

                        $file_name = "resources_of_products(img)//" . $product_name . "_" . $x . "_" . uniqid() . $new_img_extension;
                        move_uploaded_file($image_file["tmp_name"], "../$file_name");

                        Database::iud("INSERT INTO `product_img`(`image_path`,`products_id`) VALUES 
                        ('" . $file_name . "','" . $product_id . "')");
                    } else {
                        echo ("Inavid image type.");
                    }
                }
            }
            echo ("OK");
        } else {
            echo ("Invalid Image Count.");
        }
    }


    ?>