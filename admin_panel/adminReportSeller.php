<?php

session_start();
include "connection.php";

if (isset($_SESSION["admin"])) {

    $rs = Database::search("SELECT * FROM `users` INNER JOIN `user_type` ON
    `users`.`position_id` = `user_type`.`id` WHERE `position_id`='2' ORDER BY `users`.`joined_date` ASC ");

    

    $num = $rs->num_rows;

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
    <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../bootstrap_files/bootstrap.css">
        <link rel="stylesheet" href="../style.css">
        <link rel="shortcut icon" href="../resourcesofwebsiteimg/icon.svg" type="image/x-icon">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" integrity="sha512-dPXYcDub/aeb08c63jRq/k6GaKccl256JQy/AnOq7CAnEZ9FzSL9wSbcZkMp4R26vBsMLFYH4kQ67/bbV8XaCQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <title>Amazon.lk | Seller Report</title>
        <style>
            .anker{
                color: black;
                text-decoration: none;
            }

            .anker:hover{
                color: black;
            }
        </style>
    </head>

    <body>
    <?php include "adminNavBar.php"; ?>
        <div class="container mt-3">
            <a href="adminDashboard.php" class="anker">
            <i class="bi bi-arrow-left"></i> Back to report
            </a>
        </div>

        <div class="container" id="printArea">
            <h2 class="text-center">Seller Report and Leader Board</h2>
            <hr>

            <table class="table  mt-5 table-striped">
                <thead>
                    <tr>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>User Type</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>

                    <?php

                    for ($i = 0; $i < $num; $i++) {

                        $d = $rs->fetch_assoc();

                    ?>
                        <tr>
                            <td><?php echo $d["user_name"]; ?></td>
                            <td><?php echo $d["email"]; ?></td>
                            <td><?php echo $d["phone_no"]; ?></td>
                            <td><?php echo $d["type"]; ?></td>

                            <td>
                                <?php

                                if ($d["status_id"] == 1) {
                                    ?>
                                    <button class="btn btn-warning">Active</button>
                                    <?php
                                } else {
                                    ?>
                                    <button class="btn btn-danger">Active</button>
                                    <?php
                                }
                                ?>
                            </td>

                        </tr>
                    <?php
                    }

                    ?>
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end container mt-5 mb-5">
            <button class="btn btn-outline-dark col-2" onclick="printDiv();">Print</button>
        </div>

        <script src="script.js"></script>
    </body>

    </html>

<?php
} else {
    echo ("You're not a valid admin");
}

?>