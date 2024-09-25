<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amazon.lk | Seller Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="resourcesofwebsiteimg/icon.svg" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" integrity="sha384-4LISF5TTJX/fLmGSxO53rV4miRxdg84mZsxmO8Rx5jGtp/LbrixFETvWa5a6sESd" crossorigin="anonymous">
</head>
<style>
    @media only screen and (max-width: 480px) {
        h1 {
            display: none;
        }

        .d_none {
            display: none;
        }


        .adjestment {
            justify-content: center;
            align-items: center;
            display: flex;

        }

        .btn-success2 {
            margin-top: 10px;
        }
    }

    .content-section {
        display: none;
    }

    .content-section.active {
        display: block;
    }

    .header {
        background-color: black;
        color: white;
    }

    .btn:hover {
        text-decoration: none;
    }

    .header_img2 img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
    }

    .header_toggle {
        cursor: pointer;
    }

    .nav {
        flex-direction: column;
    }

    .nav .nav_link {
        margin-bottom: 10px;
    }
</style>

<body id="body-pd">
    <?php
    session_start();
    include "connection.php";

    if (isset($_SESSION["users"])) {
        $email = $_SESSION["users"]["email"];
        $pageno;
    ?>
        <header class="header " id="header">
            <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle" style="color: white;"></i> </div>
            <div class="justify-content-center align-items-center d-flex">
                <h1>Seller Dashboard</h1>
            </div>
            <?php
            $image_rs = Database::search("SELECT * FROM `profile_img` WHERE `users_email`='" . $email . "'");
            $image_details = $image_rs->fetch_assoc();
            ?>
            <div class="header_img2">
                <?php
                if (empty($image_details["path"])) {
                ?>
                    <img src="resourcesofwebsiteimg/user_male.svg" alt="">
                <?php
                } else {
                ?>
                    <img src="<?php echo $image_details["path"]; ?>" alt="">
                <?php
                }
                ?>
            </div>
        </header>
        <div class="l-navbar " id="nav-bar">
            <nav class="nav">
                <div> <a href="#" class="nav_logo">
                        <div class="header_img">
                            <img src="resourcesofwebsiteimg/icon.svg" alt="">
                        </div> <span class="nav_logo-name">Amazon</span>
                    </a>
                    <div class="nav_list">
                        <a class="nav_link active" onclick="showSection('dashboard')"> <i class='bx bx-import nav_icon'></i> <span class="nav_name">Add Product</span> </a>
                        <a class="nav_link" onclick="showSection('files')"> <i class='bx bx-folder nav_icon'></i> <span class="nav_name">Manage Products</span> </a>
                        <a class="nav_link" onclick="showSection('stats')"> <i class='bx bx-bar-chart-alt-2 nav_icon'></i> <span class="nav_name">Order status</span> </a>
                    </div>
                </div> <a href="#" onclick="sell_signout();" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">SignOut</span> </a>
            </nav>
        </div>

        <div class="container mt-2 mb-5">
            <div id="dashboard" class="content-section active">
                <?php include "addproduct.php";  ?> 
            </div>
            <!-- <div id="bookmark" class="content-section mb-3">
                <?php
                //  include "addproduct.php";  
                 ?>
            </div> -->
            <div id="files" class="content-section">
                <?php include "manage_pro.php";   ?>
            </div>
            <div id="stats" class="content-section">
                <?php include "status.php";   ?>
            </div>
        </div>

    <?php
    } else {
    ?>
        <script>
            alert("Please login first");
            window.location = "seller_login.php";
        </script>
    <?php
    }
    ?>
    <script>
        function showSection(sectionId) {
            // Hide all sections
            const sections = document.querySelectorAll('.content-section');
            sections.forEach(section => {
                section.classList.remove('active');
            });

            // Show the selected section
            document.getElementById(sectionId).classList.add('active');

            // Update active link
            const links = document.querySelectorAll('.nav_link');
            links.forEach(link => {
                link.classList.remove('active');
            });
            event.currentTarget.classList.add('active');
        }

        function signout() {
            // Sign out logic here
            alert("Signing out...");
        }
    </script>
    <script src="script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>